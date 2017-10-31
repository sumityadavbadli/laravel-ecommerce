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
				<!-- Start info box -->
				<div class="row top-summary">
					<div class="col-lg-3 col-md-6">
						<div class="widget green-1 animated fadeInDown">
							<div class="widget-content padding">
								<div class="widget-icon">
									<i class="icon-globe-inv"></i>
								</div>
								<div class="text-box">
									<p class="maindata">TOTAL <b>VISITORS</b></p>
									<h2><span class="animate-number" data-value="25153" data-duration="3000">0</span></h2>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="widget-footer">
								<div class="row">
									<div class="col-sm-12">
										<i class="fa fa-caret-up rel-change"></i> <b>39%</b> increase in traffic
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="widget darkblue-2 animated fadeInDown">
							<div class="widget-content padding">
								<div class="widget-icon">
									<i class="icon-bag"></i>
								</div>
								<div class="text-box">
									<p class="maindata">TOTAL <b>SALES</b></p>
									<h2><span class="animate-number" data-value="6399" data-duration="3000">0</span></h2>

									<div class="clearfix"></div>
								</div>
							</div>
							<div class="widget-footer">
								<div class="row">
									<div class="col-sm-12">
										<i class="fa fa-caret-down rel-change"></i> <b>11%</b> decrease in sales
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="widget orange-4 animated fadeInDown">
							<div class="widget-content padding">
								<div class="widget-icon">
									<i class="fa fa-dollar"></i>
								</div>
								<div class="text-box">
									<p class="maindata">OVERALL <b>INCOME</b></p>
									<h2>$<span class="animate-number" data-value="70389" data-duration="3000">0</span></h2>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="widget-footer">
								<div class="row">
									<div class="col-sm-12">
										<i class="fa fa-caret-down rel-change"></i> <b>7%</b> decrease in income
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="widget lightblue-1 animated fadeInDown">
							<div class="widget-content padding">
								<div class="widget-icon">
									<i class="fa fa-users"></i>
								</div>
								<div class="text-box">
									<p class="maindata">TOTAL <b>USERS</b></p>
									<h2><span class="animate-number" data-value="18648" data-duration="3000">0</span></h2>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="widget-footer">
								<div class="row">
									<div class="col-sm-12">
										<i class="fa fa-caret-up rel-change"></i> <b>6%</b> increase in users
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

				</div>
				<!-- End of info box -->

				<div class="row">
					<div class="col-lg-8 portlets">
						
                        <div class="widget">
							<div class="widget-header">
								<h2><i class="icon-chart-pie-1"></i> <strong>Sales</strong> Report</h2>
							</div>
							<div class="widget-content">
								<div class="row stacked">
									<div class="col-sm-12 mini-stats">
										<div class="sales-report-data">
											<span class="pull-left">Completed Sales</span><span class="pull-right">65 / 174</span>
											<div class="progress progress-xs">
												<div style="width: 38%;" class="progress-bar bg-blue-1"></div>
											</div>
											<div class="clearfix"></div>
											<span class="pull-left">Return(s) Processed</span><span class="pull-right">22 / 25</span>
											<div class="progress progress-xs">
												<div style="width: 88%;" class="progress-bar bg-lightblue-1"></div>
											</div>
											<div class="clearfix"></div>
											<span class="pull-left">Shipped Products</span><span class="pull-right">418 / 624</span>
											<div class="progress progress-xs">
												<div style="width: 58%;" class="progress-bar"></div>
											</div>
											<div class="clearfix"></div>
											<span class="pull-left">Overall Product Stock</span><span class="pull-right">19%</span>
											<div class="progress progress-xs">
												<div style="width: 19%;" class="progress-bar bg-pink-1"></div>
											</div>
										</div>
									</div>

								</div>
                                <div id="sales-report" class="collapse in hidden-xs">
									<div class="table-responsive">
									<table data-sortable class="table table-striped">
										<thead>
											<tr><th width="70">No</th><th data-sortable="false" width="40"><input type="checkbox" id="select-all-rows"></th><th width="120">Order ID</th><th>Buyer</th><th width="100">Status</th><th width="150">Location</th><th width="120">Total</th></tr>
										</thead>
										<tbody>
											<tr><td>1</td><td><input type="checkbox" class="rows-check"></td><td>#0021</td><td><a href="#">John Doe</a></td><td><span class="label label-primary">Order</span></td><td>Yogyakarta, ID</td><td><strong class="text-primary">&#36; 1,245</strong></td></tr>
											<tr><td>2</td><td><input type="checkbox" class="rows-check"></td><td>#0022</td><td><a href="#">Johnny Depp</a></td><td><span class="label label-success">Payment</span></td><td>London, UK</td><td><strong class="text-success">&#36; 1,245</strong></td></tr>
											<tr><td>3</td><td><input type="checkbox" class="rows-check"></td><td>#0023</td><td><a href="#">Scarlett Johansson</a></td><td><span class="label label-success">Payment</span></td><td>Canbera, AU</td><td><strong class="text-success">&#36; 1,245</strong></td></tr>
											<tr><td>4</td><td><input type="checkbox" class="rows-check"></td><td>#0024</td><td><a href="#">Hanna Barbara</a></td><td><span class="label label-danger">Cancel</span></td><td>Bali, ID</td><td><strong class="text-danger">&#36; 1,245</strong></td></tr>
											<tr><td>5</td><td><input type="checkbox" class="rows-check"></td><td>#0025</td><td><a href="#">Ali Larter</a></td><td><span class="label label-primary">Order</span></td><td>Bandung, ID</td><td><strong class="text-primary">&#36; 1,245</strong></td></tr>
											<tr><td>6</td><td><input type="checkbox" class="rows-check"></td><td>#0026</td><td><a href="#">Willy Wonka</a></td><td><span class="label label-danger">Cancel</span></td><td>Semarang, ID</td><td><strong class="text-danger">&#36; 1,245</strong></td></tr>
											<tr><td>7</td><td><input type="checkbox" class="rows-check"></td><td>#0027</td><td><a href="#">Chris Isaac</a></td><td><span class="label label-warning">Waiting</span></td><td>New York, US</td><td><strong class="text-warning">&#36; 1,245</strong></td></tr>
											<tr><td>8</td><td><input type="checkbox" class="rows-check"></td><td>#0028</td><td><a href="#">Jenny Doe</a></td><td><span class="label label-primary">Order</span></td><td>Boston, US</td><td><strong class="text-primary">&#36; 1,245</strong></td></tr>
											<tr><td>9</td><td><input type="checkbox" class="rows-check"></td><td>#0029</td><td><a href="#">Ban ki moon</a></td><td><span class="label label-danger">Cancel</span></td><td>Boston, US</td><td><strong class="text-danger">&#36; 1,245</strong></td></tr>

										</tbody>
									</table>
									</div>
								</div>
								<div class="clearfix"></div>

							</div>
						</div>

					</div>
					<div class="col-lg-4 portlets">
                        <div class="row">
                        <div id="todo-app" class="widget">
									<div class="widget-header centered">
										<div class="left-btn"><a class="btn btn-sm btn-default add-todo"><i class="fa fa-plus"></i></a></div>
										<h2>Todo List</h2>
										<div class="additional-btn">
											<a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
											<a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
											<a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
											<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
											<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
										</div>
									</div>
									<div class="widget-content padding-sm">
										<ul class="todo-list">
											<li>
												<span class="check-icon"><input type="checkbox" /></span>
												<span class="todo-item">Generate monthly sales report for John</span>
												<span class="todo-options pull-right">
													<a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
												</span>
												<span class="todo-tags pull-right">
													<div class="label label-success">New</div>
												</span>
											</li>
											<li class="high">
												<span class="check-icon"><input type="checkbox" /></span>
												<span class="todo-item">Mail those reports to John</span>
												<span class="todo-options pull-right">
													<a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
												</span>
											</li>
											<li>
												<span class="check-icon"><input type="checkbox" /></span>
												<span class="todo-item">Don't forget to send those reports to John</span>
												<span class="todo-options pull-right">
													<a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
												</span>
											</li>
											<li class="medium">
												<span class="check-icon"><input type="checkbox" /></span>
												<span class="todo-item">If you forgot, go back to office to pick them up</span>
												<span class="todo-options pull-right">
													<a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
												</span>
												<span class="todo-tags pull-right">
													<div class="label label-info">Today</div>
												</span>
											</li>
											<li class="low">
												<span class="check-icon"><input type="checkbox" /></span>
												<span class="todo-item">Deliver reports by hand to John</span>
												<span class="todo-options pull-right">
													<a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
												</span>
											</li>
											<li>
												<span class="check-icon"><input type="checkbox" /></span>
												<span class="todo-item">Say John that you are sorry</span>
												<span class="todo-options pull-right">
													<a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
												</span>
											</li>
											<li>
												<span class="check-icon"><input type="checkbox" /></span>
												<span class="todo-item">Beg for your job...</span>
												<span class="todo-options pull-right">
													<a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
												</span>
												<span class="todo-tags pull-right">
													<div class="label label-danger">Important</div>
												</span>
											</li>
											<li>
												<span class="check-icon"><input type="checkbox" /></span>
												<span class="todo-item">Look for a new job</span>
												<span class="todo-options pull-right">
													<a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
												</span>
												<span class="todo-tags pull-right">
													<div class="label label-warning"><i class="icon-search"></i></div>
												</span>
											</li>
										</ul>
									</div>
								</div>						
                        </div>						
					</div>
				</div>


				

            <!-- Footer Start -->
            <footer>
                Huban Creative &copy; 2014
                <div class="footer-links pull-right">
                	<a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Legal</a><a href="#">Help</a><a href="#">Contact Us</a>
                </div>
            </footer>
            <!-- Footer End -->			
            </div>
			<!-- ============================================================== -->
			<!-- End content here -->
			<!-- ============================================================== -->

        </div>
		<!-- End right content -->

@endsection

@section('page-specific-js')
<!-- Page Specific JS Libraries -->
	<script src="{{ url('admin/libs/d3/d3.v3.js') }}"></script>
	<script src="{{ url('admin/libs/rickshaw/rickshaw.min.js') }}"></script>
	<script src="{{ url('admin/libs/raphael/raphael-min.js') }}"></script>
	<script src="{{ url('admin/libs/morrischart/morris.min.js') }}"></script>
	<script src="{{ url('admin/libs/jquery-knob/jquery.knob.js') }}"></script>
	<script src="{{ url('admin/libs/jquery-clock/clock.js') }}"></script>
	<script src="{{ url('admin/libs/bootstrap-xeditable/js/bootstrap-editable.min.js') }}"></script>

	
	<script src="{{ url('admin/js/apps/todo.js') }}"></script>
	<script src="{{ url('admin/js/apps/notes.js') }}"></script>
	<script src="{{ url('admin/js/pages/index.js') }}"></script>

@endsection
