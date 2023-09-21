<?php

namespace App\Http\Controllers;

use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;

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
           // check if user is admin = 0 or supervisor = 1
            if(Auth::user()->role == 0 || Auth::user()->role == 1){
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
            }else{
                return redirect()->route('login')->with('error_message','you are not authorized');
            }
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

    /**
     * Search the given resource
     * 
     * @param $request
     */
    public function search(Request $request)
    {
       
        $query = $request->input('search');
        $filter = $request->input('filter');
        /*
        if(empty($query)){
            return redirect()->back()->with('error_message','the query field is required');
        }
        */
        if(empty($filter)){
            return redirect()->back()->with('error_message','you need to select the filter to search');
        }
       
        $referrals = Referral::all();
        $record_array = [];
        $count =  0;
        
       
            if($filter === 'reference_no'){
              for($i = 0;$i<sizeof($referrals);$i++){
                 if(strtolower($referrals[$i]->reference_no) == strtolower($query)){
                   $record_array[$i] = $referrals[$i];
                 }
             }
            }else if($filter === 'country'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->country) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'organisation'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->organisation) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'province'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->province) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'district'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->district) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'city'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->city) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'street_address'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->street_address) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'zipcode'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->zipcode) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'gps_location'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->gps_location) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'facility_type'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->facility_type) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'facility_name'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->facility_name) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'provider_name'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->provider_name) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'position'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->position) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'phone'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->phone) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'email'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->email) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'website'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->website) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'pills_available'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->pills_available) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'code_to_use'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->code_to_use) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'type_of_service'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->type_of_service) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'note'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->note) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }else if($filter === 'women_evaluation'){
                for($i = 0;$i<sizeof($referrals);$i++){
                   if(strtolower($referrals[$i]->women_evaluation) == strtolower($query)){
                     $record_array[$i] = $referrals[$i];
                   }
               }
            }
        // check if country is not found
        if(count($record_array) <= 0){
            return redirect()->back()->with('error_message','Not Found');
        }
        return $record_array;
    }
}
