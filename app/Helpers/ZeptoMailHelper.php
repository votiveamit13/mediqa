<?php

namespace App\Helpers;

use App\Mail\Transport\ZeptoMailTransport;
use GuzzleHttp\Client;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\SentMessage;
use Illuminate\Support\Facades\Log;

class ZeptoMailHelper
{
    public static function sendMail($to, $subject, $htmlBody, $textBody = null, $from = null)
    {
        $from = $from ?? config('mail.from.address');

        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($htmlBody);

        if ($textBody) {
            $email->text($textBody);
        }

        $transport = new ZeptoMailTransport(
            new Client(),
            env('ZEPTOMAIL_TOKEN'),
            env('ZEPTOMAIL_ENDPOINT')
        );

        $transport->send($email);

        return true;
    }
}

if (!function_exists('sendMail')) {
    function sendMail($to, $subject, $htmlBody, $textBody = null, $from = null)
    {
        return \App\Helpers\ZeptoMailHelper::sendMail($to, $subject, $htmlBody, $textBody, $from);
    }
}
