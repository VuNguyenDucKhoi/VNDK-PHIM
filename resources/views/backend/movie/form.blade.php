@extends('backend.main')

@section('content')
<main class="main">
	<div class="container-fluid">
		<div class="row">
			<!-- main title -->
			<div class="col-12">
				<div class="main__title">
					<h2>{{$title}}</h2>
				</div>
			</div>
			<!-- end main title -->

			<!-- form -->
			<div class="col-12">
				@if(!isset($movie))
                    {!! Form::open(['route' => 'admin.movie.store', 'method' => 'POST', 'enctype' =>'multipart/form-data', 'class' => 'form']) !!}
                @else
                    {!! Form::open(['route' => ['admin.movie.update',$movie->id], 'method' => 'PUT', 'enctype' =>'multipart/form-data', 'class' => 'form']) !!}
                @endif
					<div class="row">
						<div class="col-12 col-md-5 form__cover">
							<div class="row">
								<div class="col-12 col-sm-6 col-md-12">
									<div class="form__img">
                                        {!! Form::label('form__img-upload', 'Upload cover (270 x 400)', ['for' => 'form__img-upload']) !!}
                                        {!! Form::file('image', ['id' => 'form__img-upload', 'accept' => '.png, .jpg, .jpeg']) !!}
                                        @if(!isset($movie))
										    <img id="form__img" src="" alt="">
                                        @else
                                            <img id="form__img" src="{{ asset('uploads/movie/'.$movie->image) }}" alt="">
                                        @endif
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-md-8 form__content">
							<div class="row">
								<div class="col-12">
                                    {!! Form::text('title', isset($movie)? $movie->title : null, ['id' => 'slug', 'onkeyup' => 'ChangeToSlug()', 'class' => 'form__input', 'placeholder' => 'Title']) !!}
								</div>

                                <div class="col-12">
                                    {!! Form::text('slug', isset($movie)? $movie->slug : null, ['id' => 'convert_slug', 'class' => 'form__input', 'placeholder' => 'Slug']) !!}
                                </div>

                                <div class="col-12">
                                    {!! Form::textarea('description', isset($movie)? $movie->description : null, ['id' => 'description', 'class' => 'form__textarea', 'placeholder' => 'Description']) !!}
                                </div>

                                <div class="col-12">
                                    {!! Form::textarea('tags', isset($movie)? $movie->tags : null, [ 'class' => 'form__textarea', 'placeholder' => 'Tags Phim']) !!}
                                </div>
							</div>
						</div>

                        <div class="col-12">
                            {!! Form::text('trailer', isset($movie)? $movie->trailer : null, ['class' => 'form__input', 'placeholder' => 'Trailer']) !!}
                        </div>

                        <div class="col-12 col-lg-2">
                            {!! Form::select('category_id', $category, isset($movie)? $movie->category_id : null, ['class' => 'js-example-basic-multiple', 'id' => 'category']) !!}
                        </div>

                        <div class="col-12 col-lg-5">
                            {!! Form::select('country_id', $country, isset($movie)? $movie->country_id : null, ['class' => 'js-example-basic-multiple', 'id' => 'country', 'multiple' => 'multiple']) !!}
                        </div>

                        <div class="col-12 col-lg-5">
                            {!! Form::select('genre_id[]', $genre, isset($movie)? $movie->movie_genre : null, ['class' => 'js-example-basic-multiple', 'id' => 'genre', 'multiple' => 'multiple']) !!}
                        </div>

                        <div class="col-12 col-lg-8">
                            {!! Form::text('title_eng', isset($movie)? $movie->title_eng : null, ['class' => 'form__input', 'placeholder' => 'Title English']) !!}
                        </div>

                        <div class="col-12 col-lg-2">
                            {!! Form::text('episodes', isset($movie)? $movie->episodes : null, ['class' => 'form__input', 'placeholder' => 'S??? t???p']) !!}
                        </div>

                        <div class="col-12 col-lg-2">
                            {!! Form::text('running_time', isset($movie)? $movie->running_time : null, ['id' => 'running_time', 'class' => 'form__input', 'placeholder' => 'Running time']) !!}
                        </div>

                        <div class="col-12 col-lg-2">
                            {!! Form::select('moviehot', ['1' => 'Hi???n th??? phim ????? c???', '0' => 'Kh??ng'], isset($movie)? $movie->moviehot : null, ['class' => 'js-example-basic-multiple col-sm-5', 'id' => 'moviehot' ]) !!}
                        </div>

                        <div class="col-12 col-lg-2">
                            {!! Form::select('resolution', ['0' => 'HD', '1' => 'FULLHD', '2' => 'CAM', '3' => 'HDCAM', '4' => 'TRAILER'], isset($movie)? $movie->resolution : null, ['class' => 'js-example-basic-multiple col-sm-5', 'id' => 'resolution' ]) !!}
                        </div>

                        <div class="col-12 col-lg-2">
                            {!! Form::select('sub_title', [ '0' => 'Ph??? ?????', '1' => 'Thuy???t minh'], isset($movie)? $movie->sub_title : null, ['class' => 'js-example-basic-multiple col-sm-5', 'id' => 'sub_title' ]) !!}
                        </div>

                        <div class="col-12 col-lg-2">
                            {!! Form::select('isboorle', [ '0' => 'Thu???c phim l???', '1' => 'Thu???c phim b???'], isset($movie)? $movie->isboorle : null, ['class' => 'js-example-basic-multiple col-sm-5', 'id' => 'movie' ]) !!}
                        </div>

                        <div class="col-12 col-lg-2">
                            {!! Form::select('status', ['1' => 'Hi???n th???', '0' => 'Kh??ng'], isset($movie)? $movie->status : null, ['class' => 'js-example-basic-single', 'id' => 'quality']) !!}
                        </div>

						<div class="col-12">
							<div class="row">
								<div class="col-12">
									@if(!isset($movie))
                                        {!! Form::submit('Th??m', ['class' => 'form__btn']) !!}
                                    @else
                                        {!! Form::submit('C???p nh???t', ['class' => 'form__btn']) !!}
                                    @endif
								</div>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
			<!-- end form -->
		</div>
	</div>
</main>
@endsection


