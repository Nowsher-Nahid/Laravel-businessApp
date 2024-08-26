<!DOCTYPE html>
<html>
<head>
    <style>
        /* Basic reset and styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #fff;
            margin: auto;
            max-width: 600px;
        }
        .header {
            padding: 20px 0;
            text-align: center; /* Center the logo */
        }
        .header img {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 20px 0;
            text-align: left; /* Left-align all text */
        }
        .content p {
            margin: 0 0 15px;
        }
        .button-container {
            text-align: left; /* Left-align the button */
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff !important;
            background-color: #DF3821; /* Custom button color */
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            line-height: 1.5;
        }
        .button:hover {
            background-color: #c8301e; /* Slightly darker shade for hover effect */
        }
        .footer {
            padding: 20px 0;
            text-align: center; /* Center text in the footer */
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header with Logo -->
        <div class="header">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Company Logo">
        </div>
        
        <!-- Email Content -->
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            <p>Please click the button below to verify your email address:</p>
            <p>If you did not create an account, no further action is required.</p>
            <p>Thank you!</p>
            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="button">Verify Email</a>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} AimDirect. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
