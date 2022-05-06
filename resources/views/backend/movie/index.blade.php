@extends('backend.main')

@section('content')

<main class="main">
	<div class="container-fluid">
		<div class="row">
			<!-- main title -->
			<div class="col-12">
				<div class="main__title">
					<h2>{{$title}}</h2>

                    <a href="{{ route('admin.movie.create') }}" class="main__title-link">Thêm mới</a>
				</div>
			</div>
			<!-- end main title -->
            <div style="color: white" class="col-12">
                @include('backend.layouts.alert')
            </div>
			<!-- users -->
			<div class="col-12">
				<div class="main__table-wrap">
					<table class="main__table" id="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>TITLE</th>
                                <th>TAGS</th>
                                <th>IMAGE</th>
								<th>HOT</th>
                                <th>RES</th>
                                <th>SUB</th>
                                <th>CATEGORY</th>
								<th>GENRE</th>
                                <th>COUNTRY</th>
                                <th>EPISODES</th>
                                <th>RUNNING TIME</th>
                                <th>YEAR</th>
                                <th>SEASON</th>
                                <th>STATUS</th>
								<th>ACTIONS</th>
							</tr>
						</thead>

						<tbody>
                            @foreach($list as $key => $movie)
							    <tr>
                                    <td>
                                        <div class="main__table-text">{{$key+1}}</div>
                                    </td>
                                    <td>
                                        <div style="width: 120px" class="main__table-text">{{$movie->title}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">
                                            @if($movie->tags != NULL)
                                                {{Str::limit($movie->tags, 20, $end='...')}}
                                            @else
                                                Chưa có từ khóa cho phim
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">
                                            <img alt="" src="{{ asset('uploads/movie/'.$movie->image) }}" height = '80'>
                                        </div>
                                    </td>
                                    <td>
                                        @if($movie->moviehot == 1)
                                            <div class="main__table-text main__table-text--green">Gợi ý</div>
                                        @else
                                            <div class="main__table-text main__table-text--red">Không</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($movie->resolution == 0)
                                            <div class="main__table-text main__table-text--green">HD</div>
                                        @elseif($movie->resolution == 1)
                                            <div class="main__table-text main__table-text--green">FULLHD</div>
                                        @elseif($movie->resolution == 2)
                                            <div class="main__table-text main__table-text--red">CAM</div>
                                        @elseif($movie->resolution == 3)
                                            <div class="main__table-text main__table-text--red">HDCAM</div>
                                        @else
                                            <div class="main__table-text main__table-text--red">TRAILER</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($movie->sub_title == 1)
                                            <div class="main__table-text main__table-text--green">Thuyết minh</div>
                                        @else
                                            <div class="main__table-text main__table-text--green">Phụ đề</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="main__table-text">{{$movie->category->title}}</div>
                                    </td>
                                    <td>
                                        @foreach($movie->movie_genre as $genre)
                                            <div style="width: 80px" class="main__table-text">
                                                {{$genre->title}}
                                            </div>
                                         @endforeach
                                    </td>
                                    <td>
                                        <div class="main__table-text ">{{$movie->country->title}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text ">{{$movie->episodes}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text ">{{$movie->running_time}}</div>
                                    </td>
                                    <td>
                                        <form method="post">
                                            @csrf
                                            {!! Form::selectYear('year', 2000, 2022, isset($movie->year) ? $movie->year : '0' , ['class' => 'select-year', 'id' => $movie->id]) !!}
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post">
                                            @csrf
                                            {!! Form::selectRange('season', 0, 20, isset($movie->season) ? $movie->season : '0' , ['class' => 'select-season', 'id' => $movie->id]) !!}
                                        </form>
                                    </td>
                                    <td>
                                        @if($movie->status == 1)
                                            <div class="main__table-text main__table-text--green">Hiển thị</div>
                                        @else
                                            <div class="main__table-text main__table-text--red">Không</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="{{route('admin.movie.edit',$movie->id)}}" class="main__table-btn main__table-btn--edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"/></svg>
                                            </a>
                                            @if($movie->status == 0)
                                                {!! Form::open(['route' => ['admin.movie.destroy',$movie->id], 'method' => 'DELETE']) !!}
                                                    <a href="" onclick="$(this).closest('form').submit()" class="main__table-btn main__table-btn--delete open-modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Z"/></svg>
                                                    </a>
                                                {!! Form::close() !!}
                                            @else
                                                <a class="main__table-btn main__table-btn--delete open-modal">
											        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,13a1,1,0,0,0-1,1v3a1,1,0,0,0,2,0V14A1,1,0,0,0,12,13Zm5-4V7A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9ZM9,7a3,3,0,0,1,6,0V9H9Zm9,12a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z"/></svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
							    </tr>
                            @endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- end users -->
		</div>
	</div>
</main>
@endsection

@section('js')
    <script type="text/javascript">
        $('.select-year').change(function () {
            var year = $(this).find(':selected').val();
            var id_movie = $(this).attr('id');
            var _token = $('input[name= "_token"]').val();
            $.ajax({
                url: "{{route('admin.update-year-movie')}}",
                type: "POST",
                data: {year:year, id_movie:id_movie, _token:_token},
                success: function () {
                    alert('Thay đổi năm phim thành công!')
                }
            })
        })
    </script>
    <script type="text/javascript">
        $('.select-season').change(function () {
            var season = $(this).find(':selected').val();
            var id_movie = $(this).attr('id');
            var _token = $('input[name= "_token"]').val();
            $.ajax({
                url: "{{route('admin.update-season-movie')}}",
                type: "POST",
                data: {season:season, id_movie:id_movie, _token:_token},
                success: function () {
                    alert('Thay đổi mùa phim thành công!')
                }
            })
        })
    </script>
@endsection

