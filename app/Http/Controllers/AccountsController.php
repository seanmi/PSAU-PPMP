<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Session;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfileAdmin($id)
    {
        $user = User::find($id);
        if($user->user_lvl == 3){
            return view('bac.editProfile')->with('user', $user);
        }elseif($user->user_lvl == 4){
            return view('procurement.editProfile')->with('user', $user);
        }elseif($user->user_lvl == 2){
            return view('vp.editProfile')->with('user', $user);
        }elseif($user->user_lvl == 1){
            return view('op.editProfile')->with('user', $user);
        }elseif($user->user_lvl == 5){
            return view('budget.editProfile')->with('user', $user);
        }
        else{
            return view('user.editProfile')->with('user', $user);
        }

    }

    public function updateProfileAdmin(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'contact_no' => 'required'
        ]);

        $user = User::find($id);
        $user->name = request()->name;
        $user->email = request()->email;
        $user->contact_no = request()->contact_no;
        if($request->has('password') && request()->password !==NULL){
            $user->password = bcrypt(request()->password);
        }       
        $user->save();

        Session::flash('success', 'Updated Successfully');
        return redirect()->back();
    }
}
