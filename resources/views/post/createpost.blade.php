@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 65px;">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h1>Post Comment</h1>
                </div>
                <div class="panel-body">
                    <h3>{{ Auth::user()->name }} post your comment</h3>
                    @if (Auth::check())
                        <form action="#" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="comment" id="" cols="30" rows="10" class="form-control">

                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">post comment</button>
                        </form>
                    @else
                      <div class="panel-footer">
                          <p>You Are Unauthorized, please log in and post comments</p>
                      </div>  
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection