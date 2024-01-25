<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Request as CurrencyRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success(CurrencyRequest $request)
    {
        return view('newDesign.success', ['trackingCode' => $request->tracking_code]);
        // return view('success', ['trackingCode' => $request->tracking_code]);
    }

    public function err()
    {
        return view('newDesign.error');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'currency' => 'required|integer|exists:currency,id',
            'country' => 'required|integer|exists:country,id',
            'accountType' => [
                'required', 
                Rule::in([CurrencyRequest::COMPANY_ACCOUNT, CurrencyRequest::INDIVIDUAL_ACCOUNT])
            ],
            'amount' => 'required|integer|min:0',
            'phone' => 'required|regex:/[0-9]{4,12}/',
            'name' => 'required|string|min:2|max:50'
        ]);

        $trackingCode = random_int(10000, 99999);

        $currencyReq = CurrencyRequest::create([
            'country_id' => $request['country'],
            'currency_id' => $request['currency'],
            'account_type' => $request['accountType'],
            'amount' => $request['amount'],
            'phone' => $request['phone'],
            'name' => $request['name'],
            'tracking_code' => $trackingCode
        ]);
        
        // TelegramBotController::sendTelegramMsg(
        //     Currency::find($request['currency'])->name, 
        //     Country::find($request->country)->name,
        //     number_format($request['amount'], 0),
        //     $request['accountType'] == CurrencyRequest::INDIVIDUAL_ACCOUNT ? 'شخصی' : 'شرکتی',
        //     $request['phone'], $request['name']
        // );

        return response()->json([
            'status' => 'ok',
            'url' => route('new-success', ['request' => $currencyReq->id])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
