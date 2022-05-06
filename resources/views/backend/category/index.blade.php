@extends('backend.main')

@section('content')

<main class="main">
	<div class="container-fluid">
		<div class="row">
			<!-- main title -->
			<div class="col-12">
				<div class="main__title">
					<h2>{{$title}}</h2>

                    <a href="{{ route('admin.category.create') }}" class="main__title-link">Thêm mới</a>
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
								<th>DESCRIPTION</th>
								<th>STATUS</th>
								<th>SLUG</th>
								<th>ACTIONS</th>
							</tr>
						</thead>
						<tbody class="order_position">
                            @foreach($list as $key => $cate)
							    <tr id="{{$cate->id}}">
                                    <td>
                                        <div class="main__table-text">{{ ($list->currentpage()-1) * $list->perpage() + $key + 1 }}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">{{$cate->title}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">{{$cate->description}}</div>
                                    </td>
                                    <td>
                                        @if($cate->status == 1)
                                            <div class="main__table-text main__table-text--green">Hiển thị</div>
                                        @else
                                            <div class="main__table-text main__table-text--red">Không</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="main__table-text">{{$cate->slug}}</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="{{route('admin.category.edit',$cate->id)}}" class="main__table-btn main__table-btn--edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"/></svg>
                                            </a>
                                            @if($cate->status == 0)
                                                {!! Form::open(['route' => ['admin.category.destroy',$cate->id], 'method' => 'DELETE']) !!}
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

			<!-- paginator -->
			<div class="col-12">
				<div class="paginator-wrap">
					<span>{{ ($list->currentpage()-1) * $list->perpage() + $key + 1 }} trên tổng {{ $sum }}</span>
                    {!! $list->links('layouts.semantic-ui') !!}
				</div>
			</div>
			<!-- end paginator -->
		</div>
	</div>
</main>
@endsection

@section('js')
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $('.order_position').sortable({
            placeholder: 'ui-state-highlight',
            update: function (event, ui) {
                var array_id = [];
                $('.order_position tr').each(function (){
                    array_id.push($(this).attr('id'));
                })
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('admin.resorting')}}",
                    type: "POST",
                    data: {array_id:array_id},
                    success:function (data){
                        alert('Sắp xếp thứ tự thành công!')
                    }
                })
            }
        })
    </script>
@endsection

