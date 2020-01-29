<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(\Auth::user()->is_admin){
            $admins = \App\User::where('is_admin', true)->where('view', true)->count();
            $users = \App\User::where('type', 'user')->where('view', true)->count();
            $active_subscribers = \App\User::where('subscription_expiry', '>=', now()->format('Y-m-d H:i:s'))->where('view', true)->count();
            $upcomming_matches = \App\Match::where('time', '>=', now()->format('Y-m-d H:i:s'))->count();
            $pending_matches = \App\Match::where('time', '<', now()->format('Y-m-d H:i:s'))->where('won', null)->count();
            $winnings = \App\Match::orderBy('time', 'DESC')->where('won', true)->count();
            return view('admin.dashboard')->with('admins', $admins)
                                        ->with('users', $users)
                                        ->with('active_subscribers', $active_subscribers)
                                        ->with('upcomming_matches', $upcomming_matches)
                                        ->with('pending_matches', $pending_matches)
                                        ->with('winnings', $winnings)
            ;
        }
        else{
            return redirect()->route('landing');
        }
        
    }
}
