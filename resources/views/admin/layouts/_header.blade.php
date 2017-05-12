<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ isset($page_title) ? $page_title . ' :: ' . $cms_about->cms_name . ' v' . $cms_about->cms_version : 'Admin Panel' }}</title>
	<link href="/favicon.ico" rel="icon" type="image/x-icon" />
	
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.css') }}">

	<!-- Arricons -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/arricons.css') }}">

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/font-awesome.css') }}">
	
	<!-- Головий файл стиля-->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/style_admin.css') }}">

	@yield('styles')
	
	<!-- Вставка HTML5 поєднується з Respond.js для підтримки в IE8 елементів HTML5 та медіа-запитів -->
	<!-- ЗАСТЕРЕЖЕННЯ: файл Respond.js не працює, якщо ви проглядаєте сторінку відкривши її з файлової системи -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="loadanimation"><div class="spinner text-red"><i class="fa fa-gear fa-spin"></i></div></div>
	<div class="sticky-footer-wraper">