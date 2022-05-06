@extends('backend.main')

@section('content')

<main class="main">
	<div class="container-fluid">
		<div class="row">
			<!-- main title -->
			<div class="col-12">
				<div class="main__title">
					<h2>{{$title}}</h2>
                    <a href="{{ route('admin.episode.create') }}" class="main__title-link">Thêm mới</a>
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
                                <th>MOVIE</th>
                                <th>IMAGE</th>
								<th>TITLE</th>
                                <th>EPISODE</th>
								<th>LINK</th>
                                <th>UPDATE AT</th>
								<th>ACTIONS</th>
							</tr>
						</thead>

						<tbody>
                            @foreach($list as $key => $episode)
							    <tr>
                                    <td>
                                        <div class="main__table-text">{{ $key + 1 }}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">{{$episode->movie->title}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">
                                            <img alt="" src="{{ asset('uploads/movie/'.$episode->movie->image) }}" height = '80'>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">{{$episode->title}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">{{$episode->episode}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">{{Str::limit($episode->movie_link, 50, $end='...')}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">{{$episode->updated_at}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="{{route('admin.episode.edit',$episode->id)}}" class="main__table-btn main__table-btn--edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"/></svg>
                                            </a>
                                            @if($episode->status == 0)
                                                {!! Form::open(['route' => ['admin.episode.destroy',$episode->id], 'method' => 'DELETE']) !!}
                                                    <a onclick="$(this).closest('form').submit()" class="main__table-btn main__table-btn--delete open-modal">
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

