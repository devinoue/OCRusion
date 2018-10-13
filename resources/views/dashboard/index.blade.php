@extends('layout')

@section('title','ダッシュボード')


@section('content')



<div class="hero-body">
    <div class="container">
   @isset($msg)
  {{$msg}}
  @endisset

  @if (session('msg'))
  {{ session('msg') }}
  @endif

 USER info
 id : {{$user->id}}
 name : {{$user->name}}
  <table class="table">
  <thead>
    <th>Zipファイル名</th><th>OCR処理状況</th><th>アップロード日</th>
  </thead>
  @foreach($image_dirs as $dir) 
      <tr><th><a href="{{url('/dashboard/' . $dir->target_dir)}}">{{$dir->original_zip}}</a></th>
        <td>
          @if($dir->state == 0)
          <span>未処理</span>
          @else
          <span>処理済み</span>
          @endif
        </td>
        <td><span>{{$dir->created_at}}</span></td>
      
      </tr>
  @endforeach
   </table>
   {{$image_dirs->links()}}



  <form action="{{url('/register_dir')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="mode" value="start">
  <input class="button" type="file" name="upfile">
  <br>
  <br>
  <input  class="button is-large" type="submit" name="send" value="　送信する　"><br>
  
  
  </form>


    </div><!-- end container has-text-centered -->
  </div>  <!-- end hero-body -->


@endsection