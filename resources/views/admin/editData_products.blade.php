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
						<h2><strong>Update Product</strong> Listing</h2>
						
                        <div class="additional-btn">
                            <div class="toolbar-btn-action">
                                <a href="{{ url('admin/edit-products') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Edit Products</a>
                            </div>
						</div>
					</div>
					<div class="widget-content padding">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('admin/updateProduct') }}" role="form">
                        
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
                            
                            @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Error!</strong> {{ Session::get('error') }}
                            </div>
                            @endif
                        
                            @foreach($item as $i)
                    
                            <input type="hidden" name="productId" value="{{$i->productId }}">
                            <input type="hidden" name="imageUrl"  value="{{$i->productImage }}">
                            <input type="hidden" name="imageFullUrl"  value="{{$i->productFullImage }}">
                            <input type="hidden" name="status" value="{{ $i->status }}">
                            
                        <div class="form-group">
                            <label for="productImage" class="col-sm-2 control-label">Product Image</label>
                            <div class="col-sm-4" style="border-right: 2px solid #eee;">
                            <?php $address=substr($i->productImage,42); ?>
                              <img src="{{ url($address)}}" width="250" height="300" alt="{{ $i->productName}}" style="border: 2px solid #eee;padding:2px;">
                            </div>
                            <div class="col-sm-5">
                                <span style="font-size: 14px;font-weight:450;letter-spacing:1px;">
                                    Update Product Image :
                                </span>
                                <br/>
                                <br/>
                                <div class="form-control">
                                <input type="file" name="productImage">
                                </div>
                            </div>
                        </div>
                            
                           <div class="form-group {{ $errors->has('parentCategory') ?  'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Parent Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="parentCategory" title="Select Parent Category">
                                <option value="">-- Select Parent Category --</option>
                                <option value="0" {{ $i->parentCategory=='0' ? 'selected' : ''}}>0 - Root</option>
                                @foreach($parentIds as $parentId)    
                                  <option value="{{$parentId->id }}" {{ $parentId->id==$i->parentCategory ? 'selected' : ''}}>{{ $parentId->id}} - {{  $parentId->name }}</option>
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
							  <input type="text" class="form-control" id="input-text" placeholder="Product Name" name="productName" value="{{ $i->productName }}">
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
							  <input type="text" class="form-control" id="input-text-help" placeholder="Model Number" name="modelNumber" value="{{ $i->modelNumber }}">
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
                              <textarea id="shortDescription" class="form-control" rows="3" placeholder="Short Description of Product" name="shortDescription">{{ $i->shortDescription }}</textarea>
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
                              <input type="text" class="form-control" id="regularPrice" placeholder="Regular Price" name="regularPrice" value="{{ $i->regularPrice }}">
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
                              <input type="text" class="form-control" id="salePrice" placeholder="Sale Price" name="salePrice" value="{{ $i->salePrice }}">
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
                              <input type="text" class="form-control" id="productWeight" placeholder="Weight" name="productWeight" value="{{ $i->productWeight }}">
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
                                    <input type="text" class="form-control"  placeholder="Length" name="productLength" value="{{ $i->productLength }}">
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" placeholder="Breadth" name="productBreadth" value="{{ $i->productBreadth }}">
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control"  placeholder="Height" name="productHeight" value="{{ $i->productHeight }}">
                                  </div>
                                </div>
                            </div>
                        </div>   

                        <div class="form-group {{ $errors->has('productDescription') ? 'has-error' : ' ' }}">
                            <label for="productDescription" class="col-sm-2 control-label">Product Description in Detail</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" rows="12" placeholder="Describe the Product in Detail" id="productDescription" name='productDescription'>{{ $i->productDescription }}</textarea>
                            @if($errors->has('productDescription'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('productDescription') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('productTags') ? 'has-error' : '' }}">
                            <label for="productTags" class="col-sm-2 control-label">Product Tags</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="productTags" placeholder="Product Tags" name="productTags" value="{{ $i->productTags }}">
                                @if($errors->has('productTags'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('productTags') }}</strong>
                                </span>
                                @else
                                <p>Separate Product Tags with commas</p>
                            @endif
                            </div>
                        </div>

                        @endforeach

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
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
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

