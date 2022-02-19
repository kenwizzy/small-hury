<!DOCTYPE html>
<html>

<head>
    <title>Small-hurry.com</title>
</head>

<body>
    <h1>New Order Notification</h1>
    <p>Hi,</p><br>
    <p>There is a new order request with order number .{{$data['order']['id']}}. from the small hurry mobile app </p>
    <p>Kindly click <a href'{{$data['link']}}'>here</a> to login to your account and start processing the order</p>
    <p>Thank you</p><br>
    <p>Small Hurry Team</p>
</body>

</html>