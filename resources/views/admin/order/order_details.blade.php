@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" id="printable">
              <?php
                  // if (isset($_GET['msg'])) {
                  //   showMessage($_GET['msg']);
                  // }
              ?>
                <div class="x_title" style="border-bottom: white;">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        {{--///////////////////// Company Address ///////////////////////--}}
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            {{-- <img src="uploads/logo.png" height="150" style="height: 38px;margin-bottom: 18px; margin-right: -9px;"> --}}
                            <b style="font-size: 35px;color: #0194ea;">Sal</b>
                            <b style="font-size: 35px;color: #262161;">oon</b>
                            <table>
                                <tr>
                                <th>Address : </th>
                                    <td>{{$invoice_setting->address}}</td>
                                </tr>

                                <tr>
                                <th>Phone : </th>
                                    <td>{{$invoice_setting->phone}}</td>
                                </tr>
                                @if (!empty($invoice_setting->gst))
                                    <tr>
                                        <th>GST No : </th>
                                        <td>{{$invoice_setting->gst}}</td>
                                    </tr>
                                @endif
                                <tr>
                                <th>Email Id : </th>
                                    <td>{{$invoice_setting->email}}</td>
                                </tr>
                            </table>
                        </div>

                        {{--///////////////// Invoice Details ////////////////////--}}
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <span style="font-size: 38px;color: black;font-weight: bold;">INVOICE</span>
                            <table>
                                <tr>
                                    <th>Invoice No : </th>
                                    <td>{{$order->id}}</td>
                                </tr>

                                <tr>
                                    <th>Invoice Date : </th>
                                    <td>{{$order->created_at}}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Amount : </th>
                                    <td> Rs.{{ number_format($order->amount,2,".",'') }}</td>
                                </tr>
                                <tr>
                                    <th>Paid Amount : </th>
                                    <td> Rs.{{ number_format($order->advance_amount,2,".",'') }}</td>
                                </tr>
                                <tr>
                                    <th>Payable Amount : </th>
                                    <td> Rs.{{ number_format(($order->amount-$order->advance_amount),2,".",'') }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Status : </th>
                                    <td>
                                        @if ($order->payment_type == '1')
                                            Failed
                                        @else
                                            Paid
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{--//////////////////// Shipping Details And Billing Details ///////////////////--}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top: 16px;">
                            <table class="table">
                            <thead>
                                <tr style="background-color: #0089ff;color:white ">
                                <th style="min-width: 125px;">Billing Info</th>
                                <th>Customer Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <th>Name :</th>
                                            <td>{{$order->customer->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email :</th>
                                            <td>{{$order->customer->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile :</th>
                                            <td>{{$order->customer->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <th>State :</th>
                                            <td>{{$order->customer->state}}</td>
                                        </tr>
                                        <tr>
                                            <th>City :</th>
                                            <td>{{$order->customer->city}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address :</th>
                                            <td>{{$order->customer->address}}</td>
                                        </tr>
                                    </table>
                                </td>

                                <td>

                                    <table>
                                        <tr>
                                            <th>Name :</th>
                                            <td>{{$order->address->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email :</th>
                                            <td>{{$order->address->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile :</th>
                                            <td>{{$order->address->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <th>State :</th>
                                            <td>{{$order->address->state}}</td>
                                        </tr>
                                        <tr>
                                            <th>City :</th>
                                            <td>{{$order->address->city}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address :</th>
                                            <td>{{$order->address->address}}</td>
                                        </tr>
                                    </table>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                {{-- ////////////////// Order Details /////////////////////////////--}}
                <div class="x_content table-responsive">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top: 16px;">
                        <table class="table">
                            <thead>
                                <tr style="background-color: #0089ff;color:white ">
                                <th style="min-width: 125px;">Name</th>
                                <th>Service For</th>
                                <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($orderDetails) && !empty($orderDetails) && (count($orderDetails)> 0))
                                    @foreach ($orderDetails as $item)
                                        <tr>
                                            <td>{{isset($item->job->jobCategory->name) ? $item->job->jobCategory->name : ''}}</td>
                                            <td>
                                                @if ($item->service_for == '1')
                                                    Men
                                                @elseif ($item->service_for == '2')
                                                    Women
                                                @elseif ($item->service_for == '3')
                                                    Kids
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->amount,2,".",'') }}</td>
                                        </tr>
                                    @endforeach
                                @endif

                                <tr>
                                    <td colspan='2' align='right'>Sub Total : </td>
                                    <td>{{ number_format($order->amount,2,".",'') }}</td>
                                </tr>
                                @if ($order->discount > 0)
                                    <tr>
                                        <td colspan='2' align='right'>Advance Paid : (-) </td>
                                        <td>{{ number_format($order->advance_amount,2,".",'') }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan='2' align='right' >Net Payable Amount : </td>
                                    <td>{{ number_format(($order->amount-$order->advance_amount),2,".",'') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="col-md-5 col-xs-5 col-sm-5">
                        <table class="table">
                            <thead>
                            <tr style="background-color: #0089ff;color:white ">
                                <td>Notes</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> * {{$invoice_setting->note1}}</td>
                            </tr>
                            <tr>
                                <td> * {{$invoice_setting->note2}}</td>
                            </tr>
                            <tr>
                                <td> * {{$invoice_setting->note3}} </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-7 col-xs-7 col-sm-7">
                        <table class="table">
                            <thead>
                            <tr>
                                <td style=" text-align: center;">
                                <b style="color: #00adff;font-size: 25px;">Thanks</b><br>
                                <b>for shopping with us</b>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> <img src="{{asset('images/'.$invoice_setting->image.'')}}" style="height: 169px;width: 543px;"></td>
                            </tr>

                            </tbody>
                        </table>
                        </div>

                        <div class="col-md-12 col-xs-12 col-sm-12">
                        <button class="btn btn-info" id="print-btn" onclick="printDiv()">Print</button>
                            <a class="btn btn-danger" onclick="window.close()" id="backprint">Close</a>
                        </div>
                    </div>
                    <div id="thanks_msg"></div>
            </div>
          </div>
        </div>
      </div>
</div>


 @endsection

@section('script')

<script type="text/javascript">
    function printDiv() {
       var printContents = document.getElementById("printable").innerHTML;
       var originalContents = document.body.innerHTML;

       document.body.innerHTML = printContents;
       // document.getElementById("thanks_msg").innerHTML = "Thanks For Shopping With Us";

       //document.getElementById("backprint").hide();
       element = document.getElementById('backprint');
       element.style.display = "none";

        element = document.getElementById('print-btn');
       element.style.display = "none";

       window.print();

       element.style.display = "";
       document.getElementById("thanks_msg").innerHTML ="";
       document.body.innerHTML = originalContents;
    }
  </script>

 @endsection
