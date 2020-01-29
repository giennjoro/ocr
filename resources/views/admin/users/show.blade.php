@extends('admin.layouts.app')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><i class="fa fa-user"></i> {{ $user->name }}</h3>
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div
            class="col-md-6 col-sm-6 col-xs-12 {{ Auth::user() == $user || Auth::user()->type == 'super' || !$user->is_admin? '': 'col-md-offset-3' }}">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $user->is_admin? 'Admin' : 'User' }} Details</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Name</b> <a class="pull-right">{{ $user->name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Member Since</b> <a
                                class="pull-right">{{ date('F d, Y', strtotime($user->created_at)) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a
                                class="pull-right">{{ $user->phone == ''? 'Not available': $user->phone }}</a>
                        </li>
                        <li class="list-group-item {{ $user->type == 'super'? '': 'hidden'}}">
                            <b>Admin Status</b> <a class="pull-right">Super Admin</a>
                        </li>
                        <li class="list-group-item {{ $user->type == 'ordinary'? '': 'hidden'}}">
                            <b>Admin Status</b> <a class="pull-right">Ordinary Admin</a>
                        </li>
                        <li class="list-group-item {{ $user->type == 'user'? '': 'hidden'}}">
                            <b>User Type</b> <a class="pull-right">Doublequick User</a>
                        </li>
                    </ul>
                    <br><br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                            @if (Auth::user() == $user || Auth::user()->type == 'super' || !$user->is_admin)
                            <!-- Small modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target=".bs-example-modal-sm">Delete Account</button>

                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel2">Delete Account</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Confirmation</h4>
                                            <p>Are you sure you want to delete this account for {{ $user->name }}? This
                                                action cannot be
                                                undone once confirmed.</p>

                                        </div>
                                        {!! Form::open(['action' => ['UsersController@destroy', $user->slug], 'method'
                                        => 'DELETE'])
                                        !!}
                                        @csrf
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Cancel</button>
                                            @csrf
                                            <button class="btn btn-xs btn-danger" type="submit">Delete</button>

                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user() == $user || Auth::user()->type == 'super' || !$user->is_admin)
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit <small>{{ $user->is_admin? 'Admin' : 'User' }} Details</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    {!! Form::open(['action' => ['UsersController@update', $user->slug],'data-parsley-validate' ,'class'
                    =>'form-horizontal form-label-left', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" required="required"
                                class="form-control col-md-7 col-xs-12" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="email" name="email" required="required"
                                class="form-control col-md-7 col-xs-12" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="phone" name="phone" class="form-control col-md-7 col-xs-12"
                                value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span
                                class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12"
                                placeholder="Type Password ONLY IF You Need To Change!">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_password">Confirm
                            Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="confirm_password" name="confirm_password"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div
                        class="@if(Auth::user()->type != 'super' || !$user->is_admin ) hidden @endif form-group text-center">
                        <input type="checkbox" name="super" @if($user->type == 'super') checked @endif>
                        {{ Form::label('super', 'Make Super Admin') }}
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Recent Subscriptions | <small> {{ $user->name}}</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="row" width='23px' class="d-none d-md-table-cell"><img style="width:20px">
                                </th>
                                <!--<th class="selector h5"><button class="button-check"></button></th>-->
                                <th><span>Plan</span></th>
                                <th><span>Subscription date</span></th>
                                <th><span>Expiry Date</span></th>
                                <th><span>Amount</span></th>
                                <th><span>Status</span></th>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($subscriptions as $subscription)
                            <tr>
                                <th scope="row" width='23px' class="d-none d-md-table-cell"><img style="width:20px"
                                        src="{{asset('client/images/icons/football.svg') }}" alt=""></th>
                                <td><a
                                        href="/plans">{{ $subscription->plan != null? $subscription->plan->title: '__' }}</a>
                                </td>
                                <td>{{ date('l jS M, h:i a', strtotime($subscription->created_at)) }}</td>
                                <td>{{ date('l jS M, h:i a', strtotime($subscription->expiry_date)) }}</td>
                                <td>KES {{ $subscription->amount }}</td>
                                @if ($subscription->expiry_date < now()->format('Y-m-d H:i:s'))
                                    <td><span class="badge badge-danger">Expired</span></td>
                                    @else
                                    <td><span class="badge badge-success">Active</span></td>
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