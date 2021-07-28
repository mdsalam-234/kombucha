<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrdermanagementController extends Controller
{
    public function index()
    {
        $data = Order::with(['customer','orderitems'])->orderBy('id', 'desc')->paginate(10);
        //return $data;
        return view('orders',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Order::find($id);
        if($request->post('updatetype')=='order_status'){
            $data->o_orderstatus = $request->post('status');
            $data->save();
            session()->flash('status', 'Order status updated successfully');
        }elseif($request->post('updatetype')=='payment_status'){
            $data->o_paymentstatus = $request->post('status');
            $data->save();
            session()->flash('status', 'Payment status updated successfully');
        }
        return back();
    }

    public function getInvoice($id)
    {
        $data = Order::with(['customer','orderitems'])->where('id',$id)->orderBy('id', 'desc')->first();
        //return $data;
        return view('invoice',compact('data'));
    }

}
