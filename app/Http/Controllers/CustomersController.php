<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::orderBy('id', 'desc')->paginate(10);
        return view('customers',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customMessages = [
            'c_fname.required' => 'Customer is required field!',
            'c_email.unique' => 'Email address already exists!',
            'c_email.email' => 'Invalid Email',
            'c_password.required' => 'Password is required field!',
        ];
        $validate = $request->validate([
            'c_fname' => 'required|string|max:50',
            'c_lname' => 'string|max:50',
            'c_email' => 'required|email|unique:customers,c_email',
            'c_password' => 'required|string|max:50',
        ], $customMessages);
        $data = new Customer();
        $data->c_fname = $request->post('c_fname');
        $data->c_lname = $request->post('c_lname');
        $data->c_email = $request->post('c_email');
        $data->c_password = Hash::make($request->post('c_password'));
        $data->save();
        session()->flash('status', 'Success! Customer added successfully.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $customMessages = [
            'c_fname.required' => 'Customer is required field!',
            'c_email.unique' => 'Email address already exists!',
            'c_email.email' => 'Invalid Email',
        ];
        $validate = $request->validate([
            'c_fname' => 'required|string|max:50',
            'c_lname' => 'string|max:50',
            'c_email' => 'required|email|unique:customers,c_email,'.$id,
        ], $customMessages);

        $data = Customer::find($id);
        $data->c_fname = $request->post('c_fname');
        $data->c_lname = $request->post('c_lname');
        $data->c_email = $request->post('c_email');
        $data->save();
        session()->flash('status', 'Record updated successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Customer::find($id);
        $data->delete();
        session()->flash('status', 'Record deleted successfully');
        return back();
    }
}
