<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class Anocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = DB::select("CALL procedure_function(null,'','','','Select')");
        return view('welcome', ['user'=>$user]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $input = $request->all();
        // dd($input);
        $username = $input['username'];
        $email = $input['email'];
        $phone = $input['phone'];
        $user = DB::insert("CALL procedure_function(null,'$username','$email','$phone','Insert')");
        return redirect(route('create'))->with('status', 'Data Submitted Successfully');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $input = $request->all('id');
        // $edituser = DB::select("CALL procedure_function($id,'','','','Select_id')");
        // dd($edituser);
        $edituser = DB::table('stored_crud')->find($id);
        return view('editform', ['edituser'=>$edituser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();
        // $idd = $input['id'];
        $username = $input['username'];
        $email = $input['email'];
        $phone = $input['phone'];

        $update = DB::update("CALL procedure_function('$id','$username','$email','$phone','Update')");
        // dd($update);
        return redirect(route('index'))->with('status', 'Data updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $input = $request->all();
        // $idd = $input['id'];
        // $username = $input['username'];
        // $email = $input['email'];
        // $phone = $input['phone'];
        $user = DB::delete("CALL procedure_function('$id','','','','delete')");
        return redirect(route('index'))->with('status', 'Data delete Successfully');
    }
}
