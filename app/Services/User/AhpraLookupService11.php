<?php

namespace App\Services\User;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class AhpraLookupService11
{
    protected $client;
    protected $url = 'https://www.ahpra.gov.au/Registration/Registers-of-Practitioners.aspx';

    public function __construct()
    {
        $this->client = new Client([
            'cookies' => true,
            'verify' => false, // Disable SSL verify (not recommended for prod)
            'headers' => [
                'User-Agent' => 'Mozilla/5.0',
            ],
        ]);
    }

    public function lookup(string $regNumber): array
    {
        // Step 1: GET the search page to grab VIEWSTATE tokens
        $res = $this->client->request('GET', $this->url);
        $html = (string) $res->getBody();

        // if (empty($html)) {
        //     echo 'No content retrieved!';
        // } else {
        //     echo 'Content retrieved successfully!';
        // }die;

        $crawler = new Crawler($html);

        $viewstate = $crawler->filter('input[name="__VIEWSTATE"]')->attr('value');
        $viewstategen = $crawler->filter('input[name="__VIEWSTATEGENERATOR"]')->attr('value');
        $eventvalidation = $crawler->filter('input[name="__EVENTVALIDATION"]')->attr('value');

        // Step 2: POST the search form
        $formData = [
            '__EVENTTARGET' => '',
            '__EVENTARGUMENT' => '',
            '__VIEWSTATE' => $viewstate,
            '__VIEWSTATEGENERATOR' => $viewstategen,
            '__EVENTVALIDATION' => $eventvalidation,
            'ctl00$MainContent$txtRegistrationNumber' => $regNumber,
            'ctl00$MainContent$btnSearch' => 'Search'
        ];

        $res = $this->client->request('POST', $this->url, [
            'form_params' => $formData
        ]);

        $resultHtml = (string) $res->getBody();

        // Step 3: Parse response
        return $this->extractDetails($resultHtml);
    }

    protected function extractDetails($html): array
    {
        $crawler = new Crawler($html);
        $labels = [
            'Division',
            'Endorsements',
            'Registration Type',
            'Registration Status',
            'Notations',
            'Conditions',
            'Expiry Date',
            'Principal Place of Practice',
            'Other Places of Practice'
        ];

        $data = [];

        foreach ($labels as $label) {
            try {
                $node = $crawler->filterXPath("//td[contains(text(), '$label')]/following-sibling::td");
                $data[$label] = trim($node->text());
            } catch (\Exception $e) {
                $data[$label] = null;
            }
        }

        return $data;
    }
}
