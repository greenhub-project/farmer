<?php

namespace App\Jobs;

use App\Farmer\Models\Upload;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Farmer\Models\Protocol\Device;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\QueryException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Farmer\Models\Protocol\AndroidPermission;

class ProcessFailedUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $device;
    public $upload;

    private $data;

    /**
     * Create a new job instance.
     *
     * @param Device $device
     * @param Upload $upload
     */
    public function __construct(Device $device, Upload $upload)
    {
        $this->device = $device;
        $this->upload = $upload;
        $this->data = (array) json_decode($upload->data);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        DB::beginTransaction();

        try {
            $child = null;

            $sample = $this->createSample();

            $child = (array) $this->data['networkDetails'];
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

            $child = (array) $this->data['batteryDetails'];
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

            $child = (array) $this->data['cpuStatus'];
            $sample->cpuStatus()->create([
                // Create a function to convert 0.xxx to xxx
                'usage' => $child['cpuUsage'],
                'up_time' => ($child['upTime'] < 1) ? 0 : $child['upTime'],
                'sleep_time' => ($child['sleepTime'] < 1) ? 0 : $child['sleepTime'],
            ]);

            $child = (array) $this->data['settings'];
            $sample->settings()->create([
                'bluetooth_enabled' => $child['bluetoothEnabled'],
                'location_enabled' => $child['locationEnabled'],
                'power_saver_enabled' => $child['powersaverEnabled'],
                'flashlight_enabled' => $child['flashlightEnabled'],
                'nfc_enabled' => $child['nfcEnabled'],
                'unknown_sources' => $child['unknownSources'],
                'developer_mode' => $child['developerMode'],
            ]);

            $child = (array) $this->data['storageDetails'];
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
                $child = (array) $this->data['locationProviders'];
                foreach ($child as $el) {
                    $el = (array) $el;
                    $sample->locationProviders()->create([
                        'provider' => $el['provider'],
                    ]);
                }
            }

            if (array_key_exists('features', $this->data)) {
                $child = (array) $this->data['features'];
                foreach ($child as $el) {
                    $el = (array) $el;
                    $sample->features()->create([
                        'key' => $el['key'],
                        'value' => $el['value'],
                    ]);
                }
            }

            if (array_key_exists('processInfos', $this->data)) {
                $child = (array) $this->data['processInfos'];
                foreach ($child as $el) {
                    $el = (array) $el;
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

                    if (array_key_exists('appPermissions', $el)) {
                        $this->addAndroidPermissions($process, $el['appPermissions']);
                    }
                }
            }
        } catch (QueryException $e) {
            Log::error("Failed for upload => $this->upload->id");
            Log::error($e->getMessage());
            DB::rollBack();
        }

        try {
            $this->upload->delete();
        } catch (\Exception $e) {
            Log::error("Failed for upload => $this->upload->id");
            Log::error($e->getMessage());
            DB::rollBack();
        }

        DB::commit();
    }

    private function createSample()
    {
        return $this->device->samples()->create([
            'timestamp' => date('Y-m-d H:i:s', $this->data['timestamp'] / 1000),
            'app_version' => $this->setOptionalValue('version'),
            'database_version' => $this->setOptionalValue('database'),
            'battery_state' => $this->data['batteryState'],
            'battery_level' => $this->data['batteryLevel'],
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
    }

    private function setOptionalValue($key, $default = 0)
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : $default;
    }

    private function addAndroidPermissions($process, $permissions)
    {
        foreach ($permissions as $item) {
            $item = (array) $item;
            $process->permissions()->attach(
                AndroidPermission::firstOrCreate(['permission' => $item['permission']])
            );
        }
    }
}
