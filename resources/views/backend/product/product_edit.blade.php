@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page -->
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center\justify-content-between">
                <h4 class="mb-sm-0">Edit Product</h4>
            </div>
        </div>
    </div>
    <!-- end page -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form method="post" action="{{ route('product.update') }}" id="myForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" , value="{{ $product->id }}">

                        <div class="form-group row mb-3">
                            <!-- Product Code -->
                            <label for="example-text-input" class="col-sm-1 col-form-label">Code</label>
                            <div class="form-group col-sm-2">
                                <input id="code" name="code" class="form-control" type="text" value="{{ $product->code }}">
                            </div>
                            <!-- end row -->

                            <label for="example-text-input" class="col-sm-1 col-form-label">Description</label>
                            <div class="form-group col-sm-8">
                                <input id="description" name="description" class="form-control" type="text" value="{{ $product->description }}">
                            </div>
                            <!-- end row -->


                            <div class="form-group row mb-3">
                                <!-- Product Family -->
                                <label for="example-text-input" class="col-sm-1 col-form-label">Family</label>
                                <div class="col-sm-2 form-group">
                                    <select id="product_family" name="product_family" aria-label="Default select example" class="form-select select2">
                                        <option select=""></option>
                                        @foreach($families as $prod)
                                        <option iOption="" value="{{ $prod->family }}">
                                            {{ $prod->family == $product->family ? 'selected' : '' }} > {{ $prod->family }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <!-- Product Unit -->
                            <label for="example-text-input" class="col-sm-1 col-form-label">Unit</label>
                            <div class="col-sm-2 form-group">
                                <select id="product_unit" name="product_unit" class="form-select select2" aria-label="Default select example">
                                    <option selected=""></option>
                                    @foreach($unitMeasures as $prod)
                                    <option iOption1="" value="{{ $prod->unit }}">
                                        {{ $prod->unit == $product->unit  }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end row -->

                            <!-- Tax Rate -->
                            <label for="example-text-input" class="col-sm-1 col-form-label">Tax Rate</label>
                            <div class="form-group col-sm-1">
                                <select id="product_taxRateCode" name="taxRateCode_Product" class="form-select select2" aria-label="Default select example">
                                    <option selected=""></option>
                                    @foreach($taxRates as $prod)
                                    <option iTaxDescription="{{ $prod->descriptionTaxRate }} - {{ $prod->taxRate }}%" value="{{ $prod->taxRateCode }}">
                                        {{ $prod->taxRateCode == $product->taxRateCode ? 'selected' : '' }} > {{ $prod->taxRateCode }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end row -->

                            <label for="example-text-input" id="lbTaxDescription" name="lbTaxDescription"
                                class="col-sm-4 col-form-label"></label>
                        </div>
                        <!-- end row -->


                        <!-- Product Image File -->
                        <div class="form-group row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label">Image Product</label>
                            <div class="col-sm-11 d-none">
                                <input name="profile_image" class="form-control" type="file" id="image">
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="form-group row mb-3">
                            <input type="submit" class="col-sm-1 btn btn-info waves-effect waves-light" value="Update Product">
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#showImage').click(function() {
            $('#image').click();
        });

        $('#image').change(function(e) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#product_TaxRateCode').change(function (){
            $("#lbTaxDescription").text("");
            $("#lbTaxDescription").text("#product_taxRateCode option:selected").attr("iTaxDescription");
        });

        $('#product_taxRateCode').trigger('change');

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
            },
            messages: {
                code: {
                    required: 'Please Enter Supplier Code.',
                },
                description: {
                    required: 'Please Enter Product Description.',
                },
                product_family: {
                    required: 'Please Enter Product Family.',
                },
                product_unit: {
                    required: 'Please Enter Product Unit.',
                },
                taxRateCode_Product: {
                    required: 'Please Enter Product Tax Rate Code.',
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