<?php

namespace App\Mail\Transport;

use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Email;
use GuzzleHttp\Client;
use Symfony\Component\Mailer\Exception\TransportException;

class ZeptoMailTransport extends AbstractTransport
{
    protected $client;
    protected $token;
    protected $endpoint;

    public function __construct(Client $client, $token, $endpoint)
    {
        $this->client = $client;
        $this->token = $token;
        $this->endpoint = $endpoint;

        parent::__construct();
    }

    /**
     * Required by Symfony Mailer (Laravel 10)
     */
protected function doSend(SentMessage $message): void
{
    /** @var Email $email */
    $email = $message->getOriginalMessage();

    // Force strip the "name" from FROM — AU ZeptoMail requires ONLY email
    $fromMailbox = $email->getFrom()[0];

    $payload = [
        "subject" => $email->getSubject(),

        "from" => [
            "address" => $fromMailbox->getAddress(),
        ],

        "to" => collect($email->getTo())->map(function ($addr) {
            return [
                "email_address" => [
                    "address" => $addr->getAddress(),
                    "name"    => $addr->getName() ?: "" // OK for "to"
                ]
            ];
        })->toArray(),

        "htmlbody" => $email->getHtmlBody(),
        "textbody" => $email->getTextBody(),
    ];

    try {
        $this->client->post($this->endpoint, [
            "headers" => [
                "Authorization" => "Zoho-enczapikey {$this->token}",
                "Accept"        => "application/json",
                "Content-Type"  => "application/json",
            ],
            "json" => $payload,
        ]);
    } catch (\Exception $e) {
        throw new TransportException($e->getMessage(), 0, $e);
    }
}


    public function __toString(): string
    {
        return 'zeptomail';
    }
}
