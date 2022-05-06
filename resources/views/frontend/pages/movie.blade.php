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
				<h1 class="details__title">{{$movie->title}} - {{$movie->title_eng}}</h1>
			</div>
			<!-- end title -->

			<!-- content -->
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
                            @if($movie->isboorle == 1)
                                <li>
                                    <span>Tập:</span>
                                    {{$episode_current_count}} / {{$movie->episodes}}
                                </li>
                            @endif
                            @if($movie->season != 0)
                                <li>
                                    <span>Phần:</span>
                                    {{$movie->season}}
                                </li>
                            @endif
							<li><span>Thời lượng:</span> {{$movie->running_time}}</li>
							<li>
                                <span>Quốc gia:</span>
                                <a href="{{ route('country',$movie->country->slug) }}">{{ $movie->country->title }}</a>
                            </li>
						</ul>

						<div class="card__description card__description--details">
                            {{$movie->description}}
                            <p></p>
                            Từ khóa:
                            @if($movie->tags != NULL)
                                @php
                                    $tag = array();
                                    $tags = explode(',', $movie->tags);
                                @endphp
                                @foreach($tags as $key => $tag)
                                    <a href="{{url('tag/'.$tag)}}">{{$tag}}</a>
                                @endforeach
                            @endif
						</div>

					</div>
					<!-- end card content -->
				</div>
			</div>
			<!-- end content -->

            <div class="col-12 ">
                    @if($movie->resolution != 4)
                        @if($movie->isboorle == 1 and $movie->resolution != 4)
                            @if(isset($first_episode->episode))
                                <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$first_episode->episode)}}" class="form__btn">Xem phim</a>
                            @endif
                        @else
                            @if(isset($first_episode->episode))
                                <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$first_episode->episode)}}" class="form__btn">Xem phim</a>
                            @endif
                        @endif
                    @endif
            </div>

            <div class="col-12 ">
                <h3 class="content__title">Trailer</h3>
                <div style="padding-top: 30px">
                    <iframe src="https://www.youtube.com/embed/{{$movie->trailer}}"
                                    title="Trailer {{$movie->title}}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                    </iframe>
                </div>
            </div>
		</div>
	</div>
	<!-- end details content -->
</section>
<!-- end details -->

@endsection
@section('jsfrontend')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="5lCox0pC"></script>
@endsection

