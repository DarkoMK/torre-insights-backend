<?php


namespace App\Http\GeoCode;


use Illuminate\Support\Facades\Http;

class GeoCode
{
    public function GeoCodeAddress($address): array
    {
        $url = 'https://geocode.localfocus.nl/geocode.php';
        $response = Http::get($url, [
            'q' => $address
        ]);
        if ($response->successful()) {
            return empty($response->json()) ? [] : $response->json()[0];
        }
        return [];
    }
}
