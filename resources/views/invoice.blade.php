@extends('layouts.app')

@section('content')
<!-- Invoice card start -->
<div class="card">
    <div class="row invoice-contact">
        <div class="col-md-8">
            <div class="invoice-box row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table table-borderless">
                        <tbody>
                            <!-- <tr>
                                <td><img src="../files/assets/images/logo-blue.png" class="m-b-10" alt=""></td>
                            </tr> -->
                            <tr>
                                <td>Compney Name</td>
                            </tr>
                            <tr>
                                <td>123 6th St. Melbourne, FL 32904 West
                                    Chicago, IL 60185</td>
                            </tr>
                            <tr>
                                <td><a href="mailto:demo@gmail.com" target="_top">demo@gmail.com</a>
                                </td>
                            </tr>
                            <tr>
                                <td>+91 919-91-91-919</td>
                            </tr>
                            <!-- <tr>
                                                            <td><a href="#" target="_blank">www.demo.com</a>
                                                            </td>
                                                        </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <div class="card-block">
        <div class="row invoive-info">
            <div class="col-md-4   invoice-client-info">
                <h6>Client Information :</h6>
                <h6 class="m-0">{{$data->customer->c_fname.' '.$data->customer->c_lname}}</h6>
                <p class="m-0 m-t-10">{{$data->o_company}}</p>
                <p class="m-0 m-t-10">{{$data->o_address1}}</p>
                <p class="m-0">+91 {{$data->o_phone}}</p>
                <p>demo@xyz.com</p>
            </div>
            <div class="col-md-4 col-sm-6">
                <h6>Order Information :</h6>
                <table class="table table-responsive invoice-table invoice-order table-borderless">
                    <tbody>
                        <tr>
                            <th>Date :</th>
                            <td class="text-uppercase">{{date('F d Y',strtotime($data->o_orderdate))}}</td>
                        </tr>
                        <tr>
                            <th>Status :</th>
                            <td>
                                <span class="label label-warning">{{$data->o_orderstatus}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Id :</th>
                            <td>
                                #KOM{{str_pad($data->id, 5, '0', STR_PAD_LEFT)}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 col-sm-6">
                <h6 class="m-b-20">Invoice Number
                    <span>#12398521473</span>
                </h6>
                <h6 class="text-uppercase text-primary">Total Due :
                    <span>$900.00</span>
                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table  invoice-detail-table">
                        <thead>
                            <tr class="thead-default">
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total=0;
                                $gtotal=0;
                            @endphp
                            @foreach($data->orderitems as $item)
                            <tr>
                                <td>
                                    <h6>{{$item->product_name}}</h6>
                                    <p>{{$item->p_description}}</p>
                                </td>
                                <td>{{$item->qty}}</td>
                                <td> ₹ {{number_format($item->price,2)}}</td>
                                <td>₹ {{number_format(($item->price*$item->qty),2)}}</td>
                            </tr>
                            @php
                                $total+= $item->price*$item->qty;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-responsive invoice-table invoice-total">
                    <tbody>
                        <tr>
                            <th>Sub Total :</th>
                            <td>₹ {{number_format($total,2)}}</td>
                        </tr>
                        <tr>
                            <th>Taxes (10%) :</th>
                            <td>₹ {{number_format((($total*10)/100),2)}}</td>
                        </tr>
                        <tr>
                            <th>Discount (5%) :</th>
                            <td>₹ {{number_format((($total*5)/100),2)}}</td>
                        </tr>
                        <tr class="text-info">
                            <td>
                                <hr />
                                <h5 class="text-primary">Total :</h5>
                            </td>
                            <td>
                                <hr />
                                @php
                                $gtotal=($total+(($total*10)/100))-((($total*5)/100));
                                @endphp
                                <h5 class="text-primary">₹ {{number_format($gtotal,2)}}</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h6>Terms And Condition :</h6>
                <p>lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis
                    nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor </p>
            </div>
        </div>
    </div>
</div>
<!-- Invoice card end -->
@endsection