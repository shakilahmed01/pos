@extends('admin.modules.pos.layout.posMaster')
@section('adminTitle')
Sales Details
@stop
@section('posContent')
<div class="row mt-5">
  <div class="offset-4 col-4 mt-5 p-0">
    <a href="#" class="btn btn-success col-12 " style="color:white;font-size:20px;border-radius: 0px;" onclick="printContent('print')">PRINT</a>
    <a href="{{route('admin.posModule')}}"class="btn btn-info col-12 mt-1" style="color:white;font-size:20px;border-radius: 0px;">BACK TO POS</a>
    
    
  </div>
  <div class="offset-4 col-4 mt-0 p-4 mt-1" style="border:1px dotted gray" id="print">
        <style>
        .bill-p{
          margin-bottom: 0px;
          font-size:14px;
          font-weight: 500;
        }
        .company_name{
          margin-bottom: 0px;
          font-weight: 500;
          font-size:25px;
        }
      </style>
       <div style="text-align: center;">
         <h1 class="company_name">{{$system->siteName}}</h1>
         <p class="bill-p">{{$system->siteEmail}}</p>
         <p class="bill-p"><b>{{$system->sitePhone}}</b></p>
         
       </div>
       <div class="row p-0 m-0 mt-2 mb-2">
        <div class="col-6 pl-0">
          
        <p class="bill-p"><b>BILL TO</b></p>
         <p class="bill-p">{{$billInfo->name}}</p>
         <p class="bill-p">{{$billInfo->mobile}}</p>
        </div>
        <div class="col-6 pr-0" style="text-align: right;">
          <p class="bill-p">Invoice#{{$billInfo->code}}</p>
          <p class="bill-p">Date: {{$billInfo->sales_date}}</p>
        </div>
         
       </div>
       
       <div>
         <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item</th>
      <th scope="col">Qty</th>
      <th scope="col">Price</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
     <?php
        $counter=0;
        ?>
        @foreach($billProduct as $product)
        <?php
        $counter++;
       
        ?>
    <tr>
      <td>{{$counter}}</td>
      <td>{{$product->name}}</td>
      <td>{{$product->qty}}</td>
      <td>{{$product->unit_price}}</td>
      <td style="text-align: right;">{{number_format($product->subtotal,2)}}</td>
    </tr>
    @endforeach
    <tr>
      <td colspan="4">Total</td>
      <?php
      $total=($billInfo->grand_total+$billInfo->discount)-$billInfo->tax;
      ?>
      <td style="text-align: right;">{{number_format($total,2)}}</td>
    </tr>
    <tr>
      <td colspan="4">Tax</td>
      <td style="text-align: right;">{{number_format($billInfo->tax,2)}}</td>
    </tr>
    <tr>
      <td colspan="4">Discount</td>
      <td style="text-align: right;">{{number_format($billInfo->discount,2)}}</td>
    </tr>
    <tr>
      <td colspan="4">Grand Total</td>
      <td style="text-align: right;">{{number_format($billInfo->grand_total,2)}}</td>
    </tr>
     <tr>
      <td colspan="4">Paid</td>
      <td style="text-align: right;">{{number_format($billInfo->paid_amount,2)}}</td>
    </tr>
     <tr>
      <td colspan="4">Due</td>
      <td style="text-align: right;">{{number_format($billInfo->due,2)}}</td>
    </tr>
   
  </tbody>
</table>
<br>
       </div>

       <div>
         <p class="bill_p" style="font-size: 12px;">Thanks for shopping with us</p>
         <br>
       </div>
       <div style="text-align: center;">
         <p class="bill_p" style="font-size: 12px;font-weight: bold;">Pewered By www.codetreebd.com</p>
       </div>
     
  </div>
  <div class="offset-4 col-4 mt-0 mb-5 p-0">
    
    <a href="{{route('admin.pos.deleteSale',$billInfo->id)}}"class="btn btn-danger col-12 mt-1" style="color:white;font-size:20px;border-radius: 0px;">DELETE</a>
    
    
  </div>
  
</div>
@stop