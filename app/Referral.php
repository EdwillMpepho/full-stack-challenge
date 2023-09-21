<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class Referral extends Model
{
    protected $reference_no = '';
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
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
     * Sets the Reference_no for encryption before enter db;
     * 
     */
    public function setReferenceNoAttribute($value)
    {
         $this->attributes['reference_no'] = Crypt::encryptString($value);
    } 
    /**
     * Sets the organisation for encryption before enter db;
     * 
     */
    public function setOrganisationAttribute($value)
    {
         $this->attributes['organisation'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the organisation for encryption before enter db;
     * 
     */
    public function setProvinceAttribute($value)
    {
        $this->attributes['province'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the district for encryption before enter db;
     * 
     */
    public function setDistrictAttribute($value)
    {
        $this->attributes['district'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the city for encryption before enter db;
     * 
     */
    public function setCityAttribute($value)
    {
        $this->attributes['city'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the street address for encryption before enter db;
     * 
     */
    public function setStreetAddressAttribute($value)
    {
        $this->attributes['street_address'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the country for encryption before enter db;
     * 
     */
    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the email for encryption before enter db;
     * 
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the website for encryption before enter db;
     * 
     */
    public function setWebsiteAttribute($value)
    {
        $this->attributes['website'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the zipcode for encryption before enter db;
     * 
     */
    public function setZipCodeAttribute($value)
    {
        $this->attributes['zipcode'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the gps location for encryption before enter db;
     * 
     */
    public function setGpsLocationAttribute($value)
    {
        $this->attributes['gps_location'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the facility type for encryption before enter db;
     * 
     */
    public function setFacilityTypeAttribute($value)
    {
        $this->attributes['facility_type'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the position for encryption before enter db;
     * 
     */
    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the provider name for encryption before enter db;
     * 
     */
    public function setProviderNameAttribute($value)
    {
        $this->attributes['provider_name'] = Crypt::encryptString($value);
    } 
    /*
     * Sets the phone for encryption before enter db;
     * 
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = Crypt::encryptString($value);
    } 
     /**
     * Decrypts the reference number for display
     * 
     */
    public function getReferenceNoAttribute()
    {
      return Crypt::decryptString($this->attributes['reference_no']);
    }
    /**
     * Decrypts the organisation for display
     * 
     */
    public function getOrganisationAttribute()
    {
      return Crypt::decryptString($this->attributes['organisation']);
    }
    /**
     * Decrypts the province for display
     * 
     */
    public function getProvinceAttribute()
    {
       return Crypt::decryptString($this->attributes['province']);
    }
    /**
     * Decrypts the district for display
     * 
     */
    public function getDistrictAttribute()
    {
       return Crypt::decryptString($this->attributes['district']);
    }
    /**
     * Decrypts the city for display
     * 
     */
    public function getCityAttribute()
    {
       return Crypt::decryptString($this->attributes['city']);
    } 
    /**
     * Decrypts the street address for display
     * 
     */
    public function getStreetAddressAttribute()
    {
       return Crypt::decryptString($this->attributes['street_address']);
    }              
    /**
     * Decrypts the country for display
     * 
     */
    public function getCountryAttribute()
    {
       return Crypt::decryptString($this->attributes['country']);
    } 
    /**
     * Decrypts the email for display
     * 
     */
    public function getEmailAttribute()
    {
       return Crypt::decryptString($this->attributes['email']);
    }
    /**
     * Decrypts the website for display
     * 
     */
    public function getWebsiteAttribute()
    {
       return Crypt::decryptString($this->attributes['website']);
    }  
    /**
     * Decrypts the zipcode for display
     * 
     */
    public function getZipCodeAttribute()
    {
       return Crypt::decryptString($this->attributes['zipcode']);
    } 
    /**
     * Decrypts the gps location for display
     * 
     */
    public function getGpsLocationAttribute()
    {
       return Crypt::decryptString($this->attributes['gps_location']);
    }           
    /**
     * Decrypts the facilty type for display
     * 
     */
    public function getFacilityTypeAttribute()
    {
       return Crypt::decryptString($this->attributes['facility_type']);
    }
    /**
     * Decrypts the provider name for display
     * 
     */
    public function getProviderNameAttribute()
    {
       return Crypt::decryptString($this->attributes['provider_name']);
    } 
    /**
     * Decrypts the phone for display
     * 
     */
    public function getPhoneAttribute()
    {
       return Crypt::decryptString($this->attributes['phone']);
    }  
    /**
     * Decrypts the phone for display
     * 
     */
    public function getPositionAttribute()
    {
       return Crypt::decryptString($this->attributes['position']);
    }    

    public static function getCountries(){
    	return DB::table('referrals')->pluck('country')->unique();
    }

    public static function getCities($country){
    	return DB::table('referrals')->where("country", $country)->pluck('city')->unique();
    }

}
