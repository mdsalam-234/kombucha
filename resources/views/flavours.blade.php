@extends('layouts.app')

@section('content')
<!-- Page-header start -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Flavour Management</h4>
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
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Flavour List</a>
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
                    <h5>Flavour List</h5>
                    <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger" data-toggle="modal" data-target="#addnewmodel"> <i class="icofont icofont-plus m-r-5"></i> Add flavour
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
                                            <th>Product</th>
                                            <th>Flavour Name</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $row)
                                        <tr>
                                            <td class="pro-list-img">
                                                <img src="../files/assets/images/product-list/pro-l1.png" class="img-fluid" alt="tbl">
                                            </td>
                                            <td class="pro-name">
                                                <h6>{{$row->flavour_name}}</h6>
                                                <span>{{$row->f_description}}</span>
                                            </td>
                                            <td>$456</td>
                                            <td>
                                                @if($row->f_status=='active')
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
                                                                <h4 class="modal-title">Edit Flavour</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form action="{{url('flavours/update/'.$row->id)}}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="flavour_name">Flavour Name</label>
                                                                        <input type="text" name="flavour_name" value="{{$row->flavour_name}}" id="flavour_name" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="pid">Product</label>
                                                                        <input type="text" name="pid" value="{{$row->pid}}" id="pid" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="f_description">Description</label>
                                                                        <textarea name="f_description" id="f_description" cols="30" rows="3" class="form-control">{{$row->f_description}}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="f_image">Image</label>
                                                                        <input type="file" name="f_image" id="f_image" class="form-control">
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
                                                                <p>Are you sure you want to delete this Flavour? <br>
                                                                    If you delete this Flavour, You can't undo this action</p>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <form action="{{url('flavours/delete/'.$row->id)}}" method="post" enctype="multipart/form-data">
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
                    <h4 class="modal-title">Add new flavour</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{url('flavours/store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="flavour_name">Flavour Name</label>
                            <input type="text" name="flavour_name" value="{{old('flavour_name')}}" id="flavour_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pid">Product</label>
                            <input type="text" name="pid" value="{{old('pid')}}" id="pid" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="f_description">Description</label>
                            <textarea name="f_description" id="f_description" cols="30" rows="3" class="form-control">{{old('f_description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="f_image">Image</label>
                            <input type="file" name="f_image" id="f_image" class="form-control">
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