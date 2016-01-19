<!DOCTYPE html>
<html>
    <head>
        @include('header')
    </head>
    <body>
        @include('navbar')
        <div class="container">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>One of the following error(s) occurred:</strong>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @elseif(session('post') === 1)
                <div class="alert alert-success">
                    Your message have been sent!
                </div>
            @endif
            @include('postform')
            {{-- @for($j = 0; $j < 5; $j++) --}}
            @foreach($fullContent as $subject)
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        [Reply] [View] {{$subject['subject_create_time']}}
                        <span class="col-lg-offset-8">
                            Cookie:{{ $subject['subject_cookie'] }}
                        </span>
                    </div>
                    <div class="container">
                        <div class="panel-body col-lg-9">
                            {{ $subject['subject_text'] }}
                        </div>
                            <img src="" style="width:250px; height:150px"/>
                            <br/>
                            <br/>
                            @foreach($subject['contents'] as $content)
                            <div class="col-lg-9">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        [Reply] [View]
                                        <span class="col-lg-offset-7">
                                            Cookie:myQBHM1
                                        </span>
                                    </div>
                                    <div class="panel-body">
                                        Wo hao bei shang a QWQ
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </body>
</html>