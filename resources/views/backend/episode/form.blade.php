
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
                @if(!isset($episode))
                    {!! Form::open(['route' => 'admin.episode.store', 'method' => 'POST', 'class' => 'form']) !!}
                @else
                    {!! Form::open(['route' => ['admin.episode.update',$episode->id], 'method' => 'PUT', 'class' => 'form']) !!}
                @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        {!! Form::select('movie_id', ['0'=>'Chọn phim', 'Phim mới nhất' => $list_movie], isset($episode)? $episode->movie_id : 0, ['class' => 'select-movie js-example-basic-single', 'id' => 'episode']) !!}
                                    </div>

                                    <div class="col-12">
                                        {!! Form::text('title', isset($episode)? $episode->title : null, ['class' => 'form__input', 'placeholder' => 'Title']) !!}
                                    </div>

                                    <div class="col-12">
                                        {!! Form::text('movie_link', isset($episode)? $episode->movie_link : null, ['class' => 'form__input', 'placeholder' => 'Link']) !!}
								    </div>

                                    <div class="col-12">
                                        {!! Form::label('episode', 'Tập phim', ['class' => 'form__title']) !!}
                                        @if(!isset($episode))
                                        <select name="episode" class="js-example-basic-multiple" id="movie">

                                        </select>
                                        @else
                                        {!! Form::text('episode', $episode->episode,  ['class' => 'form__input', 'placeholder' => 'Episode', 'readonly']) !!}
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        {!! Form::label('status', 'Trạng thái', ['class' => 'form__title']) !!}
                                        {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($episode)? $episode->status : null, ['class' => 'js-example-basic-single', 'id' => 'quality']) !!}
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        @if(!isset($country))
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
@section('js')
    <script type="text/javascript">
        {{--document.querySelector("#movie").addEventListener("change", function() {--}}
        {{--   var id = document.querySelector('#movie').value;--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('admin.select-movie')}}",--}}
        {{--        type: "GET",--}}
        {{--        data: {id:id},--}}
        {{--        success:function (data) {--}}
        {{--            document.querySelector('#episode').html(data);--}}
        {{--        }--}}
        {{--    })--}}
        {{--})--}}

        $('.select-movie').change(function(){
            var id = $(this).val();
            $.ajax({
                url: "{{route('admin.select-movie')}}",
                type: "GET",
                data: {id:id},
                success:function (data) {
                    $('#movie').html(data);
                }
            })
        })
    </script>
@endsection
