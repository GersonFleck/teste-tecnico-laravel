<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class NbaController extends Controller
{
public function index()
{
    try {
        $response = Http::withOptions([
            'verify' => storage_path('app/cacert.pem')
        ])->withHeaders([
            'Authorization' => env('BALLDONTLIE_API_KEY')
        ])->get('https://api.balldontlie.io/v1/players', [
            'per_page' => 10
        ]);

        return view('nba.index', [
            'players' => $response->json()['data'],
            'error' => null
        ]);

    }  catch (\Illuminate\Http\Client\RequestException $e) {
    return view('nba.index', [
        'players' => [],
        'error' => 'Erro na API: ' . $e->getMessage()
    ]);
}
}
}