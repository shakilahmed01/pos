@extends('admin.layouts.adminmaster')
@section('adminTitle')
Supplier List- Admin Dashboard
@stop
@section('adminContent')
<div class="col-md-12 mt-5 pt-3 border-bottom">
	<div class="text-dark px-0" >
		<p class="mb-1"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> Dashboard / </a><a href="{{route('admin.supplierList')}}" class="active-slink">Supplier list</a><span class="top-date">Total Suppliers: {{$suppliers->total()}}</span></p>

	</div>
</div>

<div class="container-fluid p-3">
	<div class="box">
		<div class="box-header">
			<div class="box-icon-left border-right" style="height:100%">
				
					

					<p class="btn mt-0 task-icon"><i class="fa fa-users"></i></p>
				
			</div>
			<h2 class="blue task-label">Supplier</h2>

			<div class="box-icon border-left" style="height:100%">
				<div class="dropdown mt-0">
					

					
						<p class="task-btn" title="Actions">
							<i class="fa fa-th-list"></i>
						</p>
						<div class="task-menu p-2">
							<a class="dropdown-item pl-0" type="button" href="{{route('admin.supplierAdd')}}">
							 <i class="fa-fw fa fa-plus-circle"></i> Add Supplier
							</a>
							
						</div>
					
				</div>
			</div>
		</div>
		<div class="box-content">
			<div class="row">
				<div class="col-lg-12">
					<p class="introtext">Please use the table below to navigate or filter the results. You can download the table as excel and pdf.</p>
					<table class="table table-bordered table-hover">
						<thead class="blue-table-head">
							<tr>
								<th class="font-weight-bold" scope="col">#</th>
								<th class="font-weight-bold" scope="col">Company</th>
								<th class="font-weight-bold" scope="col">Name</th>
								<th class="font-weight-bold" scope="col">Email Address</th>
								<th class="font-weight-bold" scope="col">Phone</th>
								<th class="font-weight-bold" scope="col">Country</th>
								<th class="font-weight-bold" scope="col">City</th>
								<th class="font-weight-bold" scope="col">Actions</th>

							</tr>
						</thead>
						<tbody>
							<?php $counter=0;?>
                            @foreach($suppliers as $supplier)
                            <?php $counter++;?>
							<tr>
								<td>{{$counter}}</td>
								<td>{{$supplier->company}}</td>
								<td>{{$supplier->name}}</td>
								<td>{{$supplier->email}}</td>
								<td>{{$supplier->mobile}}</td>
								<td>{{$supplier->country}}</td>
								<td>{{$supplier->city}}</td>
								<td style="width:120px;">
									<div class="dropdown" style="width:90px;float:right;">
									 <a href="{{route('admin.supplier.supplierDetails',$supplier->id)}}" class="action-btn p-1 m-1 mt-1" >
									   Details
									  </a>
									</div>
							    </td>
							</tr>
							@endforeach
							</tbody>
						</table>
						{{$suppliers->links()}}
				</div>
			</div>
		</div>
	</div>

</div>

</div>

@stop

