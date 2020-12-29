<?php

namespace App\Http\Controllers;

use App\Http\Torre\TorreAPI;

class InsightsController extends Controller
{
    public function index()
    {
        $torre = new TorreAPI();
        return $torre->organizations('Torre');
//        $people = $torre->people();
//        return $people;
//        $res = [];
//        foreach ($people['results'] as $person) {
//            $res[] = trim(explode(',', $person['locationName'])[1]);
//        }
//        return $res;
    }
}
