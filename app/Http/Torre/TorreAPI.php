<?php


namespace App\Http\Torre;


use Illuminate\Support\Facades\Http;

class TorreAPI
{
    public function people($org = ''): array
    {
        $query_params = [
            'currency' => 'USD$',
            'page' => 0,
            'lang' => 'en',
            'size' => 5000, //max size allowed
            'offset' => 0,
            'aggregate' => 'true'
        ];
        $payload = [
            'organization' => ['term' => $org]
        ];
//            'or' => [
//                [
//                    'organization' => ['term' => 'Torre']
//                ],
//                [
//                    'organization' => ['term' => 'Torre Labs']
//                ]
//            ]
        $url = 'https://search.torre.co/people/_search?' . http_build_query($query_params);
        $response = Http::post($url, $payload);
        if ($response->successful()) {
            return $response->json();
        }
        return [];
    }
}
