<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flavour;
class FlavoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Flavour::orderBy('id', 'desc')->paginate(10);
        return view('flavours',compact('data'));
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
            'flavour_name.unique' => 'This Flavour name already exists!',
            'flavour_name.required' => 'Flavour name is required field!',
            'pid.required' => 'Choose Product!',
            'pid.numeric' => 'Invalid Product',
            'f_image.required' => 'Choose flavour image',
        ];
        $validate = $request->validate([
            'flavour_name' => 'required|string|max:50|unique:flavours',
            'pid' => 'required|numeric',
            'f_image' => 'required',
        ], $customMessages);
        $data = new Flavour();
        $data->flavour_name = $request->post('flavour_name');
        $data->pid = $request->post('pid');
        $data->f_image = $request->post('f_image');
        $data->f_description = $request->post('f_description');
        $data->save();
        session()->flash('status', 'Success! Flavour added successfully.');
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
            'flavour_name.unique' => 'This Flavour name already exists!',
            'flavour_name.required' => 'Flavour name is required field!',
            'pid.required' => 'Choose Product!',
            'pid.numeric' => 'Invalid Product',
        ];
        $validate = $request->validate([
            'flavour_name' => 'required|string|max:50|unique:flavours,flavour_name,'.$id,
            'pid' => 'required|numeric',
        ], $customMessages);
        $data = Flavour::find($id);
        $data->flavour_name = $request->post('flavour_name');
        $data->pid = $request->post('pid');
        $data->f_image = $request->post('f_image');
        $data->f_description = $request->post('f_description');
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
        $data = Flavour::find($id);
        $data->delete();
        session()->flash('status', 'Record deleted successfully');
        return back();
    }
}
