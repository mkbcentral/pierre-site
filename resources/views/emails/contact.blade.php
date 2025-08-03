<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f7f7f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            background: #fff;
            max-width: 600px;
            margin: 40px auto;
            padding: 32px 24px;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
        }

        .logo {
            display: block;
            margin: 0 auto 24px auto;
            max-width: 180px;
            height: auto;
        }

        h1 {
            color: #2a7ae2;
            font-size: 2rem;
            margin-bottom: 24px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 12px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .info-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: top;
        }

        .info-table td.label {
            font-weight: bold;
            color: #2a7ae2;
            width: 120px;
            text-align: right;
        }

        .info-table td.value-name {
            color: #1a5ca4;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .info-table td.value-email {
            color: #0b8c4c;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .message-block {
            background: #f4f8fb;
            border-left: 4px solid #2a7ae2;
            padding: 18px 16px;
            border-radius: 6px;
            font-size: 1.08rem;
            margin-top: 8px;
            margin-bottom: 0;
            white-space: pre-line;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <img src="{{ asset('user.jpg') }}" alt="Logo" class="logo" style="max-width:120px;">
            <div style="text-align:center; font-size:1.1rem; font-weight:600; margin-top:8px;">
                {{ config('app.name') }}
            </div>
        </div>
        <h1>Mail de contact</h1>
        <table class="info-table">
            <tr>
                <td class="label">Nom:</td>
                <td class="value-name">{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                <td class="value-email">{{ $data['email'] }}</td>
            </tr>
            <tr>
                <td class="label">Formation d'intérêt:</td>
                <td class="value-email">{{ $data['category'] }}</td>
            </tr>
        </table>
        <p><strong>Message:</strong></p>
        <div class="message-block">
            {{ $data['message'] }}
        </div>
    </div>
</body>

</html>
