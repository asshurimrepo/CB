<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return User::where('user_role','!=','admin')->get();
        }

        return view('admin.members.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $members)
    {
        $inputs = $request->all();
        // $inputs['slug'] = str_slug($inputs['name']);
        $inputs['password'] = Hash::make($request->get('password'));

        $members->fill($inputs);
        $members->save();

        return $members;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $members)
    {
        $inputs = $request->all();
        // // $inputs['slug'] = str_slug($inputs['slug']);

        if(array_key_exists("password",$inputs)){
            $inputs['password'] = Hash::make($request->get('password'));
        }
        $members->fill($inputs);
        $members->save();

        return $members;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $members)
    {
        $members->delete();
        return $members;
    }
}
