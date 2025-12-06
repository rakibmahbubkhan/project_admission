<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #74787e;
            height: 100%;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }
        .wrapper {
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        .content {
            margin: 0;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            padding: 25px 0;
            text-align: center;
        }
        .header a {
            color: #3d4852;
            font-size: 19px;
            font-weight: bold;
            text-decoration: none;
        }
        .body {
            background-color: #ffffff;
            border-bottom: 1px solid #edeff2;
            border-top: 1px solid #edeff2;
            margin: 0;
            padding: 35px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            background-color: #e2e8f0;
            color: #2d3748;
            border-radius: 9999px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
            margin-bottom: 20px;
            text-transform: capitalize;
        }
        .status-badge.approved, .status-badge.successful, .status-badge.admitted {
            background-color: #def7ec;
            color: #03543f;
        }
        .status-badge.rejected {
            background-color: #fde8e8;
            color: #9b1c1c;
        }
        .status-badge.pay_application_fees, .status-badge.pay_required_deposit {
            background-color: #feecdc;
            color: #9c4221;
        }
        .footer {
            margin: 0 auto;
            padding: 0;
            text-align: center;
            width: 570px;
            padding-top: 30px;
        }
        .footer p {
            color: #aeaeae;
            font-size: 12px;
            text-align: center;
        }
        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <div class="header">
                <a href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="body">
                <h2 style="color: #3d4852; margin-top: 0;">Application Update</h2>
                
                <p>Hello <strong>{{ $studentName }}</strong>,</p>
                
                <p>There has been an update regarding your application to <strong>{{ $universityName }}</strong>.</p>
                
                <div style="text-align: center;">
                    <span class="status-badge {{ strtolower(str_replace(' ', '_', $status)) }}">
                        {{ $status }}
                    </span>
                </div>

                <div style="background-color: #f7fafc; padding: 15px; border-left: 4px solid #4f46e5; margin: 20px 0;">
                    <p style="margin: 0; color: #4a5568;">
                        {!! nl2br(e($messageBody)) !!}
                    </p>
                </div>

                <p>Please log in to your dashboard to view full details or take further action if required.</p>

                <div style="text-align: center;">
                    <a href="{{ route('login') }}" class="button" target="_blank">
                        Go to Dashboard
                    </a>
                </div>

                <p style="margin-top: 30px;">
                    Best regards,<br>
                    The {{ config('app.name') }} Team
                </p>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>