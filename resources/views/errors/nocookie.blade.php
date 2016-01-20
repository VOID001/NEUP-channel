<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="3;url={{ Request::server('HTTP_REFERER') }}"/>
        @include('header')
    </head>
    <body>
        @include('navbar')
        <img src="/mikumiku.jpg" style="height: 50%;width: 50%;"/>
        <h3>
            You don't have valid Cookie to post on the site! QAQ
        </h3>
    </body>
</html>