<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$subject}}</title>
</head>
<body>
    <ul>
        <li>Name: {{$name}}</li>
        <li>Subject: {{$subject}}</li>
        <li>Email: {{$email or 'Not provided'}}</li>
        <li>Phone: {{$phone or 'Not provided'}}</li>
        <li>IP: {{$ip}}</li>
    </ul>
    <h4>Message</h4>
    <pre>{{$msg}}</pre>
</body>
</html>