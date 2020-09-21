
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order {{ $order->status }}</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style type="text/css">
      body{
      text-align: center;
      margin: 0 auto;
      width: 650px;
      font-family: work-Sans, sans-serif;
      background-color: #f6f7fb;
      display: block;
      }
      ul{
      margin:0;
      padding: 0;
      }
      li{
      display: inline-block;
      text-decoration: unset;
      }
      a{
      text-decoration: none;
      }
      p{
      margin: 15px 0;
      }
      h5{
      color:#444;
      text-align:left;
      font-weight:400;
      }
      .text-center{
      text-align: center
      }
      .main-bg-light{
      background-color: #fafafa;
      box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353); 
      }
      .title{
      color: #444444;
      font-size: 22px;
      font-weight: bold;
      margin-top: 10px;
      margin-bottom: 10px;
      padding-bottom: 0;
      text-transform: uppercase;
      display: inline-block;
      line-height: 1;
      }
      table{
      margin-top:30px
      }
      table.top-0{
      margin-top:0;
      }
      table.order-detail {
      border: 1px solid #ddd;
      border-collapse: collapse;
      }
      table.order-detail tr:nth-child(even) {
      border-top:1px solid #ddd;
      border-bottom:1px solid #ddd;
      }
      table.order-detail tr:nth-child(odd) {
      border-bottom:1px solid #ddd;
      }
      .pad-left-right-space{
      border: unset !important;
      }
      .pad-left-right-space td{
      padding: 5px 15px;
      }
      .pad-left-right-space td p{
      margin: 0;
      }
      .pad-left-right-space td b{
      font-size:15px;
      font-family: 'Roboto', sans-serif;
      }
      .order-detail th{
      font-size:16px;
      padding:15px;
      text-align:center;
      background: #fafafa;
      }
      .footer-social-icon tr td img{
      margin-left:5px;
      margin-right:5px;
      }
    </style>
  </head>
  <body style="margin: 20px auto;">
    @php $data = $order->data @endphp
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="padding: 0 30px;background-color: #fff; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%;">
      <tbody>
        <tr>
          <td>
            <table align="left" border="0" cellpadding="0" cellspacing="0" style="text-align: left;" width="100%">
              <tbody>
                <tr>
                  <td style="text-align: center;"><img src="http://laravel.pixelstrap.com/cuba/assets/images/email-template/delivery-2.png" alt="" style=";margin-bottom: 30px;"></td>
                </tr>
                <tr>
                  <td>
                    <p style="font-size: 14px;"><b>Hi, {{ $order['name'] }},</b></p>
                    <p style="font-size: 14px;">Order ID : <strong>{{ $order['id'] }}</strong>,</p>
                    <p style="font-size: 14px;">Order Status: <strong>{{ $order->status }}</strong>,</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="left" style="width: 100%;margin-top: 10px;    margin-bottom: 10px;">
              <tbody>
                <tr>
                  <td style="background-color: #fafafa;border: 1px solid #ddd;padding: 15px;letter-spacing: 0.3px;width: 50%;">
                    <h5 style="font-size: 16px; font-weight: 600;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">Your Shipping Address</h5>
                    <p style="text-align: left;font-weight: normal; font-size: 14px; color: #000000;line-height: 21px;    margin-top: 0;">{{ $order['address'] }}</p>
                  </td>
                  <td><img src="http://laravel.pixelstrap.com/cuba/assets/images/email-template/space.jpg" alt=" " height="25" width="30"></td>
                  <td style="background-color: #fafafa;border: 1px solid #ddd;padding: 15px;letter-spacing: 0.3px;width: 50%;">
                    <h5 style="font-size: 16px;font-weight: 600;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">Your Contacts:</h5>
                    <p style="text-align: left;font-weight: normal; font-size: 14px; color: #000000;line-height: 21px;    margin-top: 0;">{{ $order['phone'] }}<br />{{ $order['email'] }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <div style="text-align: left;">
              <strong>Note:</strong><br>{{ $order->note ?? 'N/A' }}
            </div>
            <table class="order-detail" border="0" cellpadding="0" cellspacing="0" align="left" style="width: 100%; margin-bottom: 25px;">
              <tbody>
                <tr align="left">
                  <th>PRODUCT</th>
                  <th style="padding-left: 15px;">DESCRIPTION</th>
                  <th>PRICE </th>
                  <th>QUANTITY</th>
                  <th>TOTAL </th>
                </tr>
                @foreach($order->products as $product)
                <tr>
                  <td><img src="{{ $product->image }}" alt="" width="80"></td>
                  <td valign="top" style="padding-left: 15px;">
                    <h5 style="margin-top: 15px;">{{ $product->name }}</h5>
                  </td>
                  <td valign="top" style="padding-left: 15px;">
                    <h5 style="font-size: 14px; color:#444;margin-top:15px"><b>{{ theMoney($product->price) }}</b></h5>
                  </td>
                  <td valign="top" style="padding-left: 15px;">
                    <h5 style="font-size: 14px; color:#444;margin-top: 10px;"><span>{{ $product->quantity }}</span></h5>
                  </td>
                  <td valign="top" style="padding-left: 15px;">
                    <h5 style="font-size: 14px; color:#444;margin-top:15px"><b>{{ theMoney($product->quantity * $product->price) }}</b></h5>
                  </td>
                </tr>
                @endforeach
                <tr class="pad-left-right-space">
                  <td class="m-t-5" colspan="3" align="left">
                    <p style="font-size: 14px;">SUBTOTAL : </p>
                  </td>
                  <td class="m-t-5" colspan="3" align="right"><b>{{ theMoney($data->subtotal) }}</b></td>
                </tr>
                <tr class="pad-left-right-space">
                  <td colspan="3" align="left">
                    <p style="font-size: 14px;">SHIPPING [{{ $data->shipping_area }}] :</p>
                  </td>
                  <td colspan="3" align="right"><b>{{ theMoney($data->shipping_cost) }}</b></td>
                </tr>
                <tr class="pad-left-right-space">
                  <td class="m-b-5" colspan="3" align="left">
                    <p style="font-size: 14px;">TOTAL :</p>
                  </td>
                  <td class="m-b-5" colspan="3" align="right"><b>{{ theMoney($data->subtotal + $data->shipping_cost) }}</b></td>
                </tr>
                <tr class="pad-left-right-space" style="border-top: 1px solid #ddd !important;">
                  <td colspan="6">
                    <a href="{{ route('/') }}" style="display:block; margin-top: 10px; margin-bottom: 10px; color: #ff0000;">Back To Home</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>