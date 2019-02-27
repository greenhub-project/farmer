<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Farmer\Models\Protocol\Sample;
use App\Farmer\Models\Protocol\Device;
use App\Farmer\Models\User;

class DailyStatsSummary extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                    ->from('GreenHub Farmer')
                    ->image('https://farmer.greenhubproject.org/images/brand.png')
                    ->content(env('APP_NAME') . '\'s Daily Summary')
                    ->attachment(function ($attachment) {
                        $attachment->title('Daily Stats for ' . now()->format('M jS, Y'), env('APP_URL'))
                                    ->fields([
                                        'Samples' => Sample::count(),
                                        'Users' => User::count(),
                                        'Devices' => Device::count(),
                                    ]);
                    });
    }
}
