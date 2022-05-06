@extends('frontend.main')

@section('content')

    <!-- page title -->
<section class="section section--first section--bg" data-bg="/template/img/section/section.jpg">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section__wrap">
					<!-- section title -->
					<h1 class="section__title">Phim năm {{ $year_movie }}</h1>
					<!-- end section title -->

					<!-- breadcrumb -->
					<ul class="breadcrumb">
						<li class="breadcrumb__item"><a href="{{ route('home') }}">Trang chủ</a></li>
						<li class="breadcrumb__item breadcrumb__item--active">Phim năm {{ $year_movie }}</li>
					</ul>
					<!-- end breadcrumb -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end page title -->

<!-- filter -->
<div class="filter">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="filter__content">
					<div class="filter__items">
						<!-- filter item -->
						<div class="filter__item" id="filter__genre">
							<span class="filter__item-label">GENRE:</span>

							<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<input type="button" value="Action/Adventure">
								<span></span>
							</div>

							<ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-genre">
								<li>Action/Adventure</li>
								<li>Animals</li>
								<li>Animation</li>
								<li>Biography</li>
								<li>Comedy</li>
								<li>Cooking</li>
								<li>Dance</li>
								<li>Documentary</li>
								<li>Drama</li>
								<li>Education</li>
								<li>Entertainment</li>
								<li>Family</li>
								<li>Fantasy</li>
								<li>History</li>
								<li>Horror</li>
								<li>Independent</li>
								<li>International</li>
								<li>Kids</li>
								<li>Kids & Family</li>
								<li>Medical</li>
								<li>Military/War</li>
								<li>Music</li>
								<li>Musical</li>
								<li>Mystery/Crime</li>
								<li>Nature</li>
								<li>Paranormal</li>
								<li>Politics</li>
								<li>Racing</li>
								<li>Romance</li>
								<li>Sci-Fi/Horror</li>
								<li>Science</li>
								<li>Science Fiction</li>
								<li>Science/Nature</li>
								<li>Spanish</li>
								<li>Travel</li>
								<li>Western</li>
							</ul>
						</div>
						<!-- end filter item -->

						<!-- filter item -->
						<div class="filter__item" id="filter__quality">
							<span class="filter__item-label">QUALITY:</span>

							<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-quality" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<input type="button" value="HD 1080">
								<span></span>
							</div>

							<ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-quality">
								<li>HD 1080</li>
								<li>HD 720</li>
								<li>DVD</li>
								<li>TS</li>
							</ul>
						</div>
						<!-- end filter item -->

						<!-- filter item -->
						<div class="filter__item" id="filter__rate">
							<span class="filter__item-label">IMBd:</span>

							<div class="filter__item-btn dropdown-toggle" role="button" id="filter-rate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class="filter__range">
									<div id="filter__imbd-start"></div>
									<div id="filter__imbd-end"></div>
								</div>
								<span></span>
							</div>

							<div class="filter__item-menu filter__item-menu--range dropdown-menu" aria-labelledby="filter-rate">
								<div id="filter__imbd"></div>
							</div>
						</div>
						<!-- end filter item -->

						<!-- filter item -->
						<div class="filter__item" id="filter__year">
							<span class="filter__item-label">RELEASE YEAR:</span>

							<div class="filter__item-btn dropdown-toggle" role="button" id="filter-year" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class="filter__range">
									<div id="filter__years-start"></div>
									<div id="filter__years-end"></div>
								</div>
								<span></span>
							</div>

							<div class="filter__item-menu filter__item-menu--range dropdown-menu" aria-labelledby="filter-year">
								<div id="filter__years"></div>
							</div>
						</div>
						<!-- end filter item -->
					</div>

					<!-- filter btn -->
					<button class="filter__btn" type="button">apply filter</button>
					<!-- end filter btn -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end filter -->

<!-- catalog -->
<div class="catalog">
	<div class="container">
		<div class="row row--grid">
            @foreach($movie as $key => $mov)
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
                            <h3 class="card__title"><a href="{{route('movie',$mov->slug)}}">{{$mov->title}} ({{$mov->year}})</a></h3>
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            @endforeach
		</div>

		<div class="row">
			<!-- paginator -->
			<div class="col-12">
				{!! $movie->links('layouts.semantic-ui') !!}
			</div>
			<!-- end paginator -->
		</div>
	</div>
</div>
<!-- end catalog -->


@endsection
