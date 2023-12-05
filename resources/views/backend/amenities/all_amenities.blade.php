@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol>
                <a href="{{route('add.amenities')}}" class="btn btn-inverse-info"> Add Amenity  </a>

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
                                        <th>Amenity Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amenities as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->amenity_name}}</td>
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
