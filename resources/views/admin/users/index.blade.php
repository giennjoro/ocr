@extends('admin.layouts.app')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>{{ $user_type }}s <small>List of all {{ $user_type }}s</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $user_type }}s Details <small>{{ $user_type }}s</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>View</th>
                                @if (Auth::user()->type == 'super' || $user_type == 'User')
                                <th>Delete</th>
                                @endif
                            </tr>
                        </thead>


                        <tbody>

                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users.show', ['slug' => $user->slug]) }}"
                                        class="btn btn-xs btn-primary">View</a>
                                </td>
                                @if (Auth::user()->type == 'super' || $user_type == 'User')
                                <td>
                                    <!-- Small modal -->
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                        data-target=".{{ $user->slug }}">Delete</button>

                                    <div class="modal fade bs-example-modal-sm {{ $user->slug }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel2">Remove {{ $user_type }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Confirmation</h4>
                                                    <p>Are you sure you want to remove {{ $user->name }}?</p>

                                                </div>
                                                {!! Form::open(['action' => ['UsersController@destroy', $user->slug], 'method' => 'DELETE']) !!}
                                                    @csrf
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-xs btn-default"
                                                            data-dismiss="modal">Cancel</button>
                                                        @csrf
                                                        <button class="btn btn-xs btn-danger" type="submit">Remove</button>

                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
