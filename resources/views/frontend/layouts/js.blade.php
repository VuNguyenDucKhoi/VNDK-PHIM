<script src="{{asset('template/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('template/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('template/js/jquery.mousewheel.min.js')}}"></script>
<script src="{{asset('template/js/jquery.mCustomScrollbar.min.js')}}"></script>
<script src="{{asset('template/js/wNumb.js')}}"></script>
<script src="{{asset('template/js/nouislider.min.js')}}"></script>
<script src="{{asset('template/js/plyr.min.js')}}"></script>
<script src="{{asset('template/js/jquery.morelines.min.js')}}"></script>
<script src="{{asset('template/js/photoswipe.min.js')}}"></script>
<script src="{{asset('template/js/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('template/js/main.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#timkiem').keyup(function () {
            $('#result').html('');
            var search = $('#timkiem').val();
            if (search != ''){
                $('#result-div').css('display', 'inherit');
                var expression = new RegExp(search,"i");
                $.getJSON('/template/json/movie.json', function (data){
                    $.each(data, function (key, value) {
                       if(value.title.search(expression) != -1){
                           $('#result').append('<tr style="color: white; cursor: pointer;">> ' +
                                   '<th style=" padding: 10px">' +
                                        '<img style="border-radius: 2px" src="/uploads/movie/'+value.image+'" height="60">' +
                                   '</th>' +
                                   '<th>' +
                                        ''+value.title+'' +
                                   '</th>' +
                               '</tr>');
                       }
                    });
                });
            }
            else{
                $('#result-div').css('display', 'none');
            }
        });
        $('#result').on('click', 'tr', function () {
            var click_text = $(this).text();
            $('#timkiem').val($.trim(click_text));
            $('#result').html('');
            $('#result-div').css('display', 'none');
        });
    });
</script>

@yield('jsfrontend')
