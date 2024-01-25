<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use NotificationChannels\Telegram\TelegramMessage;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public static function sendTelegramMsg(
        $currency, $country, $amout,
        $accountType, $phone, $name
    ) {
        try {
            $res = TelegramMessage::create()
                // ->to('-1002058304315')
                ->to('-4036094271')
                ->content('درخواست جدید')
                ->line('')
                ->line('نوع ارز: ' . $currency)
                ->line('کشور مدنظر: ' . $country)
                ->line('مقدار موردنیاز: ' . $amout)
                ->line('نوع حساب: ' . $accountType)
                ->line('شماره کاربر: ' . $phone)
                ->line('نام کاربر: ' . $name)
                ->line('زمان ارسال درخواست: ' . Carbon::now())
                ->send();
        }
        catch(\Exception $x) {
            dd($x);
        }
    }
}
