<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    private $apiKey = '4ad9126a1f97c33e5930db5297993398';

    public function index()
    {
        return view('weather');
    }

    public function checkWeather(Request $request)
    {
        $city = $request->input('city');
        $url = "http://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$this->apiKey}&units=metric";

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $weatherData = $response->json();
                return response()->json([
                    'city' => $city,
                    'weatherData' => $weatherData,
                ]);
            } else {
                return response()->json([
                    'error' => 'Kota tidak ditemukan atau API bermasalah.',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menghubungi API.',
            ], 500);
        }
    }
}
