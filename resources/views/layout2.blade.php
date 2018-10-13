
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta property="og:title" content="@yield('title')" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://ocrusion.my-portfolio.site/" />
<meta property="og:site_name" content="@yield('title')" />
<meta property="og:description" content="本の自炊を支援するための日本語OCRサービスサイトです。" />
<meta property="og:image" content="http://ocrusion.my-portfolio.site/public/img/ogcard.jpg" />
<meta property="og:locale" content="ja_JP" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:image" content="http://ocrusion.my-portfolio.site/public/img/ogtwi.jpg" />
<meta name="twitter:description" content="本の自炊を支援するための日本語OCRサービスサイトです。" />
<meta name="twitter:site" content="@OCRusion" />
<meta name="twitter:creator" content="@OCRusion" />
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="{{asset('css/materialize.min.css')}}">
<link rel="stylesheet" type="text/css" href="@yield('style')">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">


<body>
	@yield('content')

	<script src="{{asset('js/main.js')}}"></script>
	<script src='{{asset('js/materialize.min.js')}}'></script>
	<script>
	</script>
</body>
	
</html>
