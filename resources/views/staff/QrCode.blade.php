
<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i" rel="stylesheet">
    <style type="text/css">
        #QRcodePage
        {
            background-color: #F4F4F6;
        }
        p
        {
            color:  #535565;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
            font-size: 50px;
            padding: 80px;

        }
        span
        {
            color: #FFB03B;
        }
        button
        {
            color: #FFB03B;
            border-radius: 50px;
            border-color: #535565;
            font-size: 23px;
            background-color: #535565;
            transition: 1s;
        }
        button:hover
        {
            background-color:#FFB03B;
            border-color: #FFB03B;
            color: #535565;
            font-size: 33px;
            width: 120px;
            height: 60px;

        }
    </style>
</head>

<body>

<div class="container-fluid text-center">
    <p>Scan this<span> QR Code </span> to attend</p>
    {!! QrCode::size(200)->generate($qrContent);!!}
</div>
<div class="container-fluid text-center">

</div>

</body>
</html>
