<!DOCTYPE html>
<html>

<head>
    <title>Small-hurry.com</title>
</head>

<body>
    <h1>Registration Notification</h1>
    <p>Hi, {{ $data['first_name'] }}</p><br>
    <p>You have been registered on the small hurry application as a {{$data['role']}}</p>
    <p>Below are your login details:</p><br>
    <p><strong>Email address:</strong> {{$data['email']}}</p>
    <p><strong>Password:</strong> {{$data['password']}}</p><br>
    <p>Kindly click <a href'{{$data['link']}}'>here</a> to login to your account</p>
    <p>Thank you</p><br>
    <p>Small Hurry Team</p>
</body>

</html>