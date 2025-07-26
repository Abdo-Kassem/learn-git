<?php $lang = app()->getLocale(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>

    <link rel="stylesheet" href="{{ asset('Dashboard') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/FixedHeader-3.1.4/css/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/FixedHeader-3.1.4/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/Responsive-2.2.2/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/Responsive-2.2.2/css/responsive.bootstrap.min.css">  
    <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/Buttons-1.5.4/css/buttons.bootstrap.min.css">  

    @if ($lang == 'ar')
    <style>
        .container {
            direction: rtl;
        }
    </style>
    @endif

    <style>
        @media only screen and (min-width:900px) {
            .invoic {
                width: 60% !important;
                margin: auto;
            }
        }

        @media only screen and (min-width:600px) {
            .invoic {
                width: 80% !important;
                margin: auto;
            }
        }

        .box-body {
            display: flex;
            justify-content: center;
        }

        .invoic {
            padding: 20px 10px;
        }

        .invoic .header {
            display: flex;
            flex-direction: row-reverse;
            border-bottom: 2px solid yellowgreen;
            padding-bottom: 20px;
            margin-bottom: 40px;
        }

        .invoic .header .image {
            width: 80px;
        }

        .invoic .header .image img {
            width: 100%;
            object-fit: contain;
        }

        .invoic .header .header-left-side {
            flex: 1;
        }

        .invoic .header .invoice-number {
            margin-bottom: 5px;
        }

        .invoic .header .invoice-number, .invoic .header .method-type {
            display: flex;
            flex-direction: column;
        }

        .invoic .header .invoice-number span:first-child, .invoic .header .method-type span:first-child {
            font-size: 18px;
            color: #444;
            padding-bottom: 2px;
        }

        .invoic .header .invoice-number span:nth-child(2), .invoic .header .method-type span:nth-child(2) {
            font-weight: bold;
            font-size: 16px;
        }

        .sale-return {
            margin-top: 30px;
        }

        .sale-return h4 {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }

        .sale-return p {
            color: #555;
            font-size: 15px;
        }

        table th, table td {
            text-align: center !important;
        }

        .contact {
            display: flex;
            font-size: 17px;
            color: yellowgreen;
        }

        .contact div:nth-child(2) {
            margin: 0 20px;
        }

        .contact a {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoic col-md-8">
            <div class="header">
                <div class="image">
                    <img src="{{ asset($setting->logo) }}">
                </div>
                <div class="header-left-side">
                    <div class="invoice-number">
                        <span>{{ trans('backend.invoice_number') }}</span>
                        <span>{{ $invoice->invoice_number }}</span>
                    </div>
                    <div class="method-type">
                        <span>{{ trans('backend.payment_method') }}</span>
                        <span>{{ $invoice->payment_method == App\Models\Invoice::VISA ? trans('backend.visa') : trans('backend.cash') }}</span>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.name') }}</b></th>
                            <th><b>{{ trans('backend.price') }}</b></th>
                            <th><b>{{ trans('backend.quantity') }}</b></th>
                            <th><b>{{ trans('backend.total_price') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $invoice->order->products as $index => $product )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $lang == 'ar' ? $product->name_ar : $product->name_en }}</td>
                                <td>{{ $product->price }} {{ $invoice->currency }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $product->pivot->quantity * $product->price }} {{ $invoice->currency }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color: whitesmoke;">
                            <th colspan="2"><b>{{ trans('backend.price') }}</b></th>
                            <td colspan="1">{{ $invoice->order->amount }} {{ $invoice->currency }}</td>
                            <th colspan="1"><b>{{ trans('backend.total_price') }}</b></th>
                            <td colspan="1">{{ $invoice->order->total_amount }} {{ $invoice->currency }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="sale-return">
                <h4>{{ trans('backend.sale_and_return') }}</h4>
                <p>{{ $lang == 'ar' ? $saleAndReturn->description_ar : $saleAndReturn->description_en }}</p>
            </div>

            <div class="sale-return">
                <h4>{{ trans('backend.using_conditions') }}</h4>
                <p>{{ $lang == 'ar' ? $usingConditions->description_ar : $usingConditions->description_en }}</p>
            </div>

            <div class="sale-return">
                <h4 style="margin-bottom:5px">{{ trans('backend.contact_us') }}</h4>
                <div class="contact">
                    <div>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                    </div>
                    <div>
                        <i class="fa fa-phone-square" aria-hidden="true"></i>
                        <a href="tel: {{ $setting->phone }}">{{ $setting->phone }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (app()->getLocale() == 'en')
        <script src="{{ asset('js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
    @else
        <script src="{{ asset('js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/validation/messages_ar.js') }}"></script>
    @endif

    <script>
        $(document).ready(function(){
            var table = $('#yajra-datatable').DataTable();
        });
    </script>

</body>
</html>