<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DonationsController extends BaseController
{

    public function index()
    {

        $donations = Donations::where('user_id', Auth()->id())->with("project", "bus")->get();

        return $this->sendResponse($donations, 'Success get all donations');
    }


    public function store(Request $request)
    {
        $requestData = $request->all();
        $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        // Convert Arabic numbers to English
        if ($request->has("donation_amount")) {
            $requestData["donation_amount"] = str_replace($arabicNumbers, $englishNumbers, $request->get("donation_amount"));
        }

        // Validate the request data
        $validator = Validator::make($requestData, [
            'donor_name' => 'required|string',
            'donation_amount' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $donor_name = $request->get("donor_name");
        if (Auth::check()) {
            $donor_name = Auth::user()->name;
        }

        // Create the donation
        $donation = Donations::create([
            'project_id' => $request->get("project_id"),
            'project_type' => $request->get("project_type"),
            'donor_name' => $donor_name,
            'amount' => $requestData["donation_amount"], // Use the converted amount
            'bus_id' => $request->get("bus_id"),
            'user_id' => Auth::id(),
            'number_of_people' => $request->get("number_of_people"),
        ]);

        // Insert into transactions table
        DB::table('transactions')->insert([
            'main_type' => '1',
            'type' => '2',
            'ref_id' => $request->get("project_id"),
            'Currency' => '3',
            'transact_amount' => $requestData["donation_amount"], // Use the converted amount
            'equivelant_amount' => $requestData["donation_amount"], // Use the converted amount
            'transaction_date' => date('Y-m-d'),
        ]);

        return $this->sendResponse($donation, 'Success create donation');
    }
}
