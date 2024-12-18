@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Tax Rate</h4><br><br>
                        <form method="post" action="{{ route('taxRate.update') }}" id="myForm">
                            @csrf

                            <input type="hidden" name="id" value="{{ $taxRate->id }}">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                Tax Rate Code</label>
                                <div class="form-group col-sm-10">
                                    <input name="taxRateCode" class="form-control" 
                                    value="{{ $taxRate->taxRateCode }}" type="number">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                Description Tax Rate</label>
                                <div class="form-group col-sm-10">
                                    <input name="descriptiontaxRate" class="form-control" 
                                    value="{{ $taxRate->descriptiontaxRate }}" type="text">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                Tax Rate</label>
                                <div class="form-group col-sm-10">
                                    <input name="taxRate" class="form-control" 
                                    value="{{ $taxRate->taxRate }}" type="number">
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" class="btn btn-info waves-effect waves-light"
                            value="Update Tax Rate">
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
                taxRateCode: {
                    required : true,
                },
                descriptiontaxRate: {
                    required : true,
                },
                taxRate: {
                    required : true,
                },
            },
            messages :{
                taxRateCode: {
                    required : 'Please Enter Tax Rate Code.',
                },
                descriptiontaxRate: {
                    required : 'Please Enter Tax Rate Description.',
                },
                taxRate: {
                    required : 'Please Enter Tax Rate.',
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