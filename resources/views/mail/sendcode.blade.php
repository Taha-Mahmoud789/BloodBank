<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Pin Code</title>
    <style>
        /* Basic Reset */
        body, table, td, a {
            text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            border: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
            font-size: 24px;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .pin-code {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        /* Media Queries */
        @media only screen and (max-width: 600px) {
            .container {
                width: 95%;
                padding: 10px;
            }
            h1 {
                font-size: 20px;
            }
            p {
                font-size: 14px;
            }
            .pin-code {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Your Pin Code</h1>
    <p>Your verification pin code is:</p>
    <p class="pin-code">{{ $pinCode }}</p>
    <p>If you didn't request this, please ignore this email.</p>
</div>
</body>
</html>
