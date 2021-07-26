<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrdermanagementController extends Controller
{
    public function index()
    {
        $data = Order::orderBy('id', 'desc')->paginate(10);
        return view('orders',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Order::find($id);
        $data->o_orderstatus = $request->post('o_orderstatus');
        $data->save();
        session()->flash('status', 'Order status updated successfully');
        return back();
    }
}
