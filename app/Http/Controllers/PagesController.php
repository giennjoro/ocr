<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Match;
use App\Subscription;
use App\Plan;

class PagesController extends Controller
{
    public function index(){
        $vip_matches = [];
        if(Auth::check()){
            if(Auth::user()->subscription_expiry >= now()->format('Y-m-d H:i:s') || Auth::user()->is_admin){
                $matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->take(20)->get();
            }
            else{
                $matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->where('pro', false)->take(20)->get();
                $vip_matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->where('pro', true)->take(20)->get();
            }
        }
        else{
            $matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->where('pro', false)->take(20)->get();
            $vip_matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->where('pro', true)->take(20)->get();
        }
        $wons = Match::orderBy('time', 'DESC')->where('won', true)->take(10)->get();
        return view('client.index')->with('matches', $matches)->with('vip_matches', $vip_matches)->with('wons', $wons);
    }
    public function plans(){
        $payment = \Session::get('payment');
        if($payment != null){
            \Session::forget('payment');
            \Session::save();
            return redirect()->route('Pay_with_mpesa', $payment);
        }
        
        $plans = Plan::all();
        return view('client.plans')->with('plans', $plans);
    }
    public function about(){
        return view('client.about');
    }
    public function contact(){
        return view('client.contact');
    }
    public function user_dashboard(){
        $subscriptions = Subscription::orderBy('expiry_date', 'DESC')->where('user_id', Auth::user()->id)->take(100)->get();
        return view('client.dashboard')->with('subscriptions', $subscriptions);
    }
    public function all(){
        $vip_matches = [];
        if(Auth::check()){
            if(Auth::user()->subscription_expiry >= now()->format('Y-m-d H:i:s') || Auth::user()->is_admin){
                $matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->paginate(10);
            }
            else{
                $matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->where('pro', false)->paginate(10);
                $vip_matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->where('pro', true)->take(20)->get();
            }
        }
        else{
            $matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->where('pro', false)->paginate(10);
            $vip_matches = Match::orderBy('time', 'ASC')->where('time', '>=', now()->format('Y-m-d H:i:s'))->where('pro', true)->take(20)->get();
        }
        return view('client.all_matches')->with('matches',$matches)->with('vip_matches', $vip_matches);
    }
    public function all_won(){
        $wons = Match::orderBy('time', 'DESC')->where('won', true)->paginate(20);
        return view('client.all_won')->with('wons', $wons);
    }
}
