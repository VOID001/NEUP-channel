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
                        <a href="{{ Request::server('REQUEST_URI') }}/subject/{{ $subject['subject_id'] }}"><span class="label-primary label" style="font-size: 15px">[Reply]</span></a>
                        {{$subject['subject_create_time']}}
                        Cookie:{{ $subject['subject_cookie'] }}
                        <span class="col-lg-offset-8">
                            No.{{ $subject['subject_id'] }}
                        </span>
                    </div>
                    <div class="container">
                        <div class="panel-body col-lg-9">
                            {!! $subject['subject_text'] !!}
                            <br/>
                            <br/>
                            <br/>
                            @foreach($subject['contents'] as $content)
                            <div class="col-lg-10">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <a href="subject/{{ $subject['subject_id'] }}">[Reply]</a>
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
                            @if($subject['subject_img'] != '')
                                <a href="/images/{{ $subject['subject_img'] }}"><img title="Click to see full-size picture" src="/images/{{ $subject['subject_img'] }}" style="max-width:250px; height:auto"/></a>
                            @endif
                   </div>
                </div>
            @endforeach
        </div>
    </body>
</html>