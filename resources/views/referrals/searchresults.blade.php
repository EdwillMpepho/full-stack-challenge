@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top:65px">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-default">
                     <div class="panel-heading">
                         <h1>Search Results</h1>
                     </div>
                     @if (count($record_array) > 0 )
                       <div class="panel-body">
                           <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Country</th>
                                    <th>Reference No</th>
                                    <th>Organisation</th>
                                    <th>Province</th>
                                    <th>District</th>
                                    <th>City</th>
                                    <th>Street Address</th>
                                    <th>Gps Location</th>
                                    <th>Facility Name</th>
                                    <th>Facility Type</th>
                                    <th>Provider Name</th>
                                    <th>Position</th>
                                    <th>Phone</th>
                                    <th>eMail</th>
                                    <th>Website</th>
                                    <th>Pills Available</th>
                                    <th>Code To Use</th>
                                    <th>Type of Service</th>
                                    <th>Note</th>
                                    <th>Womens Evaluation</th>
                                </tr>
                                @foreach($record_array as $referral)
                                <tr>
                                    <td>{{ $referral->country }} </td>
                                    <td>{{ $referral->reference_no }} </td>
                                    <td>{{ $referral->organisation }} </td>
                                    <td>{{ $referral->province }} </td>
                                    <td>{{ $referral->district }} </td>
                                    <td>{{ $referral->city }} </td>
                                    <td>{{ $referral->street_address }} </td>
                                    <td>{{ $referral->gps_location }} </td>
                                    <td>{{ $referral->facility_name }} </td>
                                    <td>{{ $referral->facility_type }} </td>
                                    <td>{{ $referral->provider_name }} </td>
                                    <td>{{ $referral->position }} </td>
                                    <td>{{ $referral->phone }} </td>
                                    <td>{{ $referral->email }} </td>
                                    <td>{{ $referral->website }} </td>
                                    <td>{{ $referral->pills_available }} </td>
                                    <td>{{ $referral->code_to_use }} </td>
                                    <td>{{ $referral->type_of_service }} </td>
                                    <td>{{ $referral->note }} </td>
                                    <td>{{ $referral->womens_evaluation }} </td>
                                </tr>
                                @endforeach
                            </table>
                           </div>
                        </div>  
                     @else
                        <div class="panel-footer">
                            <p>Not Found</p>
                        </div> 
                     @endif
                </div>
            </div>
        </div>
    </div>
@endsection