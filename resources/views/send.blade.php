@extends('layouts.mail')

@section('header')

    <div class="row">
        <div class="col-lg-12">
            <div id="email-header-mobile" class="visible-xs visible-sm clearfix">
                <div id="email-header-title-mobile" class="pull-left">
                    <i class="fa fa-inbox"></i> صندوق
                </div>
                <a href="{{route('home.create')}}" class="btn btn-success email-compose-btn pull-right">
                    <i class="fa fa-pencil-square-o"></i> ارسال ایمیل
                </a>
            </div>
            <header id="email-header" class="clearfix">
                <div id="email-header-tools">
                    <div class="btn-group">
                        <a class="btn btn-primary" href="{{route('home.index')}}">
                            بازگشت به صندوق<i class="fa fa-chevron-left"></i>
                        </a>
                    </div>
                </div>
                <div id="email-header-pagination" class="pull-right hidden-xs">
                    <div class="btn-group pagination pull-right">
                        <div id="pagination-result">
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
@endsection

@section('content')
    @include('layouts.tinyeditor')

    <div id="email-content" class="email-new-nano has-scrollbar" style="height: 248px;">
        <div class="email-new-nano-content" tabindex="0" style="right: -17px;">
            <div id="email-new-inner">
                <div id="email-new-title" class="clearfix">
                    <span class="subject">ارسال پیام جدید </span>
                    @if ($errors->has('title'))
                        <span class="alert alert-danger">
                            {{ $errors->first('title') }}
                        </span>
                    @endif
                    @if ($errors->has('body'))
                        <span class="alert alert-danger">
                            {{ $errors->first('body') }}
                        </span>
                    @endif
                    @if(Session::has('user_not_found'))
                        <span class="alert alert-danger">{{ Session::get('user_not_found') }}</span>
                    @endif
                </div>
                {!! Form::open(['method'=>'POST', 'action'=> 'MessageHomeController@store', 'files'=>true, 'id'=>'sendmail'])  !!}
                    <div id="email-new-header">
                        <div class="row form-group">
                            <label for="mailCc" class="col-md-2 email-send-label">ارسال :</label>
                            <div class="col-md-10">
                                    <input  type="text" name="username" placeholder="نام کاربری" id="username" class="form-control token-input" value="@if($senduser != '' && is_array($senduser)) @foreach($senduser as $id => $user) @if($id == key(array_last($senduser))){{$user->username.','}}@else{{$user->username.', '}} @endif @endforeach @endif" autocomplete="off" autofocus />
                                <div id="usernamelist">

                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="title" class="col-md-2 email-send-label">عنوان:</label>
                            <div class="col-md-10">
                                <input name="title" placeholder="عنوان را وارد کنید" id="title" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div id="editor"></div>
                        <div class="row form-group">
                            <label for="title" class="col-md-2 email-send-label">متن:</label>
                            <div class="col-md-10">
                                {!! Form::textarea('body', null, ['class'=>'form-control tinymce', 'id'=>'textarea']) !!}
                            </div>
                        </div>
                    </div>
                    <div id="email-new-footer">
                        <div class="row">
                            <div class="col-xs-12 col-md-10 col-md-offset-2">
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button name="cancel" type="button" class="btn btn-default"><i class="fa fa-times"></i> لغو</button>
                                    </div>
                                    <div class="btn-group">
                                        <button name="send" type="submit" class="btn btn-success" id="submit_script" onclick="prepareDiv()"><i class="fa fa-send"></i>ارسال پیام</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 110px; transform: translate(0px, 0px);"></div></div></div>
@endsection


