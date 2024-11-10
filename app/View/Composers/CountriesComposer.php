<?php

namespace App\View\Composers;
 
//use GuzzleHttp\Client;
use Illuminate\View\View;
 
class CountriesComposer
{
    public function __construct(
    ) {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        
        /* $client = new Client();
        $response = $client->get('https://restcountries.com/v3.1/all', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);
        $countries = array_map(function($item) {
            return $item['translations']['fra']['common'];
        }, $responseData);
        sort($countries); */

        $view->with('countries', [
            "Cote d'ivoire",
            "Cameroun",
            "Burkina Faso",
            "Mali",
            "Ghana",
            "Guinée",
            "Afrique",
            "Europe",
            "USA",
            "Reste Du Monde",
        ]);
    }
}