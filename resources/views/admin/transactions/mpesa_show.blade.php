@extends('admin.layouts.app')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h2><i class="fa fa-user"></i> Transaction {!! $transaction->resultCode === '0'? '<small style="color: green">Successful<i class="fa fa-check text-success"></i></small>': '<small style="color: red"><i class="fa fa-times text-danger"></i>Failed</small> | <small>Feeling like the transaction went through? <a href="/admin/mpesa/query-request?checkoutRequestID=' . $transaction->checkoutRequestID . '">click here</a></small>' !!}</h2>
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div
            class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Transaction Details</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item" style="overflow:auto">
                            <b>Transaction Date</b> <a class="pull-right">{{ $transaction->resultCode === '0'? $transaction->transactionDate: $transaction->created_at }}</a>
                        </li>
                        <li class="list-group-item" style="overflow:auto">
                            <b>User's Name</b> 
                            @if ($transaction->user != null)
                                <a class="pull-right" href="{{ route('users.show', ['slug' => $transaction->user->slug]) }}">{{ $transaction->user != null? $transaction->user->name: '__' }}</a>
                            @else
                                <a class="pull-right" href="javascript:void(0)">{{ $transaction->user != null? $transaction->user->name: '__' }}</a>
                            @endif
                        </li>
                        <li class="list-group-item" style="overflow:auto">
                            <b>Phone</b> <a class="pull-right">{{ $transaction->phoneNumber }}</a>
                        </li>
                        <li class="list-group-item" style="overflow:auto">
                            <b>Plan</b> <a class="pull-right">{{ $transaction->plan != null? $transaction->plan->title: '__' }}</a>
                        </li>
                        {{-- <li class="list-group-item" style="overflow:auto">
                            <b>Response Status</b> <a class="pull-right"><td>{{ $transaction->responseCode === '0'? 'Successful': $transaction->responseDescription . ': '. $transaction->responseCode }}</td></a>
                        </li>
                        <li class="list-group-item" style="overflow:auto">
                            <b>Checkout Request ID</b> <a class="pull-right">{{ $transaction->checkoutRequestID }}</a>
                        </li>
                        <li class="list-group-item" style="overflow:auto">
                            <b>Merchant Request ID</b> <a class="pull-right">{{ $transaction->merchantRequestID }}</a>
                        </li> --}}
                        @if ($transaction->responseCode === '0')
                            <li class="list-group-item" style="overflow:auto">
                                <b>Result Status</b> <a class="pull-right">
                                    {{ $transaction->resultCode === '0'? 'Successful': $transaction->resultDesc }}
                                    {{ $transaction->resultCode === null? 'Pending...': '' }}</a>
                            </li>
                            @if ($transaction->resultCode === '0')
                                <li class="list-group-item" style="overflow:auto">
                                    <b>Amount</b> <a class="pull-right">Ksh. {{ $transaction->amount }}</a>
                                </li>
                                <li class="list-group-item" style="overflow:auto">
                                    <b>Receipt Number</b> <a class="pull-right">{{ $transaction->mpesaReceiptNumber }}</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                    <br><br>
                    <div class="ln_solid"></div>
                    {{-- <div class="form-group">
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
                                        {!! Form::open(['action' => ['UsersController@destroy', $user->slug], 'method' => 'DELETE'])
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
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection