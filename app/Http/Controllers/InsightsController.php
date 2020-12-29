<?php

namespace App\Http\Controllers;

use App\Http\Torre\TorreAPI;

class InsightsController extends Controller
{
    public function insights($org)
    {
        $torre = new TorreAPI();
        $people = $torre->people($org);
        return $people;
//        $res = [];
//        foreach ($people['results'] as $person) {
//            $res[] = trim(explode(',', $person['locationName'])[1]);
//        }
//        return $res;
    }

    public function organizations($org): array
    {
        $torre = new TorreAPI();
        return $torre->organizations($org);
    }
}
