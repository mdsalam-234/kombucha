<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flavour;
use App\Models\Product;
class FlavoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Flavour::with(['product'])->orderBy('pid', 'desc')->paginate(10);
        $products = Product::select('id','product_name')->where('p_status', 'active')->get();
        return view('flavours', ['data' => $data, 'products' => $products]);
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
        $data->f_description = $request->post('f_description');
        if ($request->hasFile('f_image')) {
            $validate = $request->validate([
                'f_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:512',
            ]);
            $image = $request->file('f_image');
            $new_image_name = date('Ymd') . time() . "." . $image->extension();

            $destination_path = public_path('/assets/images/fimages/');
            $image->move($destination_path, $new_image_name);
            $data->f_image = "assets/images/fimages/" . $new_image_name;
        }
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
        $data->f_description = $request->post('f_description');
        $data->f_status = $request->post('f_status');
        if ($request->hasFile('f_image')) {
            $validate = $request->validate([
                'f_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:512',
            ]);
            $image = $request->file('f_image');
            $new_image_name = date('Ymd') . time() . "." . $image->extension();

            $destination_path = public_path('/assets/images/fimages/');
            $image->move($destination_path, $new_image_name);
            $data->f_image = "assets/images/fimages/" . $new_image_name;
        }
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
