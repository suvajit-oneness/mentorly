<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="date=no" />
	<meta name="format-detection" content="address=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
	<link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700i|Poppins:400,400i,700,700i" rel="stylesheet" />
    <!--<![endif]-->
	<title>Mentorly Invoice</title>
	<!--[if gte mso 9]>
	<style type="text/css" media="all">
		sup { font-size: 100% !important; }
	</style>
	<![endif]-->
</head>

<body style="background-color:#efefef;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="width:570px; margin:50px auto 10px;background-color:#fff;padding:30px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #1cb3d3;">
    <thead>
      <tr>
        <th style="text-align:left;"><a href="#"><img style="max-width: 150px;" src="{{url('/')}}/design/img/logo.png" alt="Mentorly"></a></th>
        <th style="text-align:right;font-weight:400; font-size: 13px;">{{$todayDate}}</th>
      </tr>
    </thead>
    <tbody>
        <tr>
        <td colspan="2" style="font-size:14px;padding:50px 15px 0 0">
          <strong>Subject : </strong>
          <span style="padding-left: 4px;">Mentorly Invoice Generated</span> 
        </td>
        <tr>
        <tr>
            <td style="height:35px;"></td>
        </tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Transanction ID - </span><b style="color:green;font-weight:normal;margin:0">{{$transactionId}}</b></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Details - </span> {{$content}}</p>
          <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Amount - </span>$ {{$amount}}</p>
        </td>
      </tr>
      <tr>
        <td style="height:20px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
          <strong style="display:block;margin:0 0 10px 0;">Best Wishes ,</strong>
          Mentorly
        </td>
      </tr>
    </tbody>
    <tfooter>
        <tr>
            <td style="height:80px; border-bottom: 1px solid #efefef;" colspan="2"></td>
        </tr>
        <tr>
            <td class="text-footer1 pb10" style="color:#ababab; font-family:Arial, sans-serif; font-size:12px; line-height:13px; text-align:left; vertical-align:middle; padding-bottom:5px; padding-top: 20px;">© 2021 mentorly. All rights reserved</td>
            
            <td class="text-footer1 pb10" style="color:#ababab; font-family:Arial, sans-serif; font-size:10px; line-height:13px; text-align:right; vertical-align:middle; padding-bottom:5px; padding-top: 20px;">
                <a href="" class="margin-right:5px;"><img src="{{url('/')}}/design/img/fb.png"></a>
                <a href="" class="margin-right:5px;"><img src="{{url('/')}}/design/img/tw.png"></a>
                <a href="" class="margin-right:5px;"><img src="{{url('/')}}/design/img/in.png"></a>
                <a href="" class="margin-right:5px;"><img src="{{url('/')}}/design/img/insta.png"></a>
            </td>
        </tr>
    </tfooter>
  </table>
</body>

</html>