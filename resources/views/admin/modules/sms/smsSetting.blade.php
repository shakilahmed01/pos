@extends('admin.layouts.adminmaster')
@section('adminTitle')
Sms setting- Admin Dashboard
@stop
@section('adminContent')
<style>
	label{
		font-weight: bold;
	}
</style>
<div class="col-md-12 mt-5 pt-3 border-bottom">
	<div class="text-dark px-0" >
		<p class="mb-1"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> Dashboard / </a><a href="#">SMS / </a><a class="active-slink">Sms Setting</a><span class="top-date">{{date('l, jS F Y')}}</span></p>

	</div>
</div>

<div class="container-fluid p-3">
	<div class="box">
		<div class="box-header">
			<div class="box-icon-left border-right" style="height:100%">
				
				

				<p class="btn mt-0 task-icon"><i class="fa fa-envelope"></i></p>
				
			</div>
			<h2 class="blue task-label">Sms Settig</h2>

			<div class="box-icon border-left" style="height:100%">
				<div class="dropdown mt-0">
					

					
					<p class="task-btn" title="Actions">
						<i class="fa fa-th-list"></i>
					</p>
					
				</div>
			</div>
		</div>
		<div class="box-content">
			<div class="row">
				<div class="col-lg-12">
					<p class="introtext">The username and password must be onnorokom sms service.</p>
				</div>
				
				
				<div class="col-sm-12 col-md-12 col-xs-12">
					<form method="post" action="{{route('admin.expense.expenseSave')}}" entype="multipart/form-data">
						@csrf
						<div class="form-row">
							<div class="offset-md-3 col-5 p-2 border">
							<div class="form-group col-md-12">
								<label>User Name</label>
								<input type="text" class="form-control"  placeholder="User Name" name="eDate">
							</div>
							<div class="form-group col-md-12">
								<label>Password</label>
								<input type="Text" class="form-control"  name="reference" placeholder="Password">
							</div>

						

							<div class="form-group">
								<button type="submit" class="btn btn-primary col-12">Update</button>
							</div>
						</div>
						</div>
					</form>

				</div>
				
				
			</div>
		</div>
	</div>

</div>

@stop

