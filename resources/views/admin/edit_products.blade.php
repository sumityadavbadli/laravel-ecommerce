@extends('admin.layout.auth')

@section('title')
Manage Products
@endsection

@section('page-specific-css')
    <link href="{{ url('admin/libs/bootstrap-select/bootstrap-select.min.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/libs/summernote/summernote-bs2.css') }} " rel="stylesheet" type="text/css" />
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
								<h2><strong>Edit</strong> Product Listing</h2>
								<div class="additional-btn">
									<a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
									<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
									<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
								</div>
							</div>
							<div class="widget-content">
								<div class="data-table-toolbar">
									<div class="row">
										<div class="col-md-4">
											<form role="form">
											<input type="text" class="form-control" placeholder="Search...">
											</form>
										</div>
										<div class="col-md-6">
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
									</div>
										<div class="col-md-2">
											<div class="toolbar-btn-action">
                                                @if(count($Table))
                                                <a href="{{ url('admin/create-products') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
												@endif
											</div>
										</div>
									</div>
								</div>
                                 @if(count($Table))
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped">
										<thead>
											<tr>
												<th>Id</th>
                                                <th>Product Id</th>
                                                <th>Parent Category</th>
                                                <th>Product Name</th>
												<th>Model Number</th>
												<th>Sale Price</th>
                                                <th>Product Tags</th>
                                                <th>Status</th>
												<th data-sortable="false">Edit</th>
												<th data-sortable="false">Delete</th>
											</tr>
										</thead>
										
										<tbody>
											@foreach($Table as $cat)
                                            <tr>
												<td>{{ $cat->id}}</td>
                                                <td><strong>{{ $cat->productId }}</strong></td>
												<td>{{ $cat->parentCategory }}</td>
                                                <td>{{ $cat->productName }}</td>
                                                <td>{{ $cat->modelNumber }}</td>
                                                <td>{{ $cat->salePrice }}</td>
                                                <td>{{ $cat->productTags }}</td>
                                                <td>{{ $cat->status }}</td>
                                                

                                                <td><a href="edit-this-product/{{ $cat->productId}}" class="btn btn-blue-1">Edit</a></td>
                                                <td><a href="delete-this-product/{{ $cat->productId}}" class="btn btn-orange-1">Delete</a></td>
											</tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
                                @else
                                <div class="container">
                                <br/>
                                <span style="font-size:20px;margin-top:50px;padding-bottom:50px;">Sorry ! Table is Empty. 
                                    <br/> <br/>
                                    <a href="{{ url('admin/create-products') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new Product</a></span><br/><br/>
                                </div>
								@endif	
								<div class="data-table-toolbar">
									{{ $Table->links() }}
								</div>
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