@section('scripts')

    <script src="{{asset('js/bootstrap-tokenfield.js')}}"></script>
    <script type="text/javascript">

        /*$("#username").keyup(function () {
            var query = $(this).val();
            if (query != ''){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "",
                    method: "POST",
                    data: {query:query, _token:_token},
                    success:function (data) {
                        $('#usernamelist').fadeIn();
                        $('#usernamelist').html(data);

                    }
                })
            }
            $(document).on('click', 'li', function() {
                $('#username').val($(this).text());
                $('#usernamelist').fadeOut();
            })
        });*/
        {{--$("#username").keyup(function () {--}}
                {{--var tagApi = $(this).val();--}}
                {{--var _token = $('input[name="_token"]').val();--}}

                {{--$.ajax({--}}
                    {{--url: '{{route(('autocomplete.fetch'))}}',--}}
                    {{--method: 'POST',--}}
                    {{--datatype: 'json',--}}
                    {{--data: { query: tagApi, _token:_token },--}}
                    {{--success: function (data) {--}}
                        {{--console.log(tagApi);--}}
                        {{--var formdata = [];--}}
                        {{--var d = $.parseJSON(data);--}}
                        {{--d.push('همه');--}}
                        {{--formdata.push(d);--}}
                        {{--$("#username").tokenfield({--}}
                            {{--autocomplete:{--}}
                                {{--source: d--}}
                            {{--},--}}
                            {{--showAutocompleteOnFocus: true--}}
                        {{--});--}}
                    {{--}--}}

                {{--});--}}
        {{--});--}}
        var _token = $('input[name="_token"]').val();
        $('#username').tokenfield({
            autocomplete: {
                source: function (request, response) {
                    jQuery.post("{{route(('autocomplete.fetch'))}}", {
                        query: request.term,
                        _token: _token
                    }, function (data) {
                        data = $.parseJSON(data);
                        response(data);
                    });
                },
                delay: 100
            },
            showAutocompleteOnFocus: true
        });
        {{--$("#username-tokenfield").keyup(function () {--}}
            {{--console.log("sss");--}}

            {{--var tagApi = $(this).val();--}}
                {{--var _token = $('input[name="_token"]').val();--}}
                {{--$.ajax({--}}
                    {{--url: '{{route(('autocomplete.fetch'))}}',--}}
                    {{--method: 'POST',--}}
                    {{--datatype: 'json',--}}
                    {{--data: { query: tagApi, _token:_token },--}}
                    {{--success: function (data) {--}}
                        {{--console.log(tagApi);--}}
                        {{--var formdata = [];--}}
                        {{--var d = $.parseJSON(data);--}}
                        {{--d.push('همه');--}}
                        {{--formdata.push(d);--}}
                        {{--console.log(d);--}}
                        {{--$("#username").tokenfield({--}}
                            {{--autocomplete:{--}}
                                {{--source: d,--}}
                                {{--delay:100--}}
                            {{--},--}}
                            {{--showAutocompleteOnFocus: true--}}
                        {{--});--}}
                    {{--}--}}
                {{--})});--}}
        {{--$("#sendmail").on('submit',function (event) {--}}

            {{--var form_data = $(this).serialise();--}}
            {{--$.ajax({--}}
                {{--url:"{{route(('autocomplete.fetch'))}}",--}}
                {{--method:"POST",--}}
                {{--data:form_data,--}}
                {{--success: function (data) {--}}
                    {{--$("#username").tokenfield('setTokens',[]);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}

            /*$.ajax({
                url: 'function.php',
                method: 'POST',
                datatype: 'json',
                data: { query: tagApi },
                success: function (data) {
                    var formdata = [];
                    var d = $.parseJSON(data);
                    d.push('همه')
                    formdata.push(d);
                    $("#typeahead").tokenfield({
                        autocomplete:{
                            source: d,
                            delay:100
                        },
                        showAutocompleteOnFocus: true
                    });
                    console.log(d);
                }
            });
            })});
        $("#sendmail").on('submit',function (event) {

            var form_data = $(this).serialise();
            $.ajax({
                url:"function.php",
                method:"POST",
                data:form_data,
                success: function (data) {
                    $("#typeahead").tokenfield('setTokens',[]);
                }
            });
        });*/

    </script>

    <script type="text/javascript" src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: "textarea.tinymce",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            language: 'fa',
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>


    <script>
        $('#ui-id-1').css('backgrounf-color','red');
        $('.ui-menu-item').hover(function () {
            $(this).css('backgrounf-color','red');
        })
    </script>
@endsection