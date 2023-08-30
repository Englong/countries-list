<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function index(Request $request)
    {
            $currentPage = request('page', 1); // Get the current page from the request query parameters
            $data = Http::get('https://restcountries.com/v3.1/all');

            $collection = new Collection($data->json());
            $collection = $collection->map(function ($item) {
                return [
                    ...$item,
                    'country_name' => $item['name']['official'] ?? 'testing'
                ];
            })->sortBy('country_name');
            $paginatedData = new LengthAwarePaginator(
                $collection->forPage($currentPage, 25),
                $collection->count(),
                25,
                $currentPage,
                ['path' => 'https://restcountries.com/v3.1/all']
            );
            return response()->json($paginatedData)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
}
