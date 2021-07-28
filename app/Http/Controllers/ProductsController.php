<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderBy('id', 'desc')->paginate(10);
        return view('products', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'product_name.unique' => 'This Product name already exists!',
            'product_name.required' => 'Product name is required field!',
            'p_price.required' => 'Product price is required field!',
            'p_price.numeric' => 'Product price must be numeric!',
        ];
        $validate = $request->validate([
            'product_name' => 'required|string|max:50|unique:products',
            'p_price' => 'required|numeric',
        ], $customMessages);
        $data = new Product();
        $data->product_name = $request->post('product_name');
        $data->p_description = $request->post('p_description');
        $data->p_price = $request->post('p_price');
        if ($request->hasFile('p_image')) {
            $validate = $request->validate([
                'p_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:512',
            ]);
            $image = $request->file('p_image');
            $new_image_name = date('Ymd') . time() . "." . $image->extension();

            $destination_path = public_path('/assets/images/pimages/');
            $image->move($destination_path, $new_image_name);
            $data->p_image = "assets/images/pimages/" . $new_image_name;
        }
        $data->save();
        session()->flash('status', 'Success! Product added successfully.');
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
            'product_name.unique' => 'This Product name already exists!',
            'product_name.required' => 'Product name is required field!',
            'p_price.required' => 'Product price is required field!',
            'p_price.numeric' => 'Product price must be numeric!',
        ];
        $validate = $request->validate([
            'product_name' => 'required|string|max:50|unique:products,product_name,' . $id,
            'p_price' => 'required|numeric',
        ], $customMessages);
        $data = Product::find($id);
        $data->product_name = $request->post('product_name');
        $data->p_description = $request->post('p_description');
        $data->p_price = $request->post('p_price');
        $data->p_status = $request->post('p_status');
        if ($request->hasFile('p_image')) {
            $validate = $request->validate([
                'p_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:512',
            ]);
            $image = $request->file('p_image');
            $new_image_name = date('Ymd') . time() . "." . $image->extension();

            $destination_path = public_path('/assets/images/pimages/');
            $image->move($destination_path, $new_image_name);
            $data->p_image = "assets/images/pimages/" . $new_image_name;
        }
        $data->save();
        session()->flash('status', 'Record updated successfully');
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
        $data = Product::find($id);
        $data->delete();
        session()->flash('status', 'Record deleted successfully');
        return back();
    }
}
