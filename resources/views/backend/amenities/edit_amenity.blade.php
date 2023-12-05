@extends('admin.admin_dashboard')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card rounded">
                            <div class="card-body">

                                <h6 class="card-title">Add Amenity</h6>

                                <form id="myForm" method="POST" action="{{route('update.amenity')}}" class="forms-sample">
                                    @csrf

                                    <input type="hidden" name="id" value="{{$amenity->id}}"> 

                                    <div class=" form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Amenity Name</label>
                                        <input type="text" name="amenity_name" class="form-control" value="{{$amenity->amenity_name}}">
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



    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    amenity_name: {
                        required : true,
                    }, 
                    
                },
                messages :{
                    amenity_name: {
                        required : 'Please Enter Amenity Name',
                    }, 
                     
    
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
        
    </script>
@endsection
