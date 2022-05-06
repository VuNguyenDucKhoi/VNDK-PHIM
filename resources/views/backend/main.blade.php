<!DOCTYPE html>
<html lang="en">
<head>
	@include('backend.layouts.head')
</head>
<body>

<!-- header -->
<header class="header">
	<div class="header__content">
		<!-- header logo -->
		<div style="color: white" class="header__logo">
			TRANG QUẢN TRỊ
        </div>
		<!-- end header logo -->

		<!-- header menu btn -->
		<button class="header__btn" type="button">
			<span></span>
			<span></span>
			<span></span>
		</button>
		<!-- end header menu btn -->
	</div>
</header>
<!-- end header -->

<!-- sidebar -->
@include('backend.layouts.sidebar')
<!-- end sidebar -->

<!-- main content -->

@yield('content')

<!-- end main content -->

@include('backend.layouts.js')

</html>
