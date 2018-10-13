@extends('layout_s')

@section('title',"新規登録 | OCRusion")
@section('content')
<div class="container">
<div class="card small-container">
		<div class="card-content">
		  <span class="card-title">新規登録</span>
					<form method="POST" action="{{ route('register') }}">
						@csrf


						<div class="input-field">
								<input  id="name" type="text"
									class="validate form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
									name="name" value="{{ old('name') }}" required autofocus>
								<label for="name">名前</label>

								@if ($errors->has('name'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
						</div>



						<div class="input-field">
								<input  id="email" type="email"
									class="validate form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
									name="email" value="{{ old('email') }}" required>
								<label for="name">メールアドレス</label>
	
								@if ($errors->has('email'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
						</div>


						<div class="input-field">
								<input id="password" type="password" 
									class="validate form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  required>
								<label for="password">パスワード</label>
	
								@if ($errors->has('password'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
						</div>

						<div class="input-field">
								<input id="password-confirm" type="password" 
									class="validate form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation"  required>
								<label for="password-confirm">もう一度同じパスワードを入力してください</label>

						</div>



						<div class="input-field">
								<button type="submit" class="btn-large btn-2 green lighten-1 waves-effect">
										<i class="material-icons left">account_box</i>
									登録する
								</button>
						</div>
						
					</form>
		</div>
</div>
</div>

@endsection
