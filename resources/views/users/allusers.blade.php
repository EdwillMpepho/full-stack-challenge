@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 65px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>All Users</h1></div>

                <div class="panel-body">
                    @include('errors')
                    <div class="table-responsive" style="margin-top:20px;">
                      <!-- check if there users -->
                      @if (count($users) > 0)
                       <table class="table table-striped">
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Delete User</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }} </td>
                            <td>{{ $user->email }} </td>
                            <td>
                                <form action="/user/{{ $user->id }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn btn-danger">remove user</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                       </table>
                      @else
                         <div class="panel-heading">There are no users present</div>
                      @endif
                   </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
