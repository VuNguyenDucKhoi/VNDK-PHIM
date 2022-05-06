@extends('frontend.main')

@section('headfrontend')
    <link rel="stylesheet" href="{{asset('template/css/comment.css')}}">
@endsection

@section('content')

<!-- details -->
<section class="section details">
	<!-- details background -->
	<div class="details__bg" data-bg="/template/img/home/home__bg.jpg"></div>
	<!-- end details background -->


	<!-- details content -->
	<div class="container">
		<div class="row">
			<!-- title -->
			<div class="col-12">
				<h1 class="details__title">{{$movie->title}} - {{$movie->title_eng}} - {{$episode_movie->title}}</h1>
			</div>
			<!-- end title -->'

            <div class="col-12 col-xl-11">
                <div class="card card--details card--series">
                    <!-- card cover -->
                    <div class="card__cover">
                        <img src="{{ asset('uploads/movie/'.$movie->image) }}" alt="{{$movie->title}}">
                    </div>
                    <!-- end card cover -->

                    <!-- card content -->
                    <div class="card__content">
                        <div class="card__wrap">
                            <span class="card__rate"> 8.4</span>
                            <ul class="card__list">
                                @if($movie->resolution == 0)
                                    <li>HD</li>
                                @elseif($movie->resolution == 1)
                                    <li>FULHD</li>
                                @elseif($movie->resolution == 2)
                                    <li>CAM</li>
                                @elseif($movie->resolution == 3)
                                    <li>HDCAM</li>
                                @else
                                    <li>TRAILER</li>
                                @endif
                                @if($movie->sub_title == 1)
                                    <li>Thuyết minh</li>
                                @else
                                    <li>Phụ đề</li>
                                @endif
                            </ul>
                        </div>

                        <ul class="card__meta">
                            <li>
                                <span>Thể loại:</span>
                                @foreach($movie->movie_genre as $gen)
                                    <a href="{{ route('genre',$gen->slug) }}">{{ $gen->title }}</a>
                                @endforeach
                            </li>
                            <li>
                                <span>Năm:</span>
                                <a href="{{ url('year/'.$movie->year )}}">{{$movie->year}}</a>
                            </li>
                            <li><span>Thời lượng:</span> {{$movie->running_time}}</li>
                            <li>
                                <span>Quốc gia:</span>
                                <a href="{{ route('country',$movie->country->slug) }}">{{ $movie->country->title }}</a>
                            </li>
                        </ul>


                    </div>
                    <!-- end card content -->
                </div>
            </div>


            <div class="col-12">

                <!-- player -->
                <div style="padding-top: 30px">

                    <iframe src="{{$episode_movie->movie_link}}" frameborder="0"
                            allowfullscreen>
                    </iframe>
                </div>
                <!-- end player -->


                <!-- accordion -->
                <div class="accordion" id="accordion">
                    <div class="accordion__card">
                        <div class="card-header" id="headingOne">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                <span>Tập</span>
                            </button>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                <table class="accordion__list">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Ngày cập nhật</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($movie->episode as $key => $epi)
                                        <tr>
                                            <th style="{{$episode == $epi->episode ? 'color: rgb(255, 85, 165);' : ''}}">{{$epi->episode}}</th>
                                            <td>
                                                <a style="{{$episode == $epi->episode ? 'color: rgb(255, 85, 165);' : ''}}"
                                                   href="{{url('xem-phim/'.$movie->slug.'/tap-'.$epi->episode)}}">
                                                    {{$epi->title}}
                                                </a>
                                            </td>
                                            <td style="{{$episode == $epi->episode ? 'color: rgb(255, 85, 165);' : ''}}">{{$epi->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end accordion -->
            </div>
		</div>
	</div>
	<!-- end details content -->
</section>
<!-- end details -->

<!-- content -->
<section class="content">
	<div class="content__head">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- content title -->
					<h2 class="content__title">Discover</h2>
					<!-- end content title -->

					<!-- content tabs nav -->
					<ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Comments</a>
						</li>

						<li class="nav-item" role="presentation">
							<a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Reviews</a>
						</li>

						<li class="nav-item" role="presentation">
							<a class="nav-link" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Trailer</a>
						</li>
					</ul>
					<!-- end content tabs nav -->

					<!-- content mobile tabs nav -->
					<div class="content__mobile-tabs" id="content__mobile-tabs">
						<div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<input type="button" value="Comments">
							<span></span>
						</div>

						<div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Comments</a></li>

								<li class="nav-item"><a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Reviews</a></li>

								<li class="nav-item"><a class="nav-link" id="3-tab" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Trailer</a></li>
							</ul>
						</div>
					</div>
					<!-- end content mobile tabs nav -->
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 col-xl-8">
				<!-- content tabs -->
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
						<div class="row">
							<!-- comments -->
							<div style="padding-top: 30px; padding-bottom: 30px" class="col-12">
                                @php
                                    $current_url = Request::url();
                                @endphp
								<div class="comment-round">
                                    <div  class="fb-comments" data-colorscheme="light"
                                         data-href="{{$current_url}}"
                                         data-width="100%" data-numposts="15">
                                    </div>
                                </div>
							</div>
							<!-- end comments -->
						</div>
					</div>

					<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
						<div class="row">
							<!-- reviews -->
							<div class="col-12">
								<div class="reviews">
									<ul class="reviews__list">
										<li class="reviews__item">
											<div class="reviews__autor">
												<img class="reviews__avatar" src="/template/img/user.svg" alt="">
												<span class="reviews__name">Best Marvel movie in my opinion</span>
												<span class="reviews__time">24.08.2018, 17:53 by John Doe</span>

												<span class="reviews__rating"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7c0.1,0.1,0.3,0.1,0.5,0.1v0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z"></path></svg>8.4</span>
											</div>
											<p class="reviews__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
										</li>

										<li class="reviews__item">
											<div class="reviews__autor">
												<img class="reviews__avatar" src="/template/img/user.svg" alt="">
												<span class="reviews__name">Best Marvel movie in my opinion</span>
												<span class="reviews__time">24.08.2018, 17:53 by John Doe</span>

												<span class="reviews__rating"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7c0.1,0.1,0.3,0.1,0.5,0.1v0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z"></path></svg>9.0</span>
											</div>
											<p class="reviews__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
										</li>

										<li class="reviews__item">
											<div class="reviews__autor">
												<img class="reviews__avatar" src="/template/img/user.svg" alt="">
												<span class="reviews__name">Best Marvel movie in my opinion</span>
												<span class="reviews__time">24.08.2018, 17:53 by John Doe</span>

												<span class="reviews__rating"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7c0.1,0.1,0.3,0.1,0.5,0.1v0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z"></path></svg>7.5</span>
											</div>
											<p class="reviews__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
										</li>
									</ul>

									<form action="#" class="form">
										<input type="text" class="form__input" placeholder="Title">
										<textarea class="form__textarea" placeholder="Review"></textarea>
										<div class="form__slider">
											<div class="form__slider-rating" id="slider__rating"></div>
											<div class="form__slider-value" id="form__slider-value"></div>
										</div>
										<button type="button" class="form__btn">Send</button>
									</form>
								</div>
							</div>
							<!-- end reviews -->
						</div>
					</div>

					<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="3-tab">
                        <!-- project gallery -->
						<div class="gallery" itemscope>
							<div class="row row--grid">
								<!-- gallery item -->
								<figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
									<a href="/template/img/gallery/project-1.jpg" itemprop="contentUrl" data-size="1920x1280">
										<img src="/template/img/gallery/project-1.jpg" itemprop="thumbnail" alt="Image description" />
									</a>
									<figcaption itemprop="caption description">Some image caption 1</figcaption>
								</figure>
								<!-- end gallery item -->

								<!-- gallery item -->
								<figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
									<a href="/template/img/gallery/project-2.jpg" itemprop="contentUrl" data-size="1920x1280">
										<img src="/template/img/gallery/project-2.jpg" itemprop="thumbnail" alt="Image description" />
									</a>
									<figcaption itemprop="caption description">Some image caption 2</figcaption>
								</figure>
								<!-- end gallery item -->

								<!-- gallery item -->
								<figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
									<a href="/template/img/gallery/project-3.jpg" itemprop="contentUrl" data-size="1920x1280">
										<img src="/template/img/gallery/project-3.jpg" itemprop="thumbnail" alt="Image description" />
									</a>
									<figcaption itemprop="caption description">Some image caption 3</figcaption>
								</figure>
								<!-- end gallery item -->

								<!-- gallery item -->
								<figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
									<a href="/template/img/gallery/project-4.jpg" itemprop="contentUrl" data-size="1920x1280">
										<img src="/template/img/gallery/project-4.jpg" itemprop="thumbnail" alt="Image description" />
									</a>
									<figcaption itemprop="caption description">Some image caption 4</figcaption>
								</figure>
								<!-- end gallery item -->

								<!-- gallery item -->
								<figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
									<a href="/template/img/gallery/project-5.jpg" itemprop="contentUrl" data-size="1920x1280">
										<img src="/template/img/gallery/project-5.jpg" itemprop="thumbnail" alt="Image description" />
									</a>
									<figcaption itemprop="caption description">Some image caption 5</figcaption>
								</figure>
								<!-- end gallery item -->

								<!-- gallery item -->
								<figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
									<a href="/template/img/gallery/project-6.jpg" itemprop="contentUrl" data-size="1920x1280">
										<img src="/template/img/gallery/project-6.jpg" itemprop="thumbnail" alt="Image description" />
									</a>
									<figcaption itemprop="caption description">Some image caption 6</figcaption>
								</figure>
								<!-- end gallery item -->
							</div>
						</div>
						<!-- end project gallery -->
					</div>
				</div>
				<!-- end content tabs -->
			</div>

			<!-- sidebar -->
			<div class="col-12 col-lg-4 col-xl-4">
				<div class="row row--grid">
					<!-- section title -->
					<div class="col-12">
						<h2 class="section__title section__title--sidebar">Có thể bạn thích...</h2>
					</div>
					<!-- end section title -->
                    @foreach($movie_related as $key => $mov)
                        <!-- card -->
                        <div class="col-6 col-sm-4 col-lg-6">
                            <div class="card">
                                <a href="{{route('movie',$mov->slug)}}" class="card__cover">
                                    <img src="{{ asset('uploads/movie/'.$mov->image) }}" alt="{{$mov->title}}">
                                    <span class="card__play">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"/></svg>
                                    </span>
                                </a>
                                <div class="card__content">
                                    <h3 class="card__title">
                                        <a href="{{route('movie',$mov->slug)}}">{{ $mov->title }} - {{$mov->title_eng}}</a>
                                    </h3>
                                    <span class="card__category">
                                        <a href="{{ route('genre',$mov->genre->slug) }}">{{ $mov->genre->title }}</a>
                                        @if($mov->category_id == 19)
                                            <ul class="card__list">
                                                <li>Tập: 15 / 40</li>
                                            </ul>
                                        @endif
                                    </span>
                                    <div class="card__wrap">
                                        <span class="card__rate"> 8.4</span>
                                        <ul class="card__list">
                                            @if($movie->resolution == 0)
                                                <li>HD</li>
                                            @elseif($movie->resolution == 1)
                                                <li>SD</li>
                                            @elseif($movie->resolution == 2)
                                                <li>HDCAM</li>
                                            @elseif($movie->resolution == 3)
                                                <li>CAM</li>
                                            @else
                                                <li>FULLHD</li>
                                            @endif
                                            @if($movie->sub_title == 1)
                                                <li>Thuyết minh</li>
                                            @else
                                                <li>Phụ đề</li>
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
			<!-- end sidebar -->
		</div>
	</div>
</section>
<!-- end content -->

@endsection
@section('jsfrontend')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="5lCox0pC"></script>
@endsection
