<!DOCTYPE html>
<head>
    @include('header')
</head>
<body>
    @include('navbar')
    <!--
    <div class="col-xs-2" style="position:fixed;margin: 0;left: 0;overflow:scroll ;;padding:0; background: #f8efc0;width:120px; border-right-style:solid; height:100%;">
        @foreach($categories as $category)
            <div>
                <a href="/cat/{{ $category['cat_id'] }}"><strong>{{ $category['cat_name'] }}</strong></a>
            </div>
        @endforeach
    </div>
    -->
    <!--<div class="container col-xs-offset-1">-->
    <div class="container">
        <div>
            @if(!isset($firstLogin) && Cookie::get('neupchan') === NULL)
                <div class="alert alert-warning">No Cookie Available now QAQ</div>
            @elseif(isset($firstLogin))
                <div class="alert alert-success">Now you have a cookie~~~ Welcome to NEUP-@Channel Please Refresh this page</div>
            @else
                <div class="alert alert-success">
                    Welcome! ~ Your CookieID:{{ $shortCookie }}
                </div>
            @endif
        </div>

        <div class="h2 text-center" style="padding:40px">NEUP-@Channel</div>
        <div class="jumbotron">
            <h4 class="navbar">Categories</h4>
            <div class="text-center">
                <!--<img src="http://cover.acfunwiki.org/cover.php" class="img-thumbnail" alt="300x300" style="width:40%; height:40%; margin:10px">-->
            </div>
            <div class="container">
                @foreach($categories as $category)
                    <?php
                    $arr = array('primary', 'danger', 'default', 'success', 'warning', 'info');
                    shuffle($arr);
                    $theme = $arr[0];
                    ?>
                    <a href="/cat/{{ $category['cat_id'] }}"><button class="btn btn-{{ $theme }} btn-lg"><strong>{{ $category['cat_name'] }}</strong></button></a>
                @endforeach
            </div>
        </div>
   </div>
</body>
