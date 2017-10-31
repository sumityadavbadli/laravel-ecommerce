@extends('admin.layout.auth')

@section('title')
Dashboard
@endsection

@section('content')

		<!-- Start right content -->
        <div class="content-page">
			<!-- ============================================================== -->
			<!-- Start Content here -->
			<!-- ============================================================== -->
            <div class="content">
            <div class="page-heading">
                <h1><i class='glyphicon glyphicon-th-large'></i> Categories</h1>
<!--                <h3>Create Product Categories</h3>-->
            </div>
                <div class="widget">
					<div class="widget-header transparent">
						<h2><strong>Edit Product</strong> Categories</h2>
						<div class="additional-btn">
<!--							<a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>-->
							<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
<!--							<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>-->
						</div>
					</div>
					<div class="widget-content padding">
						<form class="form-horizontal" method="post"  action="{{ url('admin/updateCategory') }}" role="form">
                        
                        {{ csrf_field() }}
                            
                           
                            @foreach($item as $i)
                            <input type="hidden" value="{{ $i->id}}" name="itemId">
                            <div class="form-group {{ $errors->has('parentCategory') ?  'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Select Parent Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="parentCategory" title="Select Parent Category">
                                <option value="">-- Select Parent Category --</option>       
                                <option value="0" {{ $i->parentId ==0 ? 'selected' : ''}} >Root</option>
                                
                                @foreach($parentIds as $parentId)    
                                  <option value="{{ $parentId->id  }}" {{ $parentId->id == $i->parentId ? 'selected' : '' }} >{{ $parentId->id}} - {{  $parentId->name }}</option>
                                @endforeach
                                </select>

                                @if($errors->has('parentCategory'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('parentCategory') }}</strong>
                                </span>
                                @endif
                            </div>
                          </div> 

                            <div class="form-group {{ $errors->has('categoryName') ? 'has-error':''}}">
							<label for="input-text" class="col-sm-2 control-label">Category Name</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input-text" placeholder="Category Name" name="categoryName" value="{{ $i->name}}">
                                @if($errors->has('categoryName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoryName') }}</strong>
                                    </span>
                                @endif
							</div>
						  </div>
                            
						<div class="form-group {{ $errors->has('categoryDesciption') ? 'has-error' : '' }}">
							<label for="input-text-help" class="col-sm-2 control-label">Category Description</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="input-text-help" placeholder="Category Description" name="categoryDesciption" value="{{$i->description  }}">
                                @if($errors->has('categoryDesciption'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('categoryDesciption') }}</strong>
                                </span>
                                @else
							  <p class="help-block">Describe a little about the category.</p>
                            @endif
							</div>
						  </div>
                            
                           
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-5">
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                            </div>
                            </div>
                            
                        @endforeach
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

