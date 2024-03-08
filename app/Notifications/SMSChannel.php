<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SMSChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $phone = Str::startsWith($notifiable->phone_number, '0')
            ? '88'.$notifiable->phone_number
            : Str::replaceFirst('+', '', $notifiable->phone_number);

        $ElitBuzz = setting('ElitBuzz');
        if ($ElitBuzz->enabled) {
            return $this->send_sms('https://msg.elitbuzz-bd.com/smsapi', array_merge([
                'type' => 'text',
                'contacts' => $phone,
                'label' => 'transactional',
                'api_key' => $ElitBuzz->api_key,
                'senderid' => $ElitBuzz->sender_id,
            ], $notification->toArray($notifiable)));
        }

        $BDWebs = setting('BDWebs');
        if ($BDWebs->enabled) {
            return $this->send_sms('http://sms.bdwebs.com/smsapi', array_merge([
                'type' => 'text',
                'contacts' => $phone,
                'label' => 'transactional',
                'api_key' => $BDWebs->api_key,
                'senderid' => $BDWebs->sender_id,
            ], $notification->toArray($notifiable)));
        }
    }

    private function send_sms($url, $data)
    {
        Log::info('sending sms:', $data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
