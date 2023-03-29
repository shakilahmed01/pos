<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA_Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	 <link href="{{ asset('public/frontEnd/images/icon.png') }}" rel="shortcut icon"/>	<!--bootstrap-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}public/admin/asset/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}public/admin/asset/css/all.min.css">
	<!--dropdown plugin-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}public/admin/asset/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}public/admin/asset/css/bootnavbar.css">

	<!--fontawesome-->
	<link rel="stylesheet" href="{{asset('/')}}public/admin/asset/css/font-awesome.min.css">
	<!--Tostr-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}public/admin/asset/css/toastr.min.css">
	<!--customised css file-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}public/admin/asset/css/style.css">
	

	<!--Select 2-->
	<link href="{{asset('/')}}public/admin/asset/css/select2.min.css" rel="stylesheet" />
	<!--Morris chart-->
	<link href="{{asset('/')}}public/admin/asset/css/morris.css" rel="stylesheet" />

	<title>
		@yield('adminTitle')
	</title>
	<script src="{{asset('/')}}public/admin/asset/js/jquery-3.4.1.min.js"></script>
	<script>
		function printContent(el){
			var restorepage = document.body.innerHTML;
			var printcontent = document.getElementById(el).innerHTML;
			document.body.innerHTML = printcontent;
			window.print();
			document.body.innerHTML = restorepage;
		}
	</script>
	<style>
		.top-date{
			float: right;font-weight:400;color: #343a40;font-size:15px;margin-top:-3px;
		}
		.dropdown-menu > li a:hover, .dropdown-menu > li.show {
			background: #343a40!important;
			color: white;
		}
		.navbar-dark .navbar-nav .nav-link {
			color: #f8f9fa;
		}
		label{
			font-weight: bold;
		}
		.label-optional{
			font-size: 13px;
		}
		.task-menu{
			margin-top: 2px;
			position: absolute;
			background: white;
			z-index: 1;
			float: right;
			right: 0px;
			box-shadow: 0 0 1px 0px;
			display: none;

		}
		.task-btn{
			color:#428bca;
			cursor: pointer;
			margin-bottom: 0px;
			font-size: 20px;
			padding-top: 5px;
			padding-left: 7px;
			padding-right: 7px;
		}
		.task-btn:active{
			color:#428bca;
			border: 0px;
		}
		.task-icon{
			color:#428bca;
		}
		.task-label{
			color:#428bca;

		}
		.dropdown-item{
			font-size: 14px;
		}
		.action-btn{
			width: 90px;
			border-radius: 0px;
			height: 30px;
			font-size: 15px;
			padding-top: 4px;
			text-align: center;
			background: #428bca;
			color: white;
			cursor: pointer;
		}
		.action-menu{
			margin-right:60px;margin-top:5px;
		}
		::-webkit-scrollbar{
			display: none;
		}
		.del-modal{
			position: absolute;background-color:white;box-shadow: 0 0 6px 1px grey;z-index: 1;right:67px;margin-top:-110px;display: none;padding: 20px;border-radius: 5px;
		}
		.del-modal::after{
			content: ' ';
			width: 0px;
			height: 0px;
			border-top: 10px solid transparent;
			border-left: 10px solid white;
			border-bottom:10px solid transparent;
			border-right:10px solid transparent;
			position: absolute;
			top: 60%;
			left: 100%;
			margin-left:0px;
		}
		input[type=button]:focus {
			border-color: inherit;
			-webkit-box-shadow: none;
			box-shadow: none;

			font-size: inherit;

			outline-color: gray;
			font-size: 20px;
			text-transform: none;
		}
		.cal_btn{
			border:0px;
			width:100%;
			font-size: 20px;
			height: 100%;
			padding:10px 15px;
		}
		#result{
			font-size: 20px;
			border-radius: 0px;
			padding:10px 15px;
		}
		.equal{
			background-color: #228b22f0;
			color:white;
		}
		.clear{
			background-color: #ff0000d1;
			padding:7px 15px;
			color:white;
		}
		.number{
			background-color: antiquewhite;
		}
		.operator{
			background-color: gold;
		}
		.warning-btn{

			font-size: 8px;
			position: absolute;
			padding:1px 2px;
			top: 0px;
			background: red;
			font-weight: bold;
			right: 0px;

		}
	</style>
	<script> 
		function dis(val) 
		{ 
			document.getElementById("result").value+=val 
		}  
		function solve() 
		{ 
			let x = document.getElementById("result").value 
			let y = eval(x) 
			document.getElementById("result").value = y 
		}  
		function clr() 
		{ 
			document.getElementById("result").value = "" 
		} 
	</script>
	<script src="https://cdn.tiny.cloud/1/4940y22u3y043sj4aiplbmjzfpazhng9fe0oti0w58ck33vg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea'});</script>
