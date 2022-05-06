<header class="header">
	<div class="header__wrap">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="header__content">
						<!-- header logo -->
						<div class="header__logo">
							<a style="color: white; font-size: x-large" href="{{ route('home') }}">
                                <strong>VNDK</strong><strong style="color: #ff55a5">PHIM</strong>
                            </a>
						</div>
						<!-- end header logo -->



						<!-- header nav -->
						<ul class="header__nav">

                            <li class="header__nav-item">
							    <a href="{{ route('home') }}" class="header__nav-link">PHIM MỚI</a>
                            </li>

                            @foreach($category as $key => $cate)
                            <li class="header__nav-item">
								<a href="{{ route('category',$cate->slug) }}" class="header__nav-link">{{ $cate->title }}</a>
							</li>
                            @endforeach
							<!-- dropdown -->
							<li class="header__nav-item">
								<a class="dropdown-toggle header__nav-link" role="button" id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thể loại <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17,9.17a1,1,0,0,0-1.41,0L12,12.71,8.46,9.17a1,1,0,0,0-1.41,0,1,1,0,0,0,0,1.42l4.24,4.24a1,1,0,0,0,1.42,0L17,10.59A1,1,0,0,0,17,9.17Z"/></svg></a>
								<ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                    @foreach($genre as $key => $gen)
									<li><a href="{{ route('genre',$gen->slug) }}">{{ $gen->title }}</a></li>
                                    @endforeach
								</ul>
							</li>
							<!-- end dropdown -->

                            <!-- dropdown -->
							<li class="header__nav-item">
								<a class="dropdown-toggle header__nav-link" role="button" id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Quốc gia <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17,9.17a1,1,0,0,0-1.41,0L12,12.71,8.46,9.17a1,1,0,0,0-1.41,0,1,1,0,0,0,0,1.42l4.24,4.24a1,1,0,0,0,1.42,0L17,10.59A1,1,0,0,0,17,9.17Z"/></svg></a>
								<ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                    @foreach($country as $key => $cou)
									<li><a href="{{ route('country',$cou->slug) }}">{{$cou->title}}</a></li>
                                    @endforeach
								</ul>
							</li>
							<!-- end dropdown -->

                            <!-- dropdown -->
							<li class="header__nav-item">
								<a class="dropdown-toggle header__nav-link" role="button" id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Năm <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17,9.17a1,1,0,0,0-1.41,0L12,12.71,8.46,9.17a1,1,0,0,0-1.41,0,1,1,0,0,0,0,1.42l4.24,4.24a1,1,0,0,0,1.42,0L17,10.59A1,1,0,0,0,17,9.17Z"/></svg></a>
								<ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                    @foreach($movie_year as $key => $mov_yea)
									<li><a href="{{ url('year/'.$mov_yea->year )}}">{{$mov_yea->year}}</a></li>
                                    @endforeach
								</ul>
							</li>
							<!-- end dropdown -->
						</ul>
						<!-- end header nav -->

						<!-- header auth -->
						<div class="header__auth">
							<button class="header__search-btn" aria-label="search btn" type="button">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z"/></svg>
							</button>

							<a href="signin.html" class="header__sign-in">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20,12a1,1,0,0,0-1-1H11.41l2.3-2.29a1,1,0,1,0-1.42-1.42l-4,4a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l4,4a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L11.41,13H19A1,1,0,0,0,20,12ZM17,2H7A3,3,0,0,0,4,5V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V16a1,1,0,0,0-2,0v3a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V8a1,1,0,0,0,2,0V5A3,3,0,0,0,17,2Z"/></svg>
								<span>Đăng nhập</span>
							</a>
						</div>
						<!-- end header auth -->

						<!-- header menu btn -->
						<button class="header__btn" type="button">
							<span></span>
							<span></span>
							<span></span>
						</button>
						<!-- end header menu btn -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- header search -->
	<form action="{{route('search')}}" method="GET" class="header__search">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="header__search-content">
						<input id="timkiem" name="tu-khoa" type="text" placeholder="Tìm kiếm phim...">
						<button type="submit">Tìm kiếm</button>
					</div>

                    <div id="result-div" class="col-12" style="height: 200px; overflow: auto; display: none">
                       <table id="result">

                       </table>
                   </div>
				</div>
			</div>

		</div>
	</form>
	<!-- end header search -->
</header>
