@extends('layout')

@section('title','個別ページ | OCRusion')


@section('content')

<nav>
		<div class="nav-wrapper">
		  <div class="col s12 blue-grey darken-1 ">
			<a href="{{url('/dashboard')}}" class="breadcrumb">トップページ</a>
		  <a href="#!" class="breadcrumb">個別ページ</a>
		  </div>
		</div>
	  </nav>
			  


   @isset($msg)
  {{$msg}}
  @endisset

  @if (session('msg'))
  {{ session('msg') }}
  @endif




  <h3>処理済みファイル</h3>
  <hr />
	@isset($ocr_texts)
	@foreach($ocr_texts as $ocr_text)

		@if($dir_exist_flg)
		<a href="{{url($ocr_text->img_path)}}" target="_blank">{{str_replace($ocr_text->target_dir,'',$ocr_text->img_path)}}</a>
		@endif
	<div>
	<textarea id="text" placeholder="ここにテキストが入ります">

		{{$ocr_text->ocr_text}}

	</textarea>
</div><br>
	@endforeach
	@endisset

@endsection