</head>
<body>
	<?php
	use App\Http\Controllers\admin\StockController;
	$lowStock=StockController::numberOfLowStockProduct();
	?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="navbar" style="padding:1px;background-color: #7e8082!important;">
		<a class="navbar-brand" style="padding:0px;" href="{{route('admin.dashboard')}}"> <img src="{{ asset('public/frontEnd/images/logo.png') }}" class="img-fluid" style="" alt="skilldigger"></a>
		<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarcoll">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarcoll" style="padding-top:10px;">
			<ul class="navbar-nav mr-auto">

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
						Website Admin
					</a>
					<ul class="dropdown-menu p-0" id="dropdown-background">
						<li>
							<a class="dropdown-item" href="{{route('admin.webcat')}}">Category Detail</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.webpro')}}">Product Detail</a>
						</li>
						
				
					</ul>			     
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
						Products
					</a>
					<ul class="dropdown-menu p-0" id="dropdown-background">
						<li>
							<a class="dropdown-item" href="{{route('admin.productList')}}">List Products</a>
						</li>
						
						<li>
							<a class="dropdown-item" href="{{route('admin.productAdd')}}">Add Product</a>
						</li>
						
						
						<li>
							<a class="dropdown-item" href="{{route('admin.printBarcode')}}">Print Barcode</a>
						</li>
						<!--<li>-->
						<!--	<a class="dropdown-item" href="{{route('admin.quantityAdjustment')}}">Quantity Adjustment</a>-->
						<!--</li>-->

					</ul>			     
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
						Sales
					</a>
					<ul class="dropdown-menu p-0" id="dropdown-background">
						<li>
							<a class="dropdown-item" href="{{route('admin.salesList')}}">List Sales</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.posModule')}}">POS Sale</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.salesAdd')}}">Add Sale</a>
						</li>
					</ul>			     
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
						Purchase
					</a>
					<ul class="dropdown-menu p-0" id="dropdown-background">
						<li>
							<a class="dropdown-item" href="{{route('admin.purchaseAdd')}}">Add Purchase</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.purchaseList')}}">List Purchase</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.expenseList')}}">List Expenses</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.expenseAdd')}}">Add Expenses</a>
						</li>
					</ul>			     
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
						People
					</a>
					<ul class="dropdown-menu p-0" id="dropdown-background">
						
						
						<li>
							<a class="dropdown-item" href="{{route('admin.customerList')}}">Customers</a>
						</li>
						
						<li>
							<a class="dropdown-item" href="{{route('admin.supplierList')}}">Suppliers</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.userList')}}">Users</a>
						</li>
						
						<li>
							<a class="dropdown-item" href="{{route('admin.people.listBiller')}}">Billers</a>
						</li>
						
					</ul>			     
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
						Setting
					</a>
					<ul class="dropdown-menu p-0" id="dropdown-background">
						<li>
							<a class="dropdown-item" href="{{route('admin.system.setting')}}">System Setting</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.store')}}">Store</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.customerGroup')}}">Customer Group</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.category')}}">Category</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.subcategory')}}">Subcategory</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.brands')}}">Brands</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.units')}}">Units</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.expensecategory')}}">Expenses Category</a>
						</li>

					</ul>			     
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
						Reports
					</a>
					<ul class="dropdown-menu p-0" id="dropdown-background">
						<li>
							<a href="{{route('admin.report.dailySalesReport')}}"class="dropdown-item">Sales Report</a>
						</li>
						<li>
							<a href="{{route('admin.report.dailyPurchaseReport')}}" class="dropdown-item" href="">Purchase Report</a>
						</li>
						
						<li>
							<a href="{{route('admin.report.paymentReport')}}" class="dropdown-item" href="">Payments Report</a>
						</li>
						
						<li>
							<a href="{{route('admin.report.customerReport')}}" class="dropdown-item" href="">Customer Report</a>
						</li>
					</ul>			     
				</li>
				<!--<li class="nav-item dropdown p-1 ml-5" style="background:#78cd51 !important">-->
				<!--	<a class="nav-link" href="{{route('admin.posModule')}}"><i class="fa fa-th-large"></i>-->
				<!--		POS-->
				<!--	</a>-->
				<!--</li>-->
				<li class="nav-item dropdown p-1 ml-2" style="background:#ffc107 !important">
					<a class="nav-link" href="{{route('admin.stock.lowStockProduct')}}" title="{{$lowStock}} products are in low stock"><i class="fa fa-exclamation-triangle"  style="font-size: 12px"></i><span class="warning-btn">{{$lowStock}}</span>
						
					</a>
				</li>
				<li class="nav-item dropdown p-1 ml-2" style="background:gray !important" title="Calculator" data-toggle="modal" data-target=".calculator_modal">
					<a class="nav-link" href="#" ><i class="fa fa-calculator"></i>

					</a>
				</li>


			</ul>
		</div>
	</nav>
	<!--user-profile--rightpart-->
	<div class="user-profile-part">
		<span class="navbar-text">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown">
					<a class="nav-link" href="#" data-toggle="dropdown" id="user-profile">
						@if(!empty(Auth::user()->image))
						<img src="{{asset(Auth::user()->image)}}">
						@else
						<img src="{{asset('/')}}public/admin/defaultIcon/user.png">
						@endif
					</a>
					<ul class="dropdown-menu p-0" id="user-profile-dropdown">
						<li>
							<a class="dropdown-item" href="#"><i class="fa fa-user"></i> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{route('admin.profile')}}"><i class="fa fa-cog"></i> Setting</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{ route('admin.logout') }}"
							><i class="fa fa-sign-out"></i> 
							Logout
						</a>
					</li>
				</ul>			     
			</li>
		</ul> 
	</span>
