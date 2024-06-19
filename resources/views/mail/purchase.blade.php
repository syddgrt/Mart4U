<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }

        /*Invoice*/
        .invoice .top-left {
            font-size: 65px;
            color: #3ba0ff;
        }

        .invoice .top-right {
            text-align: right;
            padding-right: 20px;
        }

        .invoice .table-row {
            margin-left: -15px;
            margin-right: -15px;
            margin-top: 25px;
        }

        .invoice .payment-info {
            font-weight: 500;
        }

        .invoice .table-row .table>thead {
            border-top: 1px solid #ddd;
        }

        .invoice .table-row .table>thead>tr>th {
            border-bottom: none;
        }

        .invoice .table>tbody>tr>td {
            padding: 8px 20px;
        }

        .invoice .invoice-total {
            margin-right: -10px;
            font-size: 16px;
        }

        .invoice .last-row {
            border-bottom: 1px solid #ddd;
        }

        .invoice-ribbon {
            width: 85px;
            height: 88px;
            overflow: hidden;
            position: absolute;
            top: -1px;
            right: 14px;
        }

        .ribbon-inner {
            text-align: center;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            position: relative;
            padding: 7px 0;
            left: -5px;
            top: 11px;
            width: 120px;
            background-color: #66c591;
            font-size: 15px;
            color: #fff;
        }

        .ribbon-inner:before,
        .ribbon-inner:after {
            content: "";
            position: absolute;
        }

        .ribbon-inner:before {
            left: 0;
        }

        .ribbon-inner:after {
            right: 0;
        }

        @media(max-width:575px) {

            .invoice .top-left,
            .invoice .top-right,
            .invoice .payment-details {
                text-align: center;
            }

            .invoice .from,
            .invoice .to,
            .invoice .payment-details {
                float: none;
                width: 100%;
                text-align: center;
                margin-bottom: 25px;
            }

            .invoice p.lead,
            .invoice .from p.lead,
            .invoice .to p.lead,
            .invoice .payment-details p.lead {
                font-size: 22px;
            }

            .invoice .btn {
                margin-top: 10px;
            }
        }

        @media print {
            .invoice {
                width: 900px;
                height: 800px;
            }
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

    <div class="container bootstrap snippets bootdeys">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default invoice" id="invoice">
                    <div class="panel-body">
                        <div class="invoice-ribbon">
                            <div class="ribbon-inner">PAID</div>
                        </div>
                        <div class="row">

                            <div class="col-sm-6 top-left">
                                <i class="fa fa-rocket"></i>
                                <h1>{{ strtoupper(env('APP_NAME')) }}</h1>
                            </div>

                            <div class="col-sm-6 top-right pt-5">
                                <h3 class="">INVOICE-{{ $buyer['payment_id'] }}</h3>
                                <span class="">{{ $buyer['date'] }}</span>
                            </div>

                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-xs-4 col-lg-4 from">
                                <p class="lead marginbottom payment-info">From : {{ env('COMPANY_NAME') }}</p>
                                <p>{{ env('COMPANY_ADDRESS1') }}</p>
                                <p>{{ env('COMPANY_ADDRESS2') }}</p>
                                <p>{{ env('COMPANY_ZIP') }}, {{ env('COMPANY_COUNTRY') }}</p>
                                <p>Phone: {{ env('COMPANY_PHONE') }}</p>
                                <p>Email: {{ env('MAIL_FROM_ADDRESS') }}</p>
                            </div>

                            <div class="col-xs-4 col-lg-4 to">
                                <p class="lead marginbottom payment-info">To : {{ $buyer['name'] }}</p>
                                <p>{{ $buyer['address1'] }}</p>
                                <p>{{ $buyer['address2'] }}</p>
                                <p>{{ $buyer['zip'] }}, Malaysia</p>
                                <p>Phone: {{ $buyer['phone'] }}</p>
                                <p>Email: {{ $buyer['email'] }}</p>

                            </div>

                            <div class="col-xs-4 col-lg-4 text-end payment-details">
                                <p class="lead marginbottom payment-info">Payment details</p>
                                <p>Date: {{ $buyer['date'] }}</p>
                                <p>Payment Method: {{ $buyer['payment_method'] }}</p>
                                <!-- <p>Total Amount: $1019</p>
                                <p>Account Name: Flatter</p> -->
                            </div>

                        </div>

                        <div class="row table-row">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:5%">#</th>
                                        <th style="width:50%">Item</th>
                                        <th class="text-end" style="width:15%">Quantity</th>
                                        <th class="text-end" style="width:15%">Unit Price</th>
                                        <th class="text-end" style="width:15%">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $number_of_item = 0 ?>
                                    <?php $total_price_all_items = 0 ?>
                                    @foreach($items as $item)
                                    <?php $number_of_item++; ?>
                                    <?php $total_price_all_items += $item['total_price']; ?>

                                    <tr>
                                        <td class="text-center"><?= $number_of_item ?></td>
                                        <td>{{ $item['name'] }}</td>
                                        <td class="text-end">{{ $item['quantity'] }}</td>
                                        <td class="text-end">RM{{ $item['price'] }}</td>
                                        <td class="text-end">RM{{ $item['total_price'] }}</td>
                                    </tr>

                                    @endforeach
                                    
                                </tbody>
                            </table>

                        </div>

                        <div class="row">
                            <div class="col-xs-6 col  align-self-start">
                                <p class="lead marginbottom payment-info">THANK YOU!</p>

                                <!-- <button class="btn btn-success" id="invoice-print"><i class="fa fa-print"></i> Print Invoice</button>
                                <button class="btn btn-danger"><i class="fa fa-envelope-o"></i> Mail Invoice</button> -->
                            </div>
                            <div class="col-xs-6 col align-self-end text-end pull-right invoice-total">
                                <!-- <p>Subtotal : $1019</p>
                                <p>Discount (10%) : $101 </p>
                                <p>VAT (8%) : $73 </p> -->
                                <p>Total : RM{{ $total_price_all_items }} </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>