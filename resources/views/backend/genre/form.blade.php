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
                @if(!isset($genre))
                    {!! Form::open(['route' => 'admin.genre.store', 'method' => 'POST', 'class' => 'form']) !!}
                @else
                    {!! Form::open(['route' => ['admin.genre.update',$genre->id], 'method' => 'PUT', 'class' => 'form']) !!}
                @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        {!! Form::text('title', isset($genre)? $genre->title : null, ['id' => 'slug', 'onkeyup' => 'ChangeToSlug()', 'class' => 'form__input', 'placeholder' => 'Title']) !!}
                                    </div>

                                    <div class="col-12">
                                        {!! Form::text('slug', isset($genre)? $genre->slug : null, ['id' => 'convert_slug', 'class' => 'form__input', 'placeholder' => 'Slug']) !!}
                                    </div>

                                    <div class="col-12">
                                        {!! Form::textarea('description', isset($genre)? $genre->description : null, ['id' => 'description', 'class' => 'form__textarea', 'placeholder' => 'Description']) !!}
                                    </div>

                                    <div class="col-12">
                                        {!! Form::label('status', 'Trạng thái', ['class' => 'form__title']) !!}
                                        {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($genre)? $genre->status : null, ['class' => 'js-example-basic-single', 'id' => 'quality']) !!}
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        @if(!isset($genre))
                                            {!! Form::submit('Thêm', ['class' => 'form__btn']) !!}
                                        @else
                                            {!! Form::submit('Cập nhật', ['class' => 'form__btn']) !!}
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
