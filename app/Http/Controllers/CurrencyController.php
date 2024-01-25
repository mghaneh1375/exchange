<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyDigest;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    public function update(Request $request) {
        
        $request->validate([
            'price' => 'required|integer|min:0',
            'country' => 'required|integer|exists:country,id'
        ]);

        $country = Country::find($request['country']);

        $country->price = $request->price;
        $country->save();

        return response()->json(['status' => 'ok']);
    }

    public function get(Request $request) {
        $currencies = CurrencyDigest::collection(Currency::all())->toArray($request);
        return view('auth.admin.currency', compact($currencies));
    }

    public function home(Request $request) {
        $currencies = CurrencyDigest::collection(Currency::all())->toArray($request);
        $desc = "نرخ لحظه ای ارز (نرخ میانگین)" . " در اروپا و کانادا" . "\n";
        foreach($currencies as $currency) {
            $desc .= $currency['name'] . ': ' . $currency['countries'][0]['price'] . ' تومان' . "\n";
        }
        
        return view('home', compact('desc', 'currencies'));
    }

    
    public function home2(Request $request) {
        
        $response = Http::get('https://prod.expoarz.com/v1/metrics');
        $avgPrices = null;

        if($response->status() == 200) {
            $response = $response->json();
            if($response['message'] == 'success') {
                $avgPrices = $response['data'];
            }
        }
        $currencies = CurrencyDigest::customCollection(Currency::all(), $avgPrices)->toArray($request);

        $desc = "نرخ لحظه ای ارز (نرخ میانگین)" . " در اروپا و کانادا" . "\n";
        foreach($currencies as $currency) {
            $desc .= $currency['name'] . ': ' . $currency['countries'][0]['price'] . ' تومان' . "\n";
        }
        
        return view('home2', compact('desc', 'currencies'));
    }

    public function getPrice(Request $request) {

        $currencyId = $request->query('currency');

        if($currencyId == null || empty($currencyId)) {
            abort(400);
            return;
        }

        $wantedCurrency = Currency::find($currencyId);
        if($wantedCurrency == null) abort(500);

        $response = Http::get('https://prod.expoarz.com/v1/metrics');
        
        if($response->status() == 200) {
            $response = $response->json();
            if($response['message'] == 'success') {
                foreach($response['data'] as $currency) {
                    if($currency['currency'] == $wantedCurrency->abbr) {
                        return response()->json([
                            'status' => 'ok',
                            'amount' => $currency['average_price'] + $wantedCurrency->price
                        ]);
                    }
                }
            }
        }

        return response()->json(['status' => 'nok', 'msg' => 'service unavailable']);

    }
}
