@extends('admin.layout.auth')

@section('title')
Manage Products
@endsection

@section('page-specific-css')
    <link href="{{ url('admin/css/fileinput.css') }} " rel="stylesheet" type="text/css" />
@endsection
@section('content')

		<!-- Start right content -->
        <div class="content-page">
			<!-- ============================================================== -->
			<!-- Start Content here -->
			<!-- ============================================================== -->
            <div class="content">
            <div class="page-heading">
                <h1><i class='fa fa-star-o'></i> Products</h1>
<!--                <h3>Create Product Categories</h3>-->
            </div>
                <div class="widget">
					<div class="widget-header transparent">
						<h2><strong>Create Product</strong> Listing</h2>
						
                        <div class="additional-btn">
                            <div class="toolbar-btn-action">
                                <a href="{{ url('admin/edit-products') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Edit Products</a>
                            </div>
						</div>
					</div>
					<div class="widget-content padding">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('admin/createProducts') }}" role="form">
                        
                        {{ csrf_field() }}
                            


<!--
                            @if(Session::has('message'))
                            <div class="alert alert-success myAlert">
                                 <a href="#" class="close">&times;</a>
                                <strong>Success!</strong> {{ Session::get('message') }}
                            </div>
                            @endif
-->
                            
                            @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Success!</strong> {{ Session::get('message') }}
                            </div>
                            @endif
                        
                           <div class="form-group {{ $errors->has('parentCategory') ?  'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Select Parent Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="parentCategory" title="Select Parent Category">
                                <option value="">-- Select Parent Category --</option>
                                @foreach($parentIds as $parentId)    
                                  <option value="{{ $parentId->id  }}" {{ old('parentCategory')==$parentId->id ? 'selected' : ''}}>{{ $parentId->id}} - {{  $parentId->name }}</option>
                                @endforeach
                                </select>
                                @if($errors->has('parentCategory'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('parentCategory') }}</strong>
                                </span>
                                @endif
                            </div>
                          </div>


                            <div class="form-group {{ $errors->has('productName') ? 'has-error':''}}">
							<label for="input-text" class="col-sm-2 control-label">Product Name</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input-text" placeholder="Product Name" name="productName" value="{{ old('productName') }}">
                                @if($errors->has('productName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productName') }}</strong>
                                    </span>
                                @endif
							</div>
						  </div>


                            
						<div class="form-group {{ $errors->has('modelNumber') ? 'has-error' : '' }}">
							<label for="input-text-help" class="col-sm-2 control-label">Model number</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input-text-help" placeholder="Model Number" name="modelNumber" value="{{ old('modelNumber') }}">
                                @if($errors->has('modelNumber'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('modelNumber') }}</strong>
                                </span>
                            @endif
							</div>
						  </div>
                            
                          <div class="form-group {{ $errors->has('shortDescription') ? 'has-error' : '' }}">
                            <label for="shortDescription" class="col-sm-2 control-label">Product Short Description</label>
                            <div class="col-sm-10">
                              <textarea id="shortDescription" class="form-control" rows="3" placeholder="Short Description of Product" name="shortDescription">{{ old('shortDescription') }}</textarea>
                              @if($errors->has('shortDescription'))
                              <span class="help-block">
                                <strong>{{ $errors->first('shortDescription') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>

                        <div class="form-group {{ $errors->has('regularPrice') ? 'has-error' : '' }}">
                            <label for="regularPrice" class="col-sm-2 control-label">Regular Price (Rs.)</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="regularPrice" placeholder="Regular Price" name="regularPrice" value="{{ old('regularPrice') }}">
                                @if($errors->has('regularPrice'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('regularPrice') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('salePrice') ? 'has-error' : '' }}">
                            <label for="salePrice" class="col-sm-2 control-label">Sale Price (Rs.)</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="salePrice" placeholder="Sale Price" name="salePrice" value="{{ old('salePrice') }}">
                                @if($errors->has('salePrice'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('salePrice') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('productWeight') ? 'has-error' : '' }}">
                            <label for="productWeight" class="col-sm-2 control-label">Weight (Kg)</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="productWeight" placeholder="Weight" name="productWeight" value="{{ old('productWeight') }}">
                                @if($errors->has('productWeight'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('productWeight') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="productLength" class="col-sm-2 control-label">Dimensions (Inch)</label>
                            <div class="col-sm-10">
                              <div class="row">
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control"  placeholder="Length" name="productLength" value="{{ old('productLength') }}">
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" placeholder="Breadth" name="productBreadth" value="{{ old('productBreadth') }}">
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control"  placeholder="Height" name="productHeight" value="{{ old('productHeight') }}">
                                  </div>
                                </div>
                            </div>
                        </div>   

                        <div class="form-group {{ $errors->has('productDescription') ? 'has-error' : ' ' }}">
                            <label for="productDescription" class="col-sm-2 control-label">Product Description in Detail</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" rows="12" placeholder="Describe the Product in Detail" id="productDescription" name='productDescription'>{{ old('productDescription') }}</textarea>
                            @if($errors->has('productDescription'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('productDescription') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('productImage') ? 'has-error' : '' }}">
                            <label for="productImage" class="col-sm-2 control-label">Product Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" id="productImage" name="productImage">
                                @if($errors->has('productImage'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('productImage') }}</strong>
                                </span>
                                @else
                                <p>This will be used as Product Image</p>
                            @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('productTags') ? 'has-error' : '' }}">
                            <label for="productTags" class="col-sm-2 control-label">Product Tags</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="productTags" placeholder="Product Tags" name="productTags" value="{{ old('productTags') }}">
                                @if($errors->has('productTags'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('productTags') }}</strong>
                                </span>
                                @else
                                <p>Separate Product Tags with commas</p>
                            @endif
                            </div>
                        </div>



<!--
                        <div class="form-group {{ $errors->has('productGallery') ? 'has-error' : '' }}">
                            <label for="productGallery" class="col-sm-2 control-label">Image Gallery</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" id="productGallery" name="productGallery" multiple>
                                @if($errors->has('productGallery'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('productGallery') }}</strong>
                                </span>
                                @else
                                <p>Choose multiple images to create Product Gallery</p>
                            @endif
                            </div>
                        </div>
-->
                        

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-5">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                            </div>
						</form>

					</div>
					
				</div> 

            </div>
			<!-- ============================================================== -->
			<!-- End content here -->
			<!-- ============================================================== -->

        </div>
		<!-- End right content -->

@endsection

@section('page-specific-js')
<!-- Page Specific JS Libraries -->
	<script src="{{ url('admin/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
	<script src="{{ url('admin/libs/bootstrap-inputmask/inputmask.js') }}"></script>
	<script src="{{ url('admin/libs/summernote/summernote.js') }}"></script>
	<script src="{{ url('admin/js/pages/forms.js') }}"></script>
@endsection

