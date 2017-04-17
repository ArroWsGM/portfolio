<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$msg->subject}}</title>
    <style>
        body {
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }
    </style>
</head>
<body>
{!!$msg->reply!!}
</body>
</html>