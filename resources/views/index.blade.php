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
									<br>縦書きにも対応。自由にテキストを読もう🎁</p>
							</div>
							<div class="row center">
									<a href="{{url('/register')}}" class="waves-effect waves-light btn-large green lighten-1 btn-2">登録を10秒で終える</a>
							</div>
							<br><br>
						</div>
					</div>
					</div>
				<div class="parallax"><img src="{{asset('/img/main1.jpg')}}" alt=""></div>
			</div><!-- /parallax-container -->




			<div class="container">
					<div class="row">
						<div class="col s12 m4">
		
								<h2 class="center" ><i class="material-icons icon-large">
									cloud_done
									</i></h2>
								<h5 class="center">Googleの高精度OCR</h5>
		
								<p class="light">Googleの高精度OCRを利用しています。
									難解と思われていた日本語の読みとりも、強力な機械学習モデルによって精度の高い日本語テキストへの変換が可能です。
									<br>登録後はすぐにアップロードできます。</p>
						</div>
						<div class="col s12 m4">
		
							<h2 class="center"><i class="material-icons icon-large">
									translate
									</i></h2>
							<h5 class="center">縦書き・多言語に対応</h5>
							<p class="light">縦書き小説ももちろん解析可能です。長い本は一度テキスト化することでPC上で編集しながら読むことができます。もちろん横書きの専門書も、英語や多言語のテキストまで、幅広い言語も抽出することができます。</p>
						</div>		
						<div class="col s12 m4">
								<h2 class="center"><i class="material-icons icon-large">
										exposure_zero
										</i></h2>
								<h5 class="center">すべて無料</h5>
		
								<p class="light">完全無料でご使用になられます。<br>
									現在の所はアップロードサイズ制限を守っていただければ、ご自由に何度もファイルをアップすることができます。<br>※あまりにサーバー側の負荷が大きいと停止される可能性もあるので、常識の範囲内でお願いします。
								
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
									読んだ本をブログで引用したいというとき、いちいち手入力していますか？<br>
									OCRusionはそんなとき今すぐにでも役に立ちます。<br>
										<br><br>
									難解な専門書をゆっくり読みたい人は、もっと改行が欲しいと思うでしょう。<br>
									一行一行に分割すると、難解な本もずっと読みやすくなり、<br>
									本の内容をまとめるスピードはますます早くなるでしょう。<br>

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
				ご連絡はメールまで。&#112;&#97;s&#116;eu&#114;&#49;&#56;&#50;2&#64;&#103;m&#97;&#105;l&#46;c&#111;m
				</p>
				<ul class="share-buttons">
						<li><a href="https://www.facebook.com/sharer/sharer.php?u=&t=" target="_blank" title="Share on Facebook"><img src="images/flat_web_icon_set/inverted/Facebook.png"></a></li>
						<li><a href="https://twitter.com/OCRusion" target="_blank" title="Tweet"><img src="images/flat_web_icon_set/inverted/Twitter.png"></a></li>
						<li><a href="https://plus.google.com/share?url=" target="_blank" title="Share on Google+"><img src="images/flat_web_icon_set/inverted/GooglePlus.png"></a></li>
				</ul>
			</div>
		</div>
			</div>	
			

				
				<footer class="page-footer red">
					<div class="footer-copyright">
					<div class="container center">
					<p>© {{date('Y',time())}} OCRusion, All rights reserved.</p>
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