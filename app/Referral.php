<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Delatbabel\Elocrypt\Elocrypt;
use Eloquent;

class Referral extends Eloquent
{
   use Elocrypt;
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $encrypts = [
        'reference_no',
        'organisation',
        'province',
        'district',
        'city',
        'street_address',
        'country',
        'email',
        'website',
        'zipcode',
        'gps_location',
        'facility_type',
        'position',
        'provider_name',
        'phone',
    ];
    
    /**
     *  The attributes that are hidden
     * 
     * @var array
     */
    protected $hidden = [
        'reference_no',
         'organisation',
        'province',
        'district',
        'city',
        'street_address',
        'country',
        'email',
        'website',
        'zipcode',
        'gps_location',
        'facility_type',
        'position',
        'provider_name',
        'phone',
    ];
    
    /**
     * The attributes to be cast
     * 
     * @var array
     */
    protected $casts = [
        'created_at ' => 'datetime',
        'reference_no' => 'encrypted',
        'organisation' => 'encrypted',
        'province' => 'encrypted',
        'district' => 'encrypted',
        'city' => 'encrypted',
        'street_address' => 'encrypted',
        'country' => 'encrypted',
        'email' => 'encrypted',
        'website' => 'encrypted',
        'zipcode' => 'encrypted',
        'gps_location' => 'encrypted',
        'facility_type' => 'encrypted',
        'position' => 'encrypted',
        'provider_name' => 'encrypted',
        'phone' => 'encrypted',
    ];
    
    public static function getCountries(){
    	return DB::table('referrals')->pluck('country')->unique();
    }

    public static function getCities($country){
    	return DB::table('referrals')->where("country", $country)->pluck('city')->unique();
    }
}
