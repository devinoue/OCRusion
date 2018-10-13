@extends('layout2')

@section('title','OCRusion | 自炊支援の日本語OCRサービス')


@section('content')

			<div id="navbar" class="navbar-fixed scrollspy">
				<nav  class="white">
					<div class="nav-wrapper container">
					<div class="container"> <a href="{{url('/')}}" class="brand-logo">OCRusion</a></div>
					<ul class="right hide-on-med-and-down">
					 <li class="black-text">自炊支援の日本語OCRサービス</li>

						 <li><a class="btn-small  waves-teal btn-flat" href="{{url('/login')}}">ログイン</a></li>
						 <li><a href="{{url('/register')}}" class="btn-small btn-2 green lighten-1 waves-effect">新規登録</a></li>
					</ul>
					</div>
				</nav>
			</div>



			<div class="parallax-container">
					<div class="container">
						<br><br>
						<div class="container">
								<div class="container">
							<h1 class="white-text main-title">OCRusion</h1>
							<div class="row">
									<p class="col s12 white-text">画像から日本語テキストを抽出するOCRサービスです。
									<br>縦書きにも対応。誰でも自由にテキストを読もう🎁</p>
							</div>
							<div class="row center">
									<a href="{{url('/register')}}" class="waves-effect waves-light btn-large green lighten-1 btn-2">登録を10秒で終える</a>
							</div>
							<br><br>
						</div>  <!-- /container -->
					</div>  <!-- /container -->
					</div>  <!-- /container -->
				<div class="parallax"><img src="{{asset('/img/main1.png')}}" alt=""></div>
			</div><!-- /parallax-container -->




			<div class="container">
					<div class="row">
						<div class="col s12 m4">
		
								<h2 class="center" ><i class="material-icons icon-large">
									cloud_done
									</i></h2>
								<h5 class="center">Googleの高精度OCR</h5>
		
								<p class="light">Googleの高精度OCRを利用しています。
									難解と思われていた日本語OCRに
									<br>登録後はすぐにアップロードできます。</p>
						</div>
						<div class="col s12 m4">
		
							<h2 class="center"><i class="material-icons icon-large">
									translate
									</i></h2>
							<h5 class="center">縦書きにも対応</h5>
							<p class="light">日本語で書かれた縦書き小説ももちろん解析可能です。<br>
								横書きの専門書から捨てられない本まで、どんなものまでテキスト化することができます。</p>
						</div>		
						<div class="col s12 m4">
								<h2 class="center"><i class="material-icons icon-large">
										exposure_zero
										</i></h2>
								<h5 class="center">すべて無料</h5>
		
								<p class="light">完全無料でご使用になられます。<br>
									いくら使ってもOKです。
								
								</p>
						</div>
		

					</div>
		
			</div>

				
			<div class="parallax-container">
				<div class="container">
					<div class="container">
					<div class="center row col s3 white-text">
							<br><br>
						<h3>OCRusionは読書生活を変えます</h3>
					</div>
					<div class="container">
						<div class="row col s12 white-text">
								<p>
									読んだ本をブログで引用したいというときも、いちいち手入力していますか？
									OCRusionは今すぐにでも役に立ちます。<br>
										<br><br>
									難解な専門書をゆっくり読みたい人は、もっと改行が欲しいと思うでしょう。<br>
									テキスト形式にすることで、ずっと読みやすくなり、<br>
									本をまとめるスピードはますます早くなるでしょう。<br>
									
								</p>
							</div>  <!-- /container -->
						</div>
					</div>
					 
				</div>
				<br><br>
				<div class="parallax">
					<img src="{{asset('/img/main2.jpg')}}"" alt="img">
				</div>
			</div>

				
			<div class="container section scrollspy" id="contactus">
				<br>
			<br>
			<h2>About us</h2>	
			
		<div class="row">
			<div class="small_container">
				<p>
				OCRuisonは個人プロジェクトです。<br>
				ご連絡はメールまで。&#100;&#97;r&#119;inian&#49;&#56;&#53;&#57;&#64;g&#109;ai&#108;.&#99;&#111;m
				</p>
				<ul class="share-buttons">
						<li><a href="https://www.facebook.com/sharer/sharer.php?u=&t=" target="_blank" title="Share on Facebook"><img src="images/flat_web_icon_set/inverted/Facebook.png"></a></li>
						<li><a href="https://twitter.com/OCRusion" target="_blank" title="Tweet"><img src="images/flat_web_icon_set/inverted/Twitter.png"></a></li>
						<li><a href="https://plus.google.com/share?url=" target="_blank" title="Share on Google+"><img src="images/flat_web_icon_set/inverted/GooglePlus.png"></a></li>
				</ul>
			</div>
		</div>
			</div>	
			
{{-- 
				
				<div class="container section scrollspy" id="contactus">
						<br>
					<br>
					<h2>About us</h2>	
					
				<div class="row">
						
				<form class="col s8">
				
					<div class="row">
					<div class="input-field col s6">
						<input id="name" type="text" class="validate">
						<label for="name">Your Name</label>
					</div>
				 
					
					<div class="input-field col s6">
						<input id="email" type="email" class="validate">
						<label for="email">Your Email</label>
					</div>
					</div><!--row-->
					
					 <div class="row">
					<div class="input-field col s12">
						<input id="message-sub" type="email" class="validate">
						<label for="message-sub">Message Subject</label>
					</div>
					</div>
					
					 <div class="row">
					<div class="input-field col s12">
						 <textarea id="text_area" class="materialize-textarea"></textarea>
						<label for="text_area">Your Message</label>
					</div>
					</div>
					
					 
					<div>
						<a class="waves-effect waves-light btn purple lighten-1">Send Message<i class="mdi-content-send right"></i></a>
					</div>
					 </form>
					 
					<div class="col s12 m4">
									<p>
									OCRusionは個人プロジェクトです。<br>
									
									</p>
								 <ul class="share-buttons">
					<li><a href="https://www.facebook.com/sharer/sharer.php?u=&t=" target="_blank" title="Share on Facebook"><img src="images/flat_web_icon_set/inverted/Facebook.png"></a></li>
					<li><a href="https://twitter.com/intent/tweet?hashtags=OCRusion%20" target="_blank" title="Tweet"><img src="images/flat_web_icon_set/inverted/Twitter.png"></a></li>
					<li><a href="https://plus.google.com/share?url=" target="_blank" title="Share on Google+"><img src="images/flat_web_icon_set/inverted/GooglePlus.png"></a></li>
				</ul>
								</div>
					 
					 
				</div>

				</div>
				 --}}
				
				<footer class="page-footer purple lighten-1">
				 
					<div class="footer-copyright">
					<div class="container">
					 <p>Copyright © OCRusion.</p>
					</div>
					</div>
				</footer>
				
				<script>
				document.addEventListener('DOMContentLoaded', function() {
					var elems = document.querySelectorAll('.parallax');
					var instances = M.Parallax.init(elems);
 				});

				</script>

		
@endsection