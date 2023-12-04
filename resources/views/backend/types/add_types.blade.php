@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card rounded">
                            <div class="card-body">

                                <h6 class="card-title">Add Property Type</h6>

                                <form method="POST" action="{{ route('store.types')}}" class="forms-sample">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Type Name </label>
                                        <input type="text" name="types_name"
                                            class="form-control" @error('types_name') is-invalid @enderror  >
                                            @error('types_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Type Icon </label>
                                        <input type="text" name="types_icon" class="form-control" @error('types_icon') is-invalid @enderror  >
                                            @error('types_icon')
                                              <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2">Save Changes </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
