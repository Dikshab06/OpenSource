@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page -->
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center\justify-content-between">
                <h4 class="mb-sm-0">Add Product</h4>
            </div>
        </div>
        <!-- end page -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('product.store') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-3">
                                <!-- Product Code -->
                                <label for="example-text-input" class="col-sm-2 col-form-label">Product Code</label>
                                <div class="form-group col-sm-10">
                                    <input name="code" class="form-control" type="text">
                                </div>

                                <!-- end row -->

                                <div class="row mb-3">
                                    <!-- Product Description -->
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="form-group col-sm-10">
                                        <input name="description" class="form-control" type="text">
                                    </div>
                                </div>
<<<<<<< HEAD
                                <!-- end row -->


                                <!-- Product Family -->
                                <label for="example-text-input" class="col-sm-2 col-form-label">Group Family</label>
=======
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Family</label>
                                <select id="product_family" name="product_family" class="form-select select2" aria-label="Default select example">
                                        <option selected=""></option>
                                        @foreach($familys as $prod)
                                        <option iOption= "" value="{{$prod->family}}">{{$prod->family}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Unit</label>
                                <select id="product_unit" name="product_unit" class="form-select select2" aria-label="Default select example">
                                        <option selected=""></option>
                                        @foreach($unitMesures as $prod)
                                        <option iOption= "" value="{{$prod->unitMesure}}">{{$prod->unitMesure}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Tax Rate</label>
>>>>>>> 4ad9b74aa8af4abfc993c5fb0173e513015902f0
                                <div class="form-group col-sm-2">
                                    <select id="product_family" name="product_family" aria-label="Default select example" class="form-select select2">
                                        <option select=""></option>
                                        @foreach($families as $prod)
                                        <option value="{{ $prod->family }}">
                                            {{ $prod->family}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- end row -->

                                <!-- Product Unit -->
                                <label for="example-text-input" class="col-sm-2 col-form-label">Measure Unit</label>
                                <div class="col-sm-2 form-group">
                                    <select id="product_unit" name="product_unit" class="form-select select2" aria-label="Default select example">
                                        <option selected=""></option>
                                        @foreach($unitMeasures as $prod)
                                        <option iOption1="" value="{{ $prod->unit }}">
                                            {{ $prod->unit }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- end row -->

                                <!-- Product Tax Rates -->
                                <label for="example-text-input" class="col-sm-1 col-form-label">Tax Rate</label>
                                <div class="form-group col-sm-1">
                                    <select id="product_taxRateCode" name="taxRateCode_Product" class="form-select select2" aria-label="Default select example">
                                        <option selected=""></option>
                                        @foreach($taxRates as $prod)
                                        <option iTaxDescription="{{ $prod->descriptionTaxRate }} - {{ $prod->taxRate }}%" value="{{ $prod->taxRateCode }}">
                                            {{ $prod->taxRateCode }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="example-text-input" id="lbTaxDescription" name="lbTaxDescription" class="col-sm-4 col-form-label"></label>
                            </div>

                            <div class="form-group row mb-3">
                                <!-- Product Image File -->
                                <div class="col-sm-11">
                                    <input name="profile_image" class="form-control" type="file" id="image">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <!-- Product Image -->
                                <label for="example-text-input" class="col-sm-1 col-form-label">Image Product</label>
                                <div class="col-sm-11">
                                    <img id="showImage" class="rouded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="image">
                                </div>
                            </div>

                            <div class="form-group row-mb3">
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#showImage').click(function() {
            $('#image').click();
        });

        $('image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $("#product_taxRateCode").change(function(){
            $("#lbTaxDescription").text("");
            $("#lbTaxDescription").text($("#product_taxRateCode option:selected").attr("iTaxDescription"));
        });

        $('#myForm').validate({
            rules: {
                code: {
                    required: true,
                },
                description: {
                    required: true,
                },
                product_family: {
                    required: true,
                },
                product_unit: {
                    required: true,
                },
                taxRateCode_Product: {
                    required: true,
                },
                profile_image: {
                    required: true,
                },
            },
            messages: {
                code: {
                    required: 'Please Enter Code Product.',
                },
                description: {
                    required: 'Please Enter Description Product.',
                },
                product_family: {
                    required: 'Please Enter Family Description.',
                },
                product_unit: {
                    required: 'Please Enter Measure Unit Product.',
                },
                taxRateCode_Product: {
                    required: 'Please Enter Measure Tax Rate Code Product.',
                },
                profile_image: {
                    required: 'Please Enter Image Product.',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

@endsection