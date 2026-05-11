<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\MailManager;
use App\Mail\Transport\ZeptoMailTransport;
use GuzzleHttp\Client;

class ZeptoMailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app(MailManager::class)->extend('zeptomail', function ($config) {
            return new ZeptoMailTransport(
                new Client(),
                env('ZEPTOMAIL_TOKEN'),
                env('ZEPTOMAIL_ENDPOINT')
            );
        });
    }
}
