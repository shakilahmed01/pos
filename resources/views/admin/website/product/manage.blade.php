@extends('admin.layouts.adminmaster')
@section('adminTitle')
Product
@stop
@section('adminContent')
<style>
	input[type=text]:focus {
		border-color: inherit;
		-webkit-box-shadow: none;
		box-shadow: none;
		height:28px;
		font-size: inherit;
		border-color: rgba(229, 103, 23, 0.8);
		outline-color: gray;
		font-size: 15px;
		text-transform: none;

	}
	.table td{
		padding-bottom: 0px;
		vertical-align: middle;
	}

</style>
<div class="col-md-12 mt-5 pt-3 border-bottom">
	<div class="text-dark px-0" >
		<p class="mb-1"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> Dashboard / </a><a href="" class="active-slink">Website / </a> <a href="" class="active-slink">Product List</a> <span class="top-date">Total Products: </span></p>

	</div>
</div>
<div class="container-fluid p-3">
	<div class="box">
		<div class="box-header">
			<div class="box-icon-left border-right" style="height:100%">
				<p class="btn mt-0 task-icon"><i class="fa fa-barcode"></i></p>
			</div>
			<h2 class="blue task-label">All Products</h2>

			<div class="box-icon border-left" style="height:100%">
				<div class="dropdown mt-0">
					

					
					<p class="task-btn" title="Actions">
						<i class="fa fa-th-list"></i>
					</button>
					<div class="task-menu p-2">
						<a class="dropdown-item pl-0" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">
							<i class="fa-fw fa fa-plus-circle"></i> Add New Product
						</a>
                        
					</div>
					
				</div>
			</div>
		</div>
		<div class="box-content">
			<div class="row">
				<div class="col-lg-12">
					
					<div class="row">
						@if(Session::has('error-message'))
						<p class="alert alert-danger">{{Session::get('error-message')}}</p>
						@endif
						<div class="col-8">
							<p class="pt-2 mb-0">Showing </p>
						</div>
						<div class="col-4 mt-1">
							
						</div>
					</div>
					<table class="table table-bordered table-hover">
						<thead class="blue-table-head">
							<tr>
								<th class="font-weight-bold" scope="col">id</th>
								<th class="font-weight-bold" scope="col">Image</th>
								<th class="font-weight-bold" scope="col"> Category Name</th>
								<th class="font-weight-bold" scope="col">Name</th>
								<th class="font-weight-bold" scope="col">Brand</th>
								<th class="font-weight-bold" scope="col">Condition</th>
								<th class="font-weight-bold" scope="col">Status</th>
								<th class="font-weight-bold" scope="col">Actions</th>

							</tr>
						</thead>
						<tbody id="table-data">
							
                                @foreach($webpros as $key=>$web)
                                <tr>
                                	<td>{{ $key+1 }}</td>
                                	<td> <img src="{{asset('/')}}{{$web->image}}" width="70px" height="70px"></td>
                                	
<td>
	 @foreach($webcats as $key=>$web1)
	 @if($web1->id == $web->c_id)
	{{ $web1->cname }}
	@endif
	@endforeach
</td>
<td>{{ $web->name }}</td>
<td>{{ $web->brand }}</td>
<td>{{ $web->condition }}</td>
<td>
                  	@if($web->status == 1)
                  	<span class="badge badge-success">Active</span>
                  	
                  @else
                  <span class="badge badge-danger">Inactive</span>
                  @endif
              </td>
              <td></td>
                                </tr>
							@endforeach
						</tbody>
					</table>
					<br>
					
				</div>
			</div>
		</div>
	</div>

</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-3">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLabel">Add New Product</h2>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			<div class="modal-body">

<form action="{{ route('admin.webpro.store') }}" id="form_validation" method="POST" enctype="multipart/form-data">
					@csrf
				
					<div class="form-group">
						<label>Category Name *</label>
						<select class="custom-select" name="c_id">
							
						
							@foreach($webcats as $key=>$web1)
								<option value="{{ $web1->id }}">{{ $web1->cname }}</option>
					         @endforeach
						</select>
					</div>
					
					<div class="form-group">
						<label>Product name</label>
						<input type="text" name="name" class="form-control" >
					</div>

					<div class="form-group">
						<label>Product Brand</label>
						<input type="text" name="brand" class="form-control" >
					</div>

					<div class="form-group">
						<label>Product Condition</label>
						<input type="text" name="condition" class="form-control" >
					</div>

					<div class="form-group">
						<label>Product Price</label>
						<input type="number" name="price" class="form-control" >
					</div>

					<div class="form-group">
						<label>Product Description</label>
						<textarea class="form-control" name="description" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label>Product Image</label>
						<input type="file" name="image" class="form-control" >
					</div>
					<div class="form-group">
						<label>Product Image1</label>
						<input type="file" name="image1" class="form-control" >
					</div>
					<div class="form-group">
						<label>Product Image2</label>
						<input type="file" name="image2" class="form-control" >
					</div>
					
				</div>
				<div class="form-group">
						<label>Product Status</label>
						<select class="custom-select" name="status">
							
						
							<option value="1">Available</option>
								<option value="0">Not Availabale</option>
					
						</select>
					</div>
				<div class="modal-footer">

					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Add Product">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Modal -->
@stop