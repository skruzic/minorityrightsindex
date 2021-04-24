<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:o="urn:schemas-microsoft-com:office:office"
>
<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="telephone=no" name="format-detection" />
    <title></title>
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i"
        rel="stylesheet"
    />
    <style type="text/css">
        body {
            width: 100%;
            font-family: roboto, "helvetica neue", helvetica, arial, sans-serif;
            padding: 0;
            margin: 0;
            background-color: #2980d9;
        }
        table {
            border-collapse: collapse;
        }
        td {
            padding: 10px;
        }
        .container {
            background-color: #2980d9;
        }
        .main-table {
            width: 100% !important;
            max-width: 600px;
            margin-inline-start: auto;
            margin-inline-end: auto;
        }
        .header {
            text-align: center;
            font-size: 1.4em;
            line-height: 48px;
            color: #fff;
        }
        .content {
            background-color: #fff;
            border: 1px solid #fff;
        }
        .text {
            margin: 0;
            line-height: 21px;
            color: #666;
            font-size: 14px;
        }
        .link-wrapper {
            border-style: solid;
            border-color: #2cb543;
            background: #2980d9;
            border-width: 0;
            border-radius: 5px;
            width: auto;
        }
        .link-cell:hover {
            background: #3498db !important;
        }
        .link {
            text-decoration: none !important;
            color: #fff;
            background-color: #3498db !important;
            border-style: solid;
            border-color: #3498db !important;
            border-width: 10px 99px;
            border-radius: 5px;
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
            .link-wrapper {
                display: block !important;
            }
            .link {
                display: block !important;
                font-size: 14px;
                border-left-width: 0px !important;
                border-right-width: 0px !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="main-table">
            <thead class="header">
                <tr>
                    <td>
                        <strong>M</strong
                        >inority<strong>R</strong>ights<strong>I</strong>ndex
                    </td>
                </tr>
            </thead>
            <tbody class="content">
                <tr>
                    <td class="text">
                        {!! $invite->campaign->messages['email_before'] !!}
                    </td>
                </tr>
                <tr>
                    <td align="center">
              <span class="link-wrapper">
                <a href="{{ url('/campaign/'.$invite->campaign->slug.'?token='.$invite->token) }}" class="link">Go to the questionnaire</a>
              </span>
                    </td>
                </tr>
                <tr>
                    <td class="text">{!! $invite->campaign->messages['email_after'] !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
