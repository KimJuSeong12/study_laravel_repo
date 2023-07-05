<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forum</title>
    <!-- 부트스트랩 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- 부트스트랩 js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- 폰트어썸 -->
    <script src="https://kit.fontawesome.com/6a2bc27371.js" crossorigin="anonymous"></script>

    {{-- css , js 추가 --}}
    @yield('inside_head_tag')
</head>

<body>
    @include('inc.nav')
    <!-- 본문부분 -->
    @yield('content')
    <!-- 푸터부분 -->
    @include('inc.footer')
    {{-- 자바스크립트 추가, js --}}
    @yield('before_body_tag')
</body>

</html>
