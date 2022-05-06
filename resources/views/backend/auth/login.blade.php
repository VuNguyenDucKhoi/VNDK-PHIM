<!DOCTYPE html>
<html lang="en">

<head>
	@include('backend.layouts.head')
</head>
<body>

<div class="sign section--bg" data-bg="{{asset("template/admin/img/section/section.jpg")}}">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="sign__content">
					<form method="POST" action="{{ route('admin.adminlogin') }}" class="sign__form">
                        @csrf
                        <div style="color: white" class="sign__logo">
                            <strong>ĐĂNG NHẬP ADMIN</strong>
                        </div>

						<div class="sign__group">
							<input id="email" type="text" class="sign__input" type="email" name="email"
                                   value="{{old('email')}}" required autofocus  placeholder="Email">
						</div>

						<div class="sign__group">
							<input type="password" id="password" name="password"
                                required autocomplete="current-password" class="sign__input" placeholder="Mật khẩu">
						</div>

						<div class="sign__group sign__group--checkbox">
							<input id="remember" name="remember" type="checkbox" checked="checked">
							<label for="remember">Nhớ mật khẩu</label>
						</div>

						<button class="sign__btn" type="submit">Đăng nhập</button>

						<span class="sign__text">Chưa có tài khoản? <a href="#">Đăng ký!</a></span>

                        @if (Route::has('password.request'))
                            <span class="sign__text"><a href="{{ route('password.request') }}">Quên mật khẩu?</a></span>
                        @endif
					</form>
					<!-- end authorization form -->
				</div>
			</div>
		</div>
	</div>
</div>

@include('backend.layouts.js')
</body>

</html>








