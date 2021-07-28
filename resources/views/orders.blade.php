@extends('layouts.app')

@section('content')
<!-- Page-header start -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Order Management</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item" style="float: left;">
                        <a href="#"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;"><a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;"><a href="#">Order Management</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<!-- Page body start -->
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <!-- Product list card start -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5>Order List</h5>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <div class="table-content">
                            <div class="project-table">
                                @if(count($data) > 0)
                                <table class="table table-striped dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Order status</th>
                                            <th>Payment status</th>
                                            <th>View Items</th>
                                            <th>Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $row)
                                        <tr>
                                            <td class="pro-name">
                                                <h5>#KOM{{str_pad($row->id, 5, '0', STR_PAD_LEFT)}}</h5>
                                                <small class="font-weight-bold text-uppercase">Order Date: {{$row->o_orderdate}}</small>
                                            </td>
                                            <td class="pro-name">
                                                <h5>{{$row->customer->c_fname .' '.$row->customer->l_fname}}</h5>
                                                <small class="font-weight-bold text-uppercase">Shipping Date: {{$row->o_shipdate}}</small>
                                            </td>
                                            <td>
                                                @if($row->o_orderstatus=='delivered')
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#changestatus{{$row->id}}"> <i class="icofont icofont-edit m-r-5"></i>{{$row->o_orderstatus}}
                                                </button>
                                                @elseif($row->o_orderstatus=='packed')
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#changestatus{{$row->id}}"> <i class="icofont icofont-edit m-r-5"></i>{{$row->o_orderstatus}}
                                                </button>
                                                @elseif($row->o_orderstatus=='shipped')
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#changestatus{{$row->id}}"> <i class="icofont icofont-edit m-r-5"></i>{{$row->o_orderstatus}}
                                                </button>
                                                @else
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#changestatus{{$row->id}}"> <i class="icofont icofont-edit m-r-5"></i>{{$row->o_orderstatus}}
                                                </button>
                                                @endif
                                                <div class="modal" id="changestatus{{$row->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Change Order Status</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form action="{{url('orders/update/'.$row->id)}}" method="post">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="flavour_name">Change Status</label>
                                                                        <select name="status" id="status" class="form-control text-uppercase" required>
                                                                            <option value="" disabled selected>Select</option>
                                                                            <option value="pending">pending</option>
                                                                            <option value="packed">packed</option>
                                                                            <option value="shipped">shipped</option>
                                                                            <option value="delivered">delivered</option>
                                                                        </select>
                                                                    </div>
                                                                    <input type="hidden" name="updatetype" value="order_status">
                                                                    <button type="submit" class="btn btn-warning float-right">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($row->o_paymentstatus=='paid')
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#paymentstatus{{$row->id}}"> <i class="icofont icofont-edit m-r-5"></i>Paid
                                                </button>
                                                @else
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#paymentstatus{{$row->id}}"> <i class="icofont icofont-edit m-r-5"></i>Not Paid
                                                </button>
                                                @endif
                                                <div class="modal" id="paymentstatus{{$row->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Change Payment Status</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form action="{{url('orders/update/'.$row->id)}}" method="post">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="flavour_name">Change Status</label>
                                                                        <select name="status" id="status" class="form-control text-uppercase" required>
                                                                            <option value="" disabled selected>Select</option>
                                                                            <option value="not_paid">Not Paid</option>
                                                                            <option value="paid">Paid</option>
                                                                        </select>
                                                                        <input type="hidden" name="updatetype" value="payment_status">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-warning float-right">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewitems{{$row->id}}">View Items</button>
                                                <div class="modal" id="viewitems{{$row->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Order Items</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <table class="table table-striped dt-responsive nowrap">
                                                                    @foreach($row->orderitems as $item)
                                                                    <tr>
                                                                        <td class="pro-list-img">
                                                                            <img src="../files/assets/images/product-list/pro-l1.png" class="img-fluid" alt="tbl">
                                                                        </td>
                                                                        <td class="pro-name">
                                                                            <h6>{{$item->product_name}}</h6>
                                                                            <span>{{$item->p_description}}</span>
                                                                        </td>
                                                                        <td> ₹ {{number_format($item->price,2)}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> <a class="btn btn-sm btn-dark" href="{{url('orders/invoice/'.$row->id)}}">Invoice</a> </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product list card end -->
        </div>
    </div>
    <!-- Add Contact Start Model start-->
    <!-- The Modal -->

    <div class="md-overlay"></div>
    <!-- Add Contact Ends Model end-->
</div>
@endsection