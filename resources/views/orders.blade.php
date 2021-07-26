@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Table Header Styling</h5>
        <span>use class <code>table-primary, table-*</code> inside thead tr
            element</span>

    </div>
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table class="table table-styling">
                <thead>
                    <tr class="table-primary">
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection