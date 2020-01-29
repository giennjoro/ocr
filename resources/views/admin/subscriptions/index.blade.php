@extends('admin.layouts.app')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            @if (isset($message))
                <h3>{{ $param }} Subscriptions.<small>Search results: {{ $message }}</small></h3>
            @else
            <h3>Subscriptions | <small>List of all Subscriptions.</small></h3>
            @endif
        </div>
        <form action="{{ route('subscriptions.search') }}" method="post">
            @csrf
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" name="my_query" class="form-control" placeholder="name, email, trans .no">
                        <input type="text" name="param" style="display: none" value="{{ $param }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $param }} Subscriptions <small>Details</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Plan</th>
                                <th>P. Mode</th>
                                {{-- <th>Transaction</th> --}}
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscriptions as $subscription)
                            <tr>
                                <td><a href="{{ $subscription->user != null? route('users.show', ['slug' => $subscription->user->slug]): 'javascript:void(0)' }}" title="{{ $subscription->user != null? $subscription->user->email: '__' }}">{{ $subscription->user != null? $subscription->user->name: '__' }}</a></td>
                                <td>{{ date('l jS M, h:i a', strtotime($subscription->start_date)) }}</td>
                                <td>{{ date('l jS M, h:i a', strtotime($subscription->expiry_date)) }}</td>
                                <td>{{ $subscription->plan != null? $subscription->plan->title: '__' }}</td>
                                <td><a href="/admin/{{ $subscription->payment_mode }}/show/{{ $subscription->mpesa_id . $subscription->paypal_id }}"
                                        style="text-decoration:underline"
                                    title="View Transaction">{{ $subscription->payment_mode  }}: {{ $subscription->mpesa !=null? ': ' . $subscription->mpesa->mpesaReceiptNumber: '' }}{{ $subscription->paypal !=null? $subscription->paypal->transaction_id: '' }}</a></td>
                                {{-- <td>{{ $subscription->mode == 'Mpesa' && $subscription->mpesa != null? $subscription->mpesa->mpesaReceiptNumber: '__' }}
                                </td> --}}
                                <td>KES. {{ $subscription->amount }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $subscriptions->links() }}
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