<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use File;
use Image;
use App\Subscription;
use Session;
use Auth;
use Illuminate\Database\QueryException;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('type', 'user')->where('view', true)->get();  //->where('email_verified_at', '!=', null) #removed
        return view('admin.users.index')->with('users', $users)->with('user_type', 'User')->with('param', 'All');
    }

    public function admin_index()
    {
        $admins = User::where('is_admin', true)->where('view', true)->get();
        return view('admin.users.index')->with('users', $admins)->with('user_type', 'Admin');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function add_admin()
    {
        //
        if(Auth::user()->type == 'super'){
            return view('admin.users.add_admin');
        }

        return redirect()->back()->with('error', 'You cannot create a new admin since you are not a Super admin.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $check_email = User::where('email', $request->email)->count();
        if($check_email > 0){
            Session::flash('error', 'The email is already registered with us!');
            return redirect()->back();
        }
        $slug = str_slug($request->name);
        $check = User::withTrashed()->where('slug', $slug)->count();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'slug' => $slug,
        ]);
        if($check > 0){
            $user->slug = $slug . '-' . $user->id;
            $user->save();
        }
        return redirect()->route('users.index')->with('success', 'You successfully added the user.');

    }

    public function admin_store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if(Auth::user()->type == 'super'){

            $check_email = User::where('email', $request->email)->count();
            if($check_email > 0){
                Session::flash('error', 'The email is already registered!');
                return redirect()->back();
            }
            if($request->super == 'on'){
                $type = 'super';
            }
            else{
                $type = 'ordinary';
            }
            $slug = str_replace('/', '-', str_slug($request->name));
            $check = User::withTrashed()->where('slug', $slug)->count();
            $admin = User::create([
                'name' => $request->name,
                'email'=> $request->email,
                'type'=> $type,
                'is_admin' => true,
                'slug'=> $slug,
                'is_verified' => true,
            ]);
            if($check > 0){
                $admin->slug = str_replace('/', '-', $slug . $admin->id);
                $admin->save();
            }

            Session::flash('success', 'You successfully added an admin.');
            return redirect()->route('admin_index');
        }

        Session::flash('error', 'You cannot add an admin since you are not a Super Admin!');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        try{
            $user = User::where('slug', $slug)->first();
        }
        catch(QueryException $e){
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        if($user == null){
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        if($user->view == false && Auth::user()->view != false){
            Session::flash('error', 'Fatal error. Contact 24seven Developers.');
            return redirect()->back();
        }
        $subscriptions = Subscription::orderBy('expiry_date', 'DESC')->where('user_id', $user->id)->take(100)->get();
        return view('admin.users.show')->with('user', $user)->with('subscriptions', $subscriptions);
    }

    public function show_by_id($id)
    {
        //
        try{
            $user = User::withTrashed()->where('id', $id)->first();
        }
        catch(QueryException $e){
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        if($user == null){
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        if($user->view == false && Auth::user()->view != false){
            Session::flash('error', 'Fatal error. Contact 24seven Developers.');
            return redirect()->back();
        }
        $subscriptions = Subscription::orderBy('expiry_date', 'DESC')->where('user_id', $user->id)->take(100)->get();
        return view('admin.users.show')->with('user', $user)->with('subscriptions', $subscriptions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $user = User::where('slug', $slug)->first();
        if($user->view == false && Auth::user()->view != false){
            Session::flash('error', 'Fatal error. Contact 24seven Developers.');
            return redirect()->back();
        }
        if(Auth::user()->type == 'super' || Auth::user()->slug == $slug ||  (Auth::user()->is_admin && !$user->is_admin)){
            return view('admin.users.edit')->with('user', $user);
        }
        if(Auth::user()->type == 'ordinary')
            Session::flash('error', 'You are not allowed to edit other admins\' info unless you are a Super Admin!');
        if(Auth::user()->type == 'user')
            Session::flash('error', 'You are not allowed to edit other users\' info unless you are an Admin!');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if(!$request->hasFile('avatar') && $request->has('avatar')){
            return redirect()->back()->with('error','Image not supported');
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::where('slug', $slug)->first();
        if(Auth::user()->type != 'user'){
            if($request->is_verified == 'on'){
                $user->is_verified = true;
            }
            else
                $user->is_verified = false;
        }
        else
        {
            $this->validate($request, [
                'old_password' => 'required',
            ]);
            if(!\Hash::check($request->old_password, $user->password)){
                return redirect()->back()->with('error', 'Old password is wrong.');
            }
        }
        if(Auth::user()->type == 'super' || Auth::user()->slug == $slug ||  (Auth::user()->is_admin && !$user->is_admin)){
            if($request->password != ''){
                if($request->password == $request->confirm_password){
                    $user->password = bcrypt($request->password);
                }
                else{
                    Session::flash('error', 'Confirmation password and the password do not match.');
                    return redirect()->back();
                }
            }
            if($request->has('avatar')){
                $old_avatar = $user->avatar;
                $avatar = $request->avatar;
                if($old_avatar != 'uploads/users/avatar.png'){
                    File::delete($old_avatar);
                }
                $avatar_name = time() . $avatar->getClientOriginalName();
                $avatar_new_name = 'uploads/users/' . $avatar_name;
                $new_avatar = Image::make($avatar->getRealPath())->resize(500, 500);
                $new_avatar->save($avatar_new_name);
                $avatar = $avatar_new_name;
                $user->avatar = $avatar;
            }

            if($request->phone != ''){
                $user->phone = $request->phone;
            }

            if(User::where('email', $request->email)->where('email','!=',$user->email)->count() > 0){
                return redirect()->back()->with('error','Sorry The record already exists');
            }

            $user->name = $request->name;
            $user->email = $request->email;
            if($user->type != 'user'){
                if($request->super == 'on'){
                    $type = 'super';
                }
                else{
                    $type = 'ordinary';
                }
                if(Auth::user()->type == 'super'){

                    if($request->super != 'on' && User::where('type', 'super')->where('view', true)->count() == 1 && $user->type == 'super'){
                        Session::flash('error', 'Sorry, you are the ONLY REMAINING super admin!');
                        return redirect()->back();
                    }

                    $user->type = $type;

                }
                elseif($user->type != $type){
                    Session::flash('error', 'You cannot change your super-admin status since you are not a super admin!');
                    return redirect()->back();
                }
            }


            $result = $user->save();

            // Require verification of new email and send EmailVerificationNotification.
            if($user->email != $request->email){
                $user->email_verified_at = null;
                $result = $user->save();
                $user->sendEmailVerificationNotification();
            }

            if($result){
                Session::flash('success', 'You successifully updated the users profile.');
                if(Auth::user()->type == 'user')
                    return redirect()->back()->with('success', 'You successifully updated the users profile.');
                return redirect()->route('users.show', ['slug' => $slug]);
            }

            Session::flash('error', 'You could not update the users profile.');
            return redirect()->route('users.index');
        }

        Session::flash('error', 'You are not allowed to edit other users\' info unless you are a Super Admin!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.     Permanent removal
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        try{
            $user = User::where('slug', $slug)->first();
        }
        catch(QueryException $ex){
            Session::flash('error', 'Admin/User could not be found!');
            return redirect()->back();
        }

        if(Auth::user()->type == 'super' || Auth::user()->slug == $slug ||  (Auth::user()->is_admin && !$user->is_admin)){
            if(User::where('type', 'super')->where('view', true)->count() == 1 && Auth::user()->type == 'super' && Auth::user()->slug == $user->slug){
                Session::flash('error', 'Sorry, you are the ONLY REMAINING super admin! Make someone else a super admin then exit.');
                return redirect()->back();
            }
            $avatar = $user->avatar;
            // if($avatar != 'uploads/users/avatar.png'){
            //     File::delete($avatar);
            // }
            $type = $user->type;
            $user->forceDelete();
            Session::flash('success', 'Admin/User removed successfully');
            if($type == 'user')
                return redirect()->route('users.index');
            return redirect()->route('admin_index');
        }
        Session::flash('error', 'Admin/User could not be removed! Task only allowed to Super Admin!');
        return redirect()->back();
    }

    public function trashed_users(){
        $users = User::onlyTrashed()->where('type', 'user')->get();
        return view('admin.users.trashed')->with('user_type', 'User')->with('users', $users);
    }

    public function trashed_admins(){
        $admins = User::onlyTrashed()->where('type', '!=', 'user')->get();
        return view('admin.users.trashed')->with('user_type', 'Admin')->with('users', $admins);
    }

    public function restore($slug){
        $user = User::onlyTrashed()->where('slug', $slug)->first();
        if($user == null){
            Session::flash('error', 'Admin/User could not be found in the trash!');
            return redirect()->back();
        }
        if(Auth::user()->type == 'super' || Auth::user()->slug == $slug || (Auth::user()->is_admin && !$user->is_admin)){
            $user->restore();
            Session::flash('success', $user->name . ' restored successfully');
            if($user->type == 'user')
                return redirect()->route('users.index');
            return redirect()->route('admin_index');
        }
        Session::flash('error', 'Admin could not be restored! Task only allowed to Super Admin!');
        return redirect()->back();

    }

    // destroy permanently
    public function p_destroy($slug)
    {
        //
        try{
            $user = User::withTrashed()->where('slug', $slug)->first();
        }
        catch(QueryException $ex){
            Session::flash('error', 'Admin/User could not be found!');
            return redirect()->back();
        }
        if(Auth::user()->type == 'super' || Auth::user()->slug == $slug || (Auth::user()->is_admin && !$user->is_admin)){
            if(User::where('type', 'super')->where('view', true)->count() == 1 && Auth::user()->type == 'super' && Auth::user()->slug == $user->slug){
                Session::flash('error', 'Sorry, you are the ONLY REMAINING super admin! Make someone else a super admin then exit.');
                return redirect()->back();
            }
            $avatar = $user->avatar;
            // if($avatar != 'uploads/users/avatar.png'){
            //     File::delete($avatar);
            // }
            $type = $user->type;
            $user->forceDelete();
            Session::flash('success', 'Admin/User successfully removed permanently!');
            if($type == 'user')
                return redirect()->route('users.index');
            return redirect()->route('admin_index');
        }
        Session::flash('error', 'Admin/User could not be removed! Task only allowed to super Admin!');
        return redirect()->back();
    }
}
