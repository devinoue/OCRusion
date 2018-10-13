@extends('layout')

@section('title','OCRusion | 自炊用日本語OCR')
@section('style','css/app.css')

@section('content')


	<p>
		画像ファイルを圧縮したZIPファイルをアップすると、テキスト形式にします。<br>
	</p>
	@isset($msg)
	{{$msg}}
	@endisset
	
	@if (session('msg'))
	{{ session('msg') }}
	@endif

	<div id="app">
		<main-view :token="'{{ csrf_token() }}'" :user_id="'{{$user->id}}'"></main-view>
	</div>



      <script src="js/app.js"></script>
@endsection