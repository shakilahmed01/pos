@extends('admin.layouts.adminmaster')
@section('adminTitle')
Billers List- Admin Dashboard
@stop
@section('adminContent')
<div class="col-md-12 mt-5 pt-3 border-bottom">
	<div class="text-dark px-0" >
		<p class="mb-1"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> Dashboard / </a><a href="" class="active-slink">Billers</a><span class="top-date">{{date('l, jS F Y')}}</span></p>

	</div>
</div>

<div class="container-fluid p-3">
	<div class="box">
		<div class="box-header">
			<div class="box-icon-left border-right" style="height:100%">
				
				

				<p class="btn mt-0 task-icon"><i class="fa fa-users"></i></p>
				
			</div>
			<h2 class="blue task-label">Biller</h2>

			<div class="box-icon border-left" style="height:100%">
				<div class="dropdown mt-0">
					<p class="task-btn" title="Actions">
						<i class="fa fa-th-list"></i>
					</p>
					<div class="task-menu p-2">
						<a class="dropdown-item pl-0" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">
							<i class="fa-fw fa fa-plus-circle"></i> Add New Biller
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
								<th class="font-weight-bold" scope="col">Image</th>
								<th class="font-weight-bold" scope="col">Name</th>
								<th class="font-weight-bold" scope="col">Email Address</th>
								<th class="font-weight-bold" scope="col">Phone</th>
								<th class="font-weight-bold" scope="col">City</th>
								<th class="font-weight-bold" scope="col">Actions</th>

							</tr>
						</thead>
						<tbody>
							<?php $counter=0;?>
							@foreach($billers as $biller)
							<?php $counter++; ?>
							<tr>
								<td>{{$counter}}</td>
								<td>
									@if(!empty($biller->logo))
									@else
									
									<img src="{{ asset('/')}}public/admin/defaultIcon/no_image.png" alt="No-image" class="img-rounded" style="width:35px;height:35px;">
									
									@endif
								</td>
								<td>{{$biller->name}}</td>
								<td>{{$biller->email}}</td>
								<td>{{$biller->phone}}</td>
								<td><p class="badge badge-success">{{$biller->city}}</p></td>
								<td style="width:120px;">
											
									<p class="btn btn-success p-1 px-2 mb-0 v-btn"  style="font-size: 13px;cursor:pointer;" title="User Details" data-pro_id="{{$biller->id}}"> <i class="fa-fw fa fa-eye"></i></p>
									<p class="btn btn-info p-1 mb-0 px-2 edit-btn" data-productid="{{$biller->id}}" style="font-size: 13px;cursor:pointer;" title="Edit User"> <i class="fa fa-edit" ></i></p>

									<div class="del-modal <?php echo 'modal'.$counter?>">
										<p><b>Record delete confirmation.</b></p>
										<p>Are you want to really delete ?</p>

										<button class="btn btn-info py-1 del-close" style="background-color: #808080a6;border-color: #808080a6;">Cancel</button>
										<form method="post"  action="#" style="float:right;">
											@csrf
											<input type="hidden" name="id" value="{{$biller->id}}">
											<button class="btn btn-danger py-1">Confirm</button>
										</form>
									</div>
									
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-3">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLabel">Add New Biller</h2>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			<div class="modal-body">

				<form method="post" action="{{route('admin.biller.billerSave')}}">
					@csrf
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Mobile *</label>
							<input type="text" class="form-control" name="phone" placeholder="Enter Biller Phone">
						</div>
						<div class="form-group col-md-6">
							<label>Name</label>
							<input type="text" class="form-control" name="name" placeholder="Enter Biller Name">
						</div>
						<div class="form-group col-md-6">
							<label>Email</label>
							<input type="email" class="form-control" name="email" placeholder="Enter Biller Email Address">
						</div>
						<div class="form-group col-md-6">
							<label>City</label>
							<input type="text" class="form-control" name="city" placeholder="Enter Biller City">
						</div>
						<div class="form-group col-md-6">
							<label>Postal Code</label>
							<input type="text" class="form-control" name="postal_code" placeholder="Enter Bille Postal Code">
						</div>
						<div class="form-group col-md-6">
							<label>Address</label>
							<input type="text" class="form-control" name="address" placeholder="Enter Biller Address">
						</div>
						<div class="form-group col-md-12">
							<label>Invoice Footer</label>
							<textarea name="invoice_footer" class="form-control"></textarea> 
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Add Biller">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>

@stop

