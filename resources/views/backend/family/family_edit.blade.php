@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Family</h4><br><br>
                        <form method="post" action="{{ route('family.update') }}" id="myForm">
                            @csrf

                            <input type="hidden" name="id" value="{{ $family->id }}">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                Family</label>
                                <div class="form-group col-sm-10">
                                    <input name="family" class="form-control" 
                                    value="{{ $family->family }}" type="text">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                Location</label>
                                <div class="form-group col-sm-10">
                                    <input name="location" class="form-control"
                                    value="{{ $postalCode->location }}" type="text">
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" class="btn btn-info waves-effect waves-light"
                            value="Update Family">
                        </form>    
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                family: {
                    required : true,
                },
            },
            messages :{
                family: {
                    required : 'Please Enter Family Description.',
                },
                location: {
                    required : 'Please Enter Location.',
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