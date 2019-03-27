
<!doctype html>
<html>
<title> Receipt </title>
<head>
    <meta charset="utf-8">
    <style>
        .top_rw{ background-color:#FF7F50; }
        .td_w{ }

        button{ padding:5px 10px; font-size:14px;}
        .invoice-box {
            max-width: 890px;
            margin: auto;
            padding:10px;
            border: 1px solid #FF7F50;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 14px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-bottom: solid 1px #ccc;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align:middle;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #FF7F50;
            border-bottom: 1px solid #FF7F50;
            font-weight: bold;
            font-size:12px;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
        .owner-photo {
            height: 150px;
            padding-left: 1px;
            padding-right: 1px;
            border: 1px solid #ccc;
            background: #eee;
            width: 150px;
        }

    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top_rw">
            <td colspan="2">
                <h2 align="center" style="color: #ffffff">ENSHIKA GHANA LTD</h2>
                <span><h2 style="margin-bottom: 0px;">Taxi Charges Receipt</h2></span>
                <span style="">  Date: March 08, 2019 </span>
            </td>

        </tr>
    </table>
    <tr class="top">
        <td colspan="3">
            <table>

            </table>
        </td>
    </tr>

    <tr class="information">
        <td colspan="3">
            <table>
                <tr>
                    <td colspan="2">
                        <b> From: Enshika Ghana Ltd</b> <br>
                        No. 5 Abotsi Street <br>
                        East Legon <br>
                        Accra <br>
                        Tel: (+233) 55 1132983 <br><br>
                    </td>

                    <td> <b> To: {{$owner->first_name." ".$owner->last_name}} </b><br>
                        Email: {{$owner->email}}<br>
                        Address: {{$owner->address}}<br>
                        Tel: (+233)  {{$owner->telephone}}<br><br>

                    </td>
                    {{--<td> <b>Bank Name: {{$owner->bank}} </b><br>--}}
                    {{--Account Name: {{$owner->first_name." ".$owner->last_name}}<br>--}}
                    {{--Account No.: {{$owner->account_number}}<br>--}}
                    {{--Branch: {{$owner->branch}}<br><br>--}}


                    {{--</td>--}}
                </tr>
            </table>
        </td>
    </tr>


    <td colspan="">
        <table cellspacing="0px" cellpadding="2px">
            <tr class="heading">
                <td style="width:25%;">
                    {{--ITEM--}} LOCATION
                </td>
                <td style="width:15%; text-align:right;">
                    {{--EXPENSES (GHC)--}}
                </td>
                <td style="width:15%; text-align:right;">
                    TOTAL AMOUNT (GHC)
                </td>
            </tr>
            <tr class="item">
                <td style="width:25%;">
                    ACCRA - KUMASI AND KUMASI - ACCRA
                </td>

                <td style="width:15%; text-align:right;">

                </td>

                <td style="width:10%; text-align:right;">
                    <b>{{$payment[0]->amount}}</b>
                </td>

            </tr>
            </td>
        </table>
        <tr>
            <td colspan="3">
                <table cellspacing="0px" cellpadding="2px">
                    <tr>
                        <td width="50%">
                            <b> THANK YOU </b> <br>
                            Team Enshika
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
</div>
</body>
</html>
