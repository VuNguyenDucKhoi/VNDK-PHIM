@extends('frontend.main')

@section('content')

    <!-- home -->
<section class="home">
	<!-- home bg -->
	<div class="owl-carousel home__bg">
		<div class="item home__cover" data-bg="/template/img/home/home__bg.jpg"></div>
		<div class="item home__cover" data-bg="/template/img/home/home__bg2.jpg"></div>
		<div class="item home__cover" data-bg="/template/img/home/home__bg3.jpg"></div>
		<div class="item home__cover" data-bg="/template/img/home/home__bg4.jpg"></div>
	</div>
	<!-- end home bg -->

	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="home__title"><b>PHIM</b> ĐỀ CỬ</h1>
				<button class="home__nav home__nav--prev" aria-label="prev card" type="button">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17,11H9.41l3.3-3.29a1,1,0,1,0-1.42-1.42l-5,5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l5,5a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L9.41,13H17a1,1,0,0,0,0-2Z"/></svg>
				</button>
				<button class="home__nav home__nav--next" aria-label="next card" type="button">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z"/></svg>
				</button>
			</div>

			<div class="col-12">
				<div class="owl-carousel home__carousel">
                    @foreach($movie_hot as $key => $hot)
                        <!-- card -->
                        <div class="card card--big">
                            <a href="{{route('movie',$hot->slug)}}" class="card__cover">
                                <img src="{{ asset('uploads/movie/'.$hot->image) }}" alt="{{$hot->title}}">
                                <span class="card__play">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"/></svg>
                                </span>
                            </a>
                            <div class="card__content">
                                <h3 class="card__title"><a href="{{route('movie',$hot->slug)}}">{{$hot->title}} ({{$hot->year}})</a></h3>
                                <span class="card__category">
                                    <a href="{{ route('genre',$hot->genre->slug) }}">{{ $hot->genre->title }}</a>
                                </span>
                                <div class="card__wrap">
                                    <span class="card__rate"> 8.4</span>
                                    <ul class="card__list">
                                        @if($hot->resolution == 0)
                                            <li>HD</li>
                                        @elseif($hot->resolution == 1)
                                            <li>FULLHD</li>
                                        @elseif($hot->resolution == 2)
                                            <li>CAM</li>
                                        @elseif($hot->resolution == 3)
                                            <li>HDCAM</li>
                                        @else
                                            <li>TRAILER</li>
                                        @endif
                                        @if($hot->sub_title == 1)
                                            <li>Thuyết minh</li>
                                        @else
                                            <li>Phụ đề</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    @endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end home -->

<!-- content -->
<section class="content">
	<div class="content__head">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- content title -->
					<h2 class="content__title">Phim mới cập nhật</h2>
					<!-- end content title -->

					<!-- content tabs nav -->
					<ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                        @foreach($category_home as $key => $cate_home)
						<li class="nav-item" role="presentation">
                            @if($key == 0)
							    <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">{{ $cate_home->title }}</a>
                            @elseif($key == 1)
                                <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">{{ $cate_home->title }}</a>
                            @endif
                        </li>
                        @endforeach
					</ul>
					<!-- end content tabs nav -->


					<div class="content__mobile-tabs" id="content__mobile-tabs">
						<div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<input type="button" value="PHIM BỘ">
							<span></span>
						</div>

						<div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">PHIM BỘ</a></li>
								<li class="nav-item"><a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">PHIM LẺ</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<!-- content tabs -->
		<div class="tab-content" id="myTabContent">
            @foreach($category_home as $key => $cate_home)
                @if($key == 0)
			        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                        <div class="row row--grid">
                            @foreach($cate_home->movie->take(12) as $key => $mov)
                                <!-- card -->
                                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                                        <div class="card">
                                            <a href="{{route('movie',$mov->slug)}}" class="card__cover">
                                                <img src="{{ asset('uploads/movie/'.$mov->image) }}" alt="{{$mov->title}}">
                                                <span class="card__play">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"/></svg>
                                                </span>
                                            </a>
                                            <div class="card__content">
                                                <h3 class="card__title"><a href="{{route('movie',$mov->slug)}}">{{ $mov->title }} ({{$mov->year}})</a></h3>
                                                <span class="card__category">
                                                    <a href="{{ route('genre',$mov->genre->slug) }}">{{ $mov->genre->title }}</a>
                                                    @if($mov->category_id == 19)
                                                        <div style="font-weight: 700; line-height: 100%; color: rgba(255,255,255,0.65); font-size: 12px; border: 1px solid rgba(255,255,255,0.16); padding: 5px 5px 4px; border-radius: 4px; margin-left: 10px;">
                                                            Tập: 15 / 40
                                                        </div>
                                                    @endif
                                                </span>

                                                <div class="card__wrap">
                                                    <span class="card__rate"> 8.4</span>

                                                    <ul class="card__list">
                                                        @if($mov->resolution == 0)
                                                            <li>HD</li>
                                                        @elseif($mov->resolution == 1)
                                                            <li>FULLHD</li>
                                                        @elseif($mov->resolution == 2)
                                                            <li>CAM</li>
                                                        @elseif($mov->resolution == 3)
                                                            <li>HDCAM</li>
                                                        @else
                                                            <li>TRAILER</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card -->
                            @endforeach
                        </div>
                    </div>
                @elseif($key == 1)
			        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
                        <div class="row row--grid">
                            @foreach($cate_home->movie->take(12) as $key => $mov)
                                <!-- card -->
                                <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                                    <div class="card">
                                        <a href="{{route('movie',$mov->slug)}}" class="card__cover">
                                            <img src="{{ asset('uploads/movie/'.$mov->image) }}" alt="{{$mov->title}}">
                                            <span class="card__play">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"/></svg>
                                            </span>
                                        </a>
                                        <div class="card__content">
                                            <h3 class="card__title"><a href="{{route('movie',$mov->slug)}}">{{ $mov->title }} ({{$mov->year}})</a></h3>
                                            <span class="card__category">
                                                <a href="{{ route('genre',$mov->genre->slug) }}">{{ $mov->genre->title }}</a>
                                            </span>

                                            <div class="card__wrap">
                                                <span class="card__rate"> 8.4</span>
                                                <ul class="card__list">
                                                    @if($mov->resolution == 0)
                                                        <li>HD</li>
                                                    @elseif($mov->resolution == 1)
                                                        <li>FULLHD</li>
                                                    @elseif($mov->resolution == 2)
                                                        <li>CAM</li>
                                                    @elseif($mov->resolution == 3)
                                                        <li>HDCAM</li>
                                                    @else
                                                        <li>TRAILER</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
		</div>
		<!-- end content tabs -->
	</div>
</section>
<!-- end content -->

@endsection
