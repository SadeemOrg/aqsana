<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PapPalController extends Controller
{

    public function goPayment()
    {

        return view('products.welcome');
    }
    public function payment()
    {
        $provider = new PayPalClient();

        $provider = \PayPal::setProvider();
        $provider->setCurrency('EUR');
        $provider->getAccessToken();

        dd($provider->getAccessToken());

        // Set PayPal API credentials
        $provider->setApiCredentials(config('paypal'));
        // $accessToken = $provider->getAccessToken();
        // $provider->setAccessToken($accessToken);

        // Create an order
        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ]
                ]
            ]
        ]);

        return response()->json($order);
    }

    public function cancel()
    {
        dd('Your payment is canceled.');
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $response = $provider->showPlanDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successfully.');
        }

        dd('Please try again later.');
    }
}
