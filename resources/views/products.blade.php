@extends('layouts.app')

@section('content')
<!-- Page-header start -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Product Management</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item" style="float: left;">
                        <a href="#"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Home</a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Product List</a>
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
                    <h5>Product List</h5>
                    <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger" data-toggle="modal" data-target="#addnewmodel"> <i class="icofont icofont-plus m-r-5"></i> Add Product
                    </button>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <div class="table-content">
                            <div class="project-table">
                                @if(count($data) > 0)
                                <table class="table table-striped dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $row)
                                        <tr>
                                            <td class="pro-list-img">
                                                <img src="{{asset($row->p_image)}}" class="img-fluid" alt="tbl">
                                            </td>
                                            <td class="pro-name">
                                                <h6>{{$row->product_name}}</h6>
                                            </td>
                                            <td>₹ {{number_format($row->p_price,2)}}</td>
                                            <td>
                                                @if($row->p_status=='active')
                                                <label class="text-success">In Stock</label>
                                                @else
                                                <label class="text-danger">Out Of Stock</label>
                                                @endif
                                            </td>
                                            <td class="action-icon">
                                                <a href="#!" data-toggle="modal" data-target="#editmodel{{$row->id}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="icofont icofont-ui-edit"></i></a>
                                                <div class="modal" id="editmodel{{$row->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Product</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form action="{{url('products/update/'.$row->id)}}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="product_name">Product Name</label>
                                                                        <input type="text" name="product_name" value="{{$row->product_name}}" id="product_name" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="p_price">Price</label>
                                                                        <input type="text" name="p_price" value="{{$row->p_price}}" id="p_price" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="p_description">Description</label>
                                                                        <textarea name="p_description" id="p_description" cols="30" rows="3" class="form-control">{{$row->p_description}}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="p_image">Image</label>
                                                                        <input type="file" name="p_image" id="p_image" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="p_status">Stock</label>
                                                                        <select name="p_status" class="form-control" required>
                                                                            <option value="" readonly>Select</option>
                                                                            <option value="active" {{($row->p_status=='active')?'selected':''}}>Stock</option>
                                                                            <option value="inactive" {{($row->p_status=='inactive')?'selected':''}}>Out of stock</option>
                                                                        </select>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-warning float-right">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <a href="#!" data-toggle="modal" data-target="#deletemodel" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="icofont icofont-delete-alt"></i></a>
                                                <div class="modal" id="deletemodel">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Delete Record</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this product? <br>
                                                                    If you delete this product, You can't undo this action</p>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <form action="{{url('products/delete/'.$row->id)}}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @include('layouts.pagination')
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
    <div class="modal" id="addnewmodel">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add new product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{url('products/store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" value="{{old('product_name')}}" id="product_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="p_price">Price</label>
                            <input type="text" name="p_price" value="{{old('p_price')}}" id="p_price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="p_description">Description</label>
                            <textarea name="p_description" id="p_description" cols="30" rows="3" class="form-control">{{old('p_description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="p_image">Image</label>
                            <input type="file" name="p_image" id="p_image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-warning float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>
    <!-- Add Contact Ends Model end-->
</div>
@endsection