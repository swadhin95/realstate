@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol>
                <a href="{{ route('add.types') }}" class="btn btn-inverse-info"> Add Property Type  </a>

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
                                        <th>Property Name</th>
                                        <th>property Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->types_name}}</td>
                                        <td>{{$item->types_icon}}</td>
                                        <td>
                                            <a href="{{route('edit.types',$item->id)}}"  type="button" class="btn btn-inverse-warning">Update</a>
                                            <a href="{{route('delete.types',$item->id)}}" id="delete"  type="button" class="btn btn-inverse-danger">Delete</a>
                                            
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
