<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Central real</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{url('/css/bootstrap.css')}}" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 10px 0 30px 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
                   style="border: 1px solid #cccccc; border-collapse: collapse;">
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">

                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                                    <b>Thông báo đăng ký sự kiện</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:20px; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Tên sự kiện: {{$event->title_vi}}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:20px; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Mô tả sự kiện: {{$event->des_short_vi}}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:20px; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Họ và tên: {{$register_event->name}}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:20px; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Số điện thoại: {{$register_event->phone}}
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top:20px; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Email: {{$register_event->email}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>