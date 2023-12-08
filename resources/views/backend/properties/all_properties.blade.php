@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol>
                <a href="{{route('add.property')}}" class="btn btn-inverse-info"> Add Property </a>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Image</th>
                                        <th>Property Name</th>
                                        <th>P Type</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->property_thumbnail}}</td>
                                        <td>{{$item->property_name}}</td>
                                        <td>{{$item->ptype_id}}</td>
                                        <td>{{$item->city}}</td>
                                    @if ($item->status == 1){
                                        <span class="badge bg-success rounded-pill">Active</span>
                                    }
                                    @else{
                                        <span class="badge bg-danger rounded-pill">Inactive</span>
                                    }
                                    @endif

                                        <td></td>
                                        <td>
                                            <a href="{{route('edit.amenity',$item->id)}}"  type="button" class="btn btn-inverse-warning">Update</a>
                                            <a href="{{route('delete.amenity',$item->id)}}" id="delete"  type="button" class="btn btn-inverse-danger">Delete</a>
                                        </td>
                                    </tr>   
                                    @endforeach
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
