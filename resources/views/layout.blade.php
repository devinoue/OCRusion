
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


<link rel="stylesheet" type="text/css" href="@yield('style')">

<link rel="stylesheet" type="text/css" href="{{asset('css/materialize.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

<style>

		
		</style>
<body>
		<header>
			<ul id="mobile-demo" class="sidenav sidenav-fixed">
				<li class="logo">
				</li>
				<li class="bold"><a href="{{url('./dashboard')}}" class="waves-effect waves-teal"><i class="material-icons">list</i>ファイル一覧</a></li>
				<li class="bold"><a href="{{url('./upload_front')}}" class="waves-effect waves-teal"><i class="material-icons">cloud_upload</i>アップロード</a></li>
				<li class="bold"><a href="{{url('./privacy')}}" class="waves-effect waves-teal">プライバシーポリシー</a></li>
				<li class="bold"><a href="{{url('./contact')}}" class="waves-effect waves-teal">お問い合わせ</a></li>
			</ul>
			<!-- Sidebar BSA-->
		</header>




		<div id="navbar" class="navbar-fixed scrollspy">
				<nav  class="white">
					<div class="nav-wrapper container">
							<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<div class="container"> <a href="{{url('/')}}" class="brand-logo">OCRusion</a>
					
					</div>
					<ul class="right hide-on-med-and-down">
					 <li class="black-text">自炊支援の日本語OCRサービス</li>

					 <li><a href="#"  data-target="modal1" class="modal-trigger"><i class="material-icons left">exit_to_app</i>ログアウト</a></li>
					 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						 @csrf
					 </form>
					</ul>
					</div>
				</nav>
		</div>



		<main class="box">
			<div class="container ">
				<div class="row">
					<div class="col s12">
						<br><br>
							@yield('content')
						<br><br>
					</div>
				</div>
			</div>
		</main>



		<div id="modal1" class="modal modal-fixed-footer">
			<div class="modal-content">
			<h4>ログアウトしますか？</h4>
			<p></p>
			</div>
			<div class="modal-footer">
			<a href="#!" class="modal-close waves-effect waves-green btn-flat">キャンセル</a>
			<a href="#!" id="logout" class="modal-close waves-effect waves-green btn-flat">ログアウトする</a>
			</div>
		</div>



		<script src="{{asset('js/main.js')}}"></script>
		<script src='{{asset('js/materialize.min.js')}}'></script>
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.sidenav');
			var instances = M.Sidenav.init(elems);
		});
	
		</script>
	</body>
	
</html>
