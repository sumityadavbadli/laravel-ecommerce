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
                <h1><i class='fa fa-bullhorn'></i> Popular Products</h1>
                <p class="pull-right" style="font-size:16px;color: red;"><strong>Note: </strong> Red Marked Row Ids are Already on Home Page.</p>
<!--                <h3>Create Product Categories</h3>-->
            </div>
               
              
            <div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Add</strong> Popular Products</h2>
                                
                                <div class="notice">
                                    
                                </div>
                                
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
<!--												<a href="{{ url('admin/create-products') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>-->
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
                                                <th>Product Name</th>
												<th>Model Number</th>
												<th>Sale Price</th>
                                                <th>Product Tags</th>
                                                <th data-sortable="false">Add To List</th>
                                                <th data-sortable="false">Remove From List</th>
											</tr>
										</thead>
										
										<tbody>
											@foreach($Table as $cat)
                                                  
                                           <?php $flag = 0; ?>
                                            <tr>
    <td style="{{ $cat->productId==$displayed[0] ? 'background-color:rgba(255,0,0,0.2);' : ($cat->productId==$displayed[1] ? 'background-color:rgba(255,0,0,0.2);' : ($cat->productId==$displayed[2] ? 'background-color:rgba(255,0,0,0.2);' : ($cat->productId==$displayed[3] ? 'background-color:rgba(255,0,0,0.2);' : ' ' )  ) )  }}">{{ $cat->id}}</td>
                                                <td ><strong>{{ $cat->productId }}</strong></td>
                                                <td>{{ $cat->productName }}</td>
                                                <td>{{ $cat->modelNumber }}</td>
                                                <td>{{ $cat->salePrice }}</td>
                                                <td>{{ $cat->productTags }}</td>
                                                
                                        <!-- ----------------------------------------------- -->
                                        
                                                @if(!count($special))
                                                <td><a href="add-popular-product/{{ $cat->productId}}" class="btn btn-blue-3">Add</a></td>
                                                <td><a href="delete-this-popularProduct/{{ $cat->productId}}" class="btn btn-orange-1" disabled>Remove</a></td>
                                                @endif
                                               

                                        @if(count($special))
                                            @foreach($special as $key=>$sp)
                                                                                                
                                                @if($cat->productId == $sp->productId)
                                                  <td><a href="add-popular-product/{{ $cat->productId}}" class="btn btn-green-3" {{ $cat->productId == $sp->productId ? 'disabled' : ''}}> {{ $cat->productId == $sp->productId ? 'Added' : 'Add'}}</a></td>
                                                
                                                  <td><a href="delete-this-popularProduct/{{ $cat->productId}}" class="btn btn-orange-1" {{ $cat->productId == $sp->productId ? '' : 'disabled'}}>Remove</a></td>
                                                <?php $flag=1; ?>
                                                @endif
                                                
                                            @endforeach
                                        @endif
                                                @if(!$flag && count($special))
                                                <td><a href="add-popular-product/{{ $cat->productId}}" class="btn btn-green-3">Add</a></td>
                                                <td><a href="delete-this-popularProduct/{{ $cat->productId}}" class="btn btn-orange-1" disabled>Remove</a></td>  
                                                @endif
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

