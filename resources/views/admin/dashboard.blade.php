@extends('admin.layouts.app')
@section('content')
<div class="">

    {{-- Widgets --}}
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="{{ route('admin_index') }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="count">{{ $admins }}</div>
                    <h3>Admins</h3>
                    <p>Total number of admins.</p>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="{{ route('users.index') }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="count">{{ $users }}</div>
                    <h3>Users</h3>
                    <p>Total number of users.</p>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="{{ route('matches.upcoming') }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-soccer-ball-o"></i></div>
                    <div class="count">{{ $upcomming_matches }}</div>
                    <h3>Upcomming Matches</h3>
                    <p>Number of matches.</p>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="{{ route('matches.pending') }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-hourglass-start"></i></div>
                    <div class="count">{{ $pending_matches }}</div>
                    <h3>Pending Matches</h3>
                    <p>Matches awaiting results.</p>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="#">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-trophy"></i></div>
                    <div class="count">{{ $winnings }}</div>
                    <h3>Winnings</h3>
                    <p>Matches with accurate predictions.</p>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="{{ route('subscribers.active') }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-toggle-on"></i></div>
                    <div class="count">{{ $active_subscribers }}</div>
                    <h3>Active Subscribers</h3>
                    <p>Users with active subscriptions.</p>
                </div>
            </a>
        </div>
    </div>
    {{-- end of widgets --}}

</div>
@endsection