<?php

namespace App\Http\Controllers;

use App\Http\GeoCode\GeoCode;
use App\Http\Torre\TorreAPI;

class InsightsController extends Controller
{
    private $torre;
    private $geocoder;

    public function __construct()
    {
        $this->torre = new TorreAPI();
        $this->geocoder = new GeoCode();
    }

    public function insights($org): \Illuminate\Http\JsonResponse
    {
        $people = $this->torre->people($org);
        return response()->json([
            'total' => $people['total'],
            'remoter' => $this->formatRemoterData($people['aggregators']['remoter']),
            'skill' => $people['aggregators']['skill'],
            'compensationrange' => $people['aggregators']['compensationrange'],
            'map' => $this->mapData($people),
            'success' => true
        ]);
    }

    public function organizations($org): array
    {
        return $this->torre->organizations($org);
    }

    private function mapData($people): array
    {
        $map = [];
        $location_count = [];
        $undefined_location_count = 0;
        foreach ($people['results'] as $person) {
            if (!empty($person['locationName'])) {
                $location_array = explode(',', $person['locationName']);
                $country = preg_replace("/[^a-zA-Z]/", "", end($location_array));//The reason I am sorting by country is to lower the geocoder waiting time
                isset($location_count[$country]) ? $location_count[$country]++ : $location_count[$country] = 1;
            } else {
                $undefined_location_count++;// do nothing for now
            }
        }
        foreach ($location_count as $location => $count) {
            $geocoded_address = $this->geocoder->GeoCodeAddress($location);
            if (!empty($geocoded_address)) {
                $map[] = [
                    'name' => $location . ': ' . $count . ' profile(s) associated',
                    'center' => [$geocoded_address['lat'], $geocoded_address['lng']],
                    'radius' => $count
                ];
            }
        }

        return $map;
    }

    private function formatRemoterData($items): array
    {
        $labels = [];
        $data = [];
        foreach ($items as $item) {
            $labels[] = 'Said ' . $item['value'];
            $data[] = $item['total'];
        }
        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}
