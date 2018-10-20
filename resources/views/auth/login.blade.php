@extends('layout_s')

@section('title',"ログイン画面 | OCRusion")
@section('content')
<div class="container">
<div class="card small-container">
		<div class="card-content">
		  <span class="card-title">ログイン</span>
		  
					<form method="POST" action="{{ route('login') }}">
						@csrf

						<div class="input-field">
							<input  id="email" type="email"
								class="validate form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
								name="email" value="{{ old('email') }}" required autofocus>
							<label for="email">メールアドレス</label>

							@if ($errors->has('email'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
						</div>

						<div class="input-field">
							<input id="password" type="password" 
								class="validate form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
								name="password" value="{{ old('password') }}" required>
							<label for="password">パスワード</label>

							@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>

						<div>
								<label>
								<input class="filled-in" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
								<span>フォームの情報を記憶する</span>
								</label>
						</div>

						<div class="input-field">
								<button type="submit" class="btn-large waves-effect  waves-light blue lighten-2">
										<i class="material-icons left">exit_to_app</i>
									ログインする
								</button>

								{{-- <a class="waves-effect  waves-light btn-flat" href="{{ route('password.request') }}">
									パスワードを忘れましたか？
								</a> --}}

						</div>
					</form>
				</div>
				<div class="card-action">
					<a href="{{ url('/auth/google')}}" class="round waves-effect waves-light btn deep-orange accent-4 white-text">
						
						Googleでログイン
					</a>
					<a href="{{ url('/auth/facebook')}}" class="round waves-effect waves-light btn indigo darken-4 white-text">
						
						Facebookでログイン
					</a>
					<a href="{{ url('/auth/github')}}" class="round waves-effect waves-light btn grey darken-4 white-text">
						
						Githubでログイン
					</a>

				</div>
			</div>
</div>
</div>

@endsection
