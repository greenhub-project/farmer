<?php

namespace App\Jobs;

use App\Farmer\Models\Protocol\Device;
use App\Farmer\Models\Upload;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $device;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @param $device Device to add the sample.
     * @param $data array to extract data to add to the sample.
     */
    public function __construct(Device $device, $data)
    {
        $this->device = $device;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->device == null) {
            return;
        }

        $raw = null;

        \DB::beginTransaction();

        try {
            $raw = Upload::create(['data' => json_encode($this->data)]);
        } catch (QueryException $e) {
            \Log::error($e->getMessage());
            \DB::rollBack();
        }

        \DB::commit();

        \DB::beginTransaction();

        try {
            $child = null;

            // Legacy support, these fields don't exist in previous versions of the Android app protocol
            $app = array_key_exists('version', $this->data) ? $this->data['version'] : 0;
            $database = array_key_exists('database', $this->data) ? $this->data['database'] : 0;

            $sample = $this->device->samples()->create([
                'timestamp' => date('Y-m-d H:i:s', $this->data['timestamp'] / 1000),
                'app_version' => $app,
                'database_version' => $database,
                'battery_state' => $this->data['batteryState'],
                'battery_level' => $this->data['batteryLevel'],
                'memory_wired' => $this->data['memoryWired'],
                'memory_active' => $this->data['memoryActive'],
                'memory_inactive' => $this->data['memoryInactive'],
                'memory_free' => $this->data['memoryFree'],
                'memory_user' => $this->data['memoryUser'],
                'triggered_by' => $this->data['triggeredBy'],
                'network_status' => $this->data['networkStatus'],
                'screen_brightness' => $this->data['screenBrightness'],
                'screen_on' => $this->data['screenOn'],
                'timezone' => $this->data['timeZone'],
                'country_code' => $this->data['countryCode'],
            ]);

            $child = $this->data['networkDetails'];

            $sample->networkDetails()->create([
                'network_type' => $child['networkType'],
                'mobile_network_type' => $child['mobileNetworkType'],
                'mobile_data_status' => $child['mobileDataStatus'],
                'mobile_data_activity' => $child['mobileDataActivity'],
                'roaming_enabled' => $child['roamingEnabled'],
                'wifi_status' => $child['wifiStatus'],
                'wifi_signal_strength' => $child['wifiSignalStrength'],
                'wifi_link_speed' => $child['wifiLinkSpeed'],
                'wifi_ap_status' => $child['wifiApStatus'],
                'network_operator' => $child['networkOperator'],
                'sim_operator' => $child['simOperator'],
                'mcc' => $child['mcc'],
                'mnc' => $child['mnc'],
            ]);

            $child = $this->data['batteryDetails'];

            $sample->batteryDetails()->create([
                'charger' => $child['charger'],
                'health' => $child['health'],
                'voltage' => $child['voltage'],
                'temperature' => $child['temperature'],
                'capacity' => $child['capacity'],
                'charge_counter' => $child['chargeCounter'],
                'current_average' => $child['currentAverage'],
                'current_now' => $child['currentNow'],
                'energy_counter' => $child['energyCounter'],
            ]);

            $child = $this->data['cpuStatus'];

            $sample->cpuStatus()->create([
                // Create a function to convert 0.xxx to xxx
                'usage' => $child['cpuUsage'],
                'up_time' => ($child['upTime'] < 1) ? 0 : $child['upTime'],
                'sleep_time' => ($child['sleepTime'] < 1) ? 0 : $child['sleepTime'],
            ]);

            $child = $this->data['settings'];

            $sample->settings()->create([
                'bluetooth_enabled' => $child['bluetoothEnabled'],
                'location_enabled' => $child['locationEnabled'],
                'power_saver_enabled' => $child['powersaverEnabled'],
                'flashlight_enabled' => $child['flashlightEnabled'],
                'nfc_enabled' => $child['nfcEnabled'],
                'unknown_sources' => $child['unknownSources'],
                'developer_mode' => $child['developerMode'],
            ]);

            $child = $this->data['storageDetails'];

            $sample->storageDetails()->create([
                'free' => $child['free'],
                'total' => $child['total'],
                'free_external' => $child['freeExternal'],
                'total_external' => $child['totalExternal'],
                'free_system' => $child['freeSystem'],
                'total_system' => $child['totalSystem'],
                'free_secondary' => $child['freeSecondary'],
                'total_secondary' => $child['totalSecondary'],
            ]);

            if (array_key_exists('locationProviders', $this->data)) {
                $child = $this->data['locationProviders'];

                foreach ($child as $el) {
                    $sample->locationProviders()->create([
                        'provider' => $el['provider'],
                    ]);
                }
            }

            if (array_key_exists('features', $this->data)) {
                $child = $this->data['features'];

                foreach ($child as $el) {
                    $sample->features()->create([
                        'key' => $el['key'],
                        'value' => $el['value'],
                    ]);
                }
            }

            if (array_key_exists('processInfos', $this->data)) {
                $child = $this->data['processInfos'];

                foreach ($child as $el) {
                    $process = $sample->processes()->create([
                        'process_id' => $el['processId'],
                        'name' => $el['name'],
                        'application_label' => $el['applicationLabel'],
                        'is_system_app' => $el['isSystemApp'],
                        'importance' => $el['importance'],
                        'version_name' => $el['versionName'],
                        'version_code' => $el['versionCode'],
                        'installation_package' => $el['installationPkg'],
                    ]);

                    // permissions
                    if (array_key_exists('appPermissions', $el)) {
                        foreach ($el['appPermissions'] as $perm) {
                            $process->permissions()->create([
                                'permission' =>  $perm['permission'],
                            ]);
                        }
                    }
                }
            }

            if ($raw != null) {
                $raw->stored = true;
                $raw->save();
            }
        } catch (QueryException $e) {
            \Log::error('Failed for device => '.$this->device->id);
            \Log::error($e->getMessage());
            \DB::rollBack();
        }

        \DB::commit();
    }
}