</div>
<!--Calculator modal-->
<div class="modal fade calculator_modal" tabindex="-1" role="dialog" aria-labelledby="calculator_modal" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content p-3">
			<div class="modal-header">
				<h2 class="modal-title" >Calculator</h2>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			<div class="modal-body">
				<style>
					#calculator_table>td{
						border:0px;
					}
				</style>
				<div style="text-align: center;">
					<table class="table"> 
						<tr> 
							<td colspan="3" ><input class="form-control"type="text" id="result"/ style="text-align:right;" readonly=""></td> 
							<td><input type="button" value="Clear" onclick="clr()"/ class="cal_btn clear"> </td> 
						</tr> 
						<tr> 
							<td><input type="button" value="1" onclick="dis('1')"/ class="cal_btn number"> </td> 
							<td>
								<input type="button" value="2" onclick="dis('2')"/ class="cal_btn number"> 

							</td> 
							<td><input type="button" value="3" onclick="dis('3')"/ class="cal_btn number"> </td> 
							<td><input type="button" value="/" onclick="dis('/')"/ class="cal_btn operator"> </td> 
						</tr> 
						<tr> 
							<td><input type="button" value="4" onclick="dis('4')"/ class="cal_btn number"> </td> 
							<td><input type="button" value="5" onclick="dis('5')"/ class="cal_btn number"> </td> 
							<td><input type="button" value="6" onclick="dis('6')"/ class="cal_btn number"> </td> 
							<td><input type="button" value="-" onclick="dis('-')"/ class="cal_btn operator"> </td> 
						</tr> 
						<tr> 
							<td><input type="button" value="7" onclick="dis('7')"/ class="cal_btn number"> </td> 
							<td><input type="button" value="8" onclick="dis('8')"/ class="cal_btn number"> </td> 
							<td><input type="button" value="9" onclick="dis('9')"/ class="cal_btn number"> </td> 
							<td><input type="button" value="+" onclick="dis('+')"/ class="cal_btn operator"> </td> 
						</tr> 
						<tr> 
							<td><input type="button" value="." onclick="dis('.')"/ class="cal_btn number"> </td> 
							<td><input type="button" value="0" onclick="dis('0')"/ class="cal_btn number"> </td> 
							<td><input type="button" value="=" onclick="solve()"/ class="cal_btn equal"> </td> 
							<td><input type="button" value="*" onclick="dis('*')"/ class="cal_btn operator"> </td> 
						</tr> 
					</table> 
				</div>
			</div>

		</div>
	</div>
</div>
<!--table section-->
@yield('adminContent')

<!--js file-->

<script src="{{asset('/')}}public/admin/asset/js/popper.min.js"></script>
<script src="{{asset('/')}}public/admin/asset/js/bootstrap.min.js"></script>
<!--dropdown plugin file-->
<script src="{{asset('/')}}public/admin/asset/js/bootnavbar.js"></script>
<script src="{{asset('/')}}public/admin/asset/js/all.min.js"></script>
<script src="{{asset('/')}}public/admin/asset/js/main.js"></script>
<!--select 2-->
<script src="{{asset('/')}}public/admin/asset/js/select2.min.js"></script>

<script>
	$(document).ready(function(){
		$(".task-btn").click(function(){
			$(".task-menu").slideToggle({ direction: "left" }); 
		});
	});
</script>
<script src="{{asset('/')}}public/admin/asset/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
	@if(count($errors) > 0)
	@foreach($errors->all() as $error)
	toastr.error("{{ $error }}");
	@endforeach
	@endif
</script>
<script>
	// document.addEventListener("contextmenu",function(hide){
 // hide.preventDefault();
	// });
</script>

</body>
</html>