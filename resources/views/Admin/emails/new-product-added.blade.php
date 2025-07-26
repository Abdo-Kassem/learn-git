<?php
    $content = getNewProductEmailContent($user->prefered_language);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>New Product Added</title>
    <style>
        /* Fallback for some email clients that don't respect external styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        .container {
            background-color: #ffffff;
            margin: 0 auto;
            padding: 20px;
            width: 600px;
            border-radius: 10px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
            direction: {{ $user->prefered_language == 'ar' ? 'rtl' : 'ltr' }}
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
            color: #333333;
        }
        .content h1 {
            font-size: 24px;
            color: #007bff;
        }
        .product-details {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        /*
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777777;
            font-size: 12px;
        }*/
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $content['email_header'] }}</h1>
        </div>

        <div class="content">
            <p>{{ $content['dear'] }} {{ $user->first_name }} {{ $user->last_name }},</p>
            <p>{{ $content['email_description1'] }}</p>

            <!-- Product Details -->
            <div class="product-details">
                <p><strong>{{ $content['product_name'] }}:</strong> {{ $user->prefered_language == 'ar' ? $product->name_ar : $product->name_fr }}</p>
                <p><strong>{{ $content['description'] }}:</strong> {{ $user->prefered_language == 'ar' ? $product->description_ar : $product->description_fr }}</p>
                <p><strong>{{ $content['price'] }}:</strong> {{ $product->price }}</p>
            </div>

            <!-- Call to Action Button -->
            <p>{{ $content['email_description2'] }}</p>

            <p>{{ $content['thank_you'] }}</p>
        </div>
        <!--
        <div class="footer">
            <p>Your Company Name, Address, Contact</p>
            <p>If you have any questions, please feel free to contact us at support@company.com.</p>
        </div>
        -->
    </div>
</body>
</html>
