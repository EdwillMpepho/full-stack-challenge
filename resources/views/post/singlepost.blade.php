@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 65px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>{{ $post->title }}</h1></div>
                <div class="panel-body"><p>{{ $post->body }}</p></div>
            </div>
        </div>
    </div>
</div>
@endsection
