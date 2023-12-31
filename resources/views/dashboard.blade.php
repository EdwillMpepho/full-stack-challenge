@extends('layouts.app')
@section('content')
  <div class="container"  style="margin-top: 65px;">
     <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               @if (Auth::user()->role == 0 )
                 <div class="panel-heading">Add New User</div>  
                <div class="panel-body">
                  <a href="/user/create" class="btn btn-info">Add User</a>
                  <a href="/allusers" class="btn btn-success">View Users</a>
                </div> 
               @endif
               @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                  <div class="panel-heading">Add Bulk Upload  View The Referrals</div>  
                  <div class="panel-body">
                     <a href="/referrals/create" class="btn btn-default">Add Single Referrals</a>
                     <a href="/referrals/upload" class="btn btn-primary">Bulk Upload Referrals</a>
                     <a href="#" class="btn btn-warning">View Referrals</a>
                  </div>
               @endif
               @if (Auth::user()->role == 0 || Auth::user()->role == 1  || Auth::user()->role == 2 )
               <div class="panel-heading">View Referrals</div>  
              <div class="panel-body">
                <a href="/referrals" class="btn btn-info">View Referrals And Post Comments</a>
                <a href="/posts" class="btn btn-dark">View All Post</a>
              </div> 
             @endif
            </div>
     </div>          
  </div>
@endsection
