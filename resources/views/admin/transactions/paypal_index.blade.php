@extends('admin.layouts.app')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            @if (isset($message))
                <h3>{{ $param }} Paypal Transactions.<small>Search results: {{ $message }}</small></h3>
            @else
                <h3>Transactions | <small>List of {{ $param }} Transactions.</small></h3>
            @endif
            
        </div>
        <form action="{{ route('paypal.search') }}" method="post">
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
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Paypal <small>Transactions</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Transaction Date</th>
                                <th>Amount</th>
                                <th>ReceiptNumber</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>
                                    @if ($transaction->user != null)
                                        <a href="{{ route('users.show', ['slug' => $transaction->user->slug]) }}">{{ $transaction->user != null? $transaction->user->name: '__' }}</a>
                                    @else
                                        <a href="javascript:void(0)">{{ $transaction->user != null? $transaction->user->name: '__' }}</a>
                                    @endif
                                    
                                </td>
                                <td>{{ date('l jS M, h:i a', strtotime($transaction->created_at)) }}
                                </td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->transaction_id }}</td>
                                <td><a href="{{ route('paypal.show', ['id' => $transaction->id]) }}"><i
                                            class="fa fa-ellipsis-h"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#datatable').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
} );
</script>
@endsection