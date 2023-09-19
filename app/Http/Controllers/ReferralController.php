<?php

namespace App\Http\Controllers;

use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReferralController extends Controller
{
    public function __construct() {
       // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($country=null, $city=null)
    {
        // echo $country; 

        $countries = array();
        $cities = array();
        $country_filter = false;
        //
        if($country == null) { 
            $referrals = Referral::paginate(15);
            $countries = Referral::getCountries();
        }
        elseif($city == null) {
            $country_filter = true;
            $referrals = Referral::where("country", $country)->paginate(15);
            $countries = array($country);
            $cities = Referral::getCities($country);
        }
        else {
            $country_filter = true;
            $referrals = Referral::where("country", $country)->where("city", $city)->paginate(15);
            $countries = array($country);
            $cities = array($city);
        }
        
        return view('referrals.index', compact('referrals', 'countries', 'cities'))->with('country_filter', $country_filter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('referrals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //
        $this->validate(request(), [
                'reference_no' => 'required',
                'organisation' => 'required',
                'province' => 'required',
                'district' => 'required',
                'provider_name' => 'required',
                'phone' => 'required'
            ]);
        /*
        Referral::create([
                "reference_no" => request("reference_no"),
                "organisation" => request("organisation"),
                "province" => request("province"),
                "district" => request("district"),
                "city" => request("city"),
                "street_address" => request("street_addr"),
                "country" => request("country"),
                "email" => request("email"),
                "website" => request("website"),
                "zipcode" => request("zipcode"),
                "facility_type" => request("facility_type"),
                "gps_location" => request("gps_location"),
                "position" => request("position"),
                "provider_name" => request("provider_name"),
                "phone" => request("phone")
            ]);
            */
            $referral = new Referral;
            $referral->reference_no = request("reference_no");
            $referral->organisation = request("organisation");
            $referral->province = request("province");
            $referral->district = request("district");
            $referral->city = request("city");
            $referral->street_address = request("street_addr");
            $referral->country = request("country");
            $referral->email = request("email");
            $referral->website =request("website");
            $referral->zipcode = request("zipcode");
            $referral->facility_type = request("facility_type");
            $referral->gps_location = request("gps_location");
            $referral->position = request("position");
            $referral->provider_name = request("provider_name");
            $referral->phone = request("phone");
            $referral->save();

        return redirect('referrals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referral $referral)
    {
        //
    }

    public function upload() {
        return view('referrals.upload');
    }

    public function processUpload(Request $request) {
        $cols = array('country',
            'reference_no',
'organisation',
'province',
'district',
'city',
'street_address',
'gps_location',
'facility_name',
'facility_type',
'provider_name',
'position',
'phone',
'email',
'website',
'pills_available',
'code_to_use',
'type_of_service',
'note',
'womens_evaluation');
        if ($request->file('referral_file')->isValid()) {
            // echo $request->referral_file->extension();
            // echo "<hr />";
            // echo $request->referral_file->path();
            if($request->referral_file->extension() == "txt") {
                $file = fopen($request->referral_file->path(), "r");
                $all_data = array();
                $ctr = 0;
                $failed = array();
                while (($data = fgetcsv($file, 200, ",")) !==FALSE ) {
                    // print_r($cols); 
                    // print_r($data);
                    if(count($cols) == count($data)) {
                        $arr = array_combine($cols, $data);
                        Referral::create($arr);    
                        $ctr++;
                    }
                    else {
                        $failed[] = $data[1];
                        Log::critical("Failed - data c = " . count($data).  " field c = " . count($cols) . " => ".implode(',', $data));
                    }
                    // print_r($arr);

                    // break;
                    // echo "<hr />";
                    // $ctr++;
                    $request->session()->flash('status', $ctr . ' records uploaded successful!');
                    if(count($failed)>0) {
                        $request->session()->flash('error', "Reference Nos. " . implode(',', $failed) . ' failed to upload!');    
                    }
                    
                }
            }
        }
        return redirect('referrals');
    }
}
