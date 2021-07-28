@extends('layouts.app')

@section('content')
<!-- Page-header start -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Customer Management</h4>
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
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Customer List</a>
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
                    <h5>Customer List</h5>
                    <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger" data-toggle="modal" data-target="#addnewmodel"> <i class="icofont icofont-plus m-r-5"></i> Add New
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Default Address</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{$row->c_fname.' '.$row->c_lname}}</td>
                                            <td>{{$row->c_email}}</td>
                                            <td>{{$row->c_defaultaddressid}}</td>
                                            <td>{{$row->created_at}}</td>
                                            <td>{{$row->updated_at}}</td>
                                            <td class="action-icon">
                                                <a href="#!" data-toggle="modal" data-target="#editmodel{{$row->id}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="icofont icofont-ui-edit"></i></a>
                                                <div class="modal" id="editmodel{{$row->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Customer</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form action="{{url('customers/update/'.$row->id)}}" method="post">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="c_fname">First Name</label>
                                                                        <input type="text" name="c_fname" value="{{$row->c_fname}}" id="c_fname" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="c_lname">Last Name</label>
                                                                        <input type="text" name="c_lname" value="{{$row->c_lname}}" id="c_lname" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="c_email">Email</label>
                                                                        <input type="email" name="c_email" value="{{$row->c_email}}" id="c_email" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="c_defaultaddressid">Default address</label>
                                                                        <textarea name="c_defaultaddressid" id="c_defaultaddressid" cols="30" rows="3" class="form-control">{{$row->c_defaultaddressid}}</textarea>
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
                                                                <form action="{{url('customers/delete/'.$row->id)}}" method="post">
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
                    <h4 class="modal-title">Add new flavour</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{url('customers/store/')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="c_fname">First Name</label>
                            <input type="text" name="c_fname" value="{{old('c_fname')}}" id="c_fname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="c_lname">Last Name</label>
                            <input type="text" name="c_lname" value="{{old('c_lname')}}" id="c_lname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="c_email">Email</label>
                            <input type="email" name="c_email" value="{{old('c_email')}}" id="c_email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="c_password">Password</label>
                            <input type="password" name="c_password" id="c_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="c_defaultaddressid">Default address</label>
                            <textarea name="c_defaultaddressid" id="c_defaultaddressid" cols="30" rows="3" class="form-control"></textarea>
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