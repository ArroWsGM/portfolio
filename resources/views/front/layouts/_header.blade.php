<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $page_title or 'ArroWs Development Portfolio' }}</title>
	@if(isset($all_settings['SEO_description']))
	<meta name="description" content="{{ $all_settings['SEO_description'] }}">
	@endif
	<link href="/favicon.ico" rel="icon" type="image/x-icon" />

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.css') }}">

	<!-- Arricons -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/arricons.css') }}">

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/font-awesome.css') }}">
	
	<!-- Головий файл стиля-->
	{{--<link rel="stylesheet" type="text/css" href="{{ elixir('css/style.css') }}">--}}
	<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">

	@yield('styles')
	
	<!-- Вставка HTML5 поєднується з Respond.js для підтримки в IE8 елементів HTML5 та медіа-запитів -->
	<!-- ЗАСТЕРЕЖЕННЯ: файл Respond.js не працює, якщо ви проглядаєте сторінку відкривши її з файлової системи -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
{{-- Loading --}}
<div class="loadanimation"><div class="spinner text-red"><i class="fa fa-gear fa-spin"></i></div></div>
	<div class="sticky-footer-wraper">
		<div class="container-fluid">