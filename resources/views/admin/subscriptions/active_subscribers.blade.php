@extends('admin.layouts.app')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Subscribers <small>List of all active Subscribers</small></h3>
        </div>
    </div>
    <form action="{{ route('mpesa.search') }}" method="post">
        @csrf
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" name="my_query" class="form-control" placeholder="Search for...">
                    <input type="text" name="param" style="display: none" value="{{ $param }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </form>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Subscribers Details</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Expiry</th>
                                <th>View</th>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ date('l jS M, h:i a', strtotime($user->subscription_expiry)) }}</td>
                                <td>
                                    <a href="{{ route('users.show', ['slug' => $user->slug]) }}"
                                        class="btn btn-xs btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#datatable').DataTable( {
        "order": [[ 2, "asc" ]]
    } );
} );
</script>
@endsection