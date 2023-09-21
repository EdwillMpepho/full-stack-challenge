@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 65px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>All Posts</h1></div>

                <div class="panel-body">
                    @include('errors')
                    <div class="table-responsive" style="margin-top:20px;">
                      <!-- check if there users -->
                      @if (count($posts) > 0)
                       <table class="table table-striped">
                        <tr>
                            <th>Post ID</th>
                            <th>Post Title</th>
                            <th>Author Name</th>
                            <th>Author Email</th>
                        </tr>
                        @foreach($posts as $post)
                        <tr>
                            <td><a href="/posts/{{ $post->id }}">
                                {{  $post->id }}
                               </a>
                            </td>
                            <td>{{  $post->title }}</td>
                            <td>{{  $post->name }}</td>
                            <td>{{  $post->email }}</td>
                         </tr>
                        @endforeach
                       </table>
                      @else
                         <div class="panel-heading">There are no post found</div>
                      @endif
                   </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
