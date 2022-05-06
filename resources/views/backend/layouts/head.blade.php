    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- CSS -->
	<link rel="stylesheet" href="{{asset("template/admin/css/bootstrap-reboot.min.css")}}">
	<link rel="stylesheet" href="{{asset("template/admin/css/bootstrap-grid.min.css")}}">
	<link rel="stylesheet" href="{{asset("template/admin/css/magnific-popup.css")}}">
	<link rel="stylesheet" href="{{asset("template/admin/css/jquery.mCustomScrollbar.min.css")}}">
	<link rel="stylesheet" href="{{asset("template/admin/css/select2.min.css")}}">
	<link rel="stylesheet" href="{{asset("template/admin/css/admin.css")}}">

    <!-- datatable -->
    <link rel="stylesheet" href="{{asset("template/admin/css/jquery.dataTables.min.css")}}">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="{{asset("template/admin/icon/favicon-32x32.png")}}" sizes="32x32">
	<link rel="apple-touch-icon" href="{{asset("template/admin/icon/favicon-32x32.png")}}">

	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>Admin</title>

    @yield('head')
