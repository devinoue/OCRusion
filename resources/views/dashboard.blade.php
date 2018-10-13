@extends('layout')

@section('title','ダッシュボード')


@section('content')

@if(count($image_dirs) == 0)
@section('style','css/app.css')
@endif

   @isset($msg)
  {{$msg}}
  @endisset

  @if (session('msg'))
  {{ session('msg') }}
  @endif

 <h3>アップロード済みファイル</h3>
 <ul class="browser-default">
   <li class="list">「未処理」のファイルは、現在順番待ちのファイルです。<br>もうしばらくお待ち下さい。</li>
   <li class="list">「異常終了」のファイルは、OCR作業中にエラーがあったファイルです。<br>ファイルを削除して、もう一度アップロードをお願いします。</li>
 </ul>
 <hr />

 @if(count($image_dirs) > 0)
 <div class="collection">


  @foreach($image_dirs as $dir) 

          @if($dir->state == 0)


          <a class = "collection-item avatar waves-effect waves-green collection_add"><i class="material-icons circle">folder</i>
            <span class="title black-text">{{$dir->original_zip}}</span>
            <p class="blue-grey-text lighten-1">{{$dir->created_at}}<br>
 
             </p>
             <span class="secondary-content grey-text lighten-1">未処理<i class="material-icons grey-text lighten-1">grade</i></span>
          </a>

          <li class="collection-item">
							
							<a value="aiu" class="waves-effect waves-teal btn-flat btn-small" onclick="delClick('{{$dir->target_dir}}')">
									<i class="material-icons left">delete</i>
                </a>
					</li>



          @else
          
          <a href = "{{url('/dashboard/' . $dir->target_dir)}}" class = "collection-item avatar waves-effect waves-green collection_add"><i class="material-icons circle green">folder</i>
            <span class="title black-text">{{$dir->original_zip}}</span>
            <p class="blue-grey-text lighten-1">{{$dir->created_at}}<br>
 
             </p>
             <span class="secondary-content">
               OCR処理済み<i class="material-icons green-text">grade</i>
            </span>
          </a>
          <li class="collection-item">
							
							<a value="aiu" class="waves-effect waves-teal btn-flat btn-small" onclick="delClick('{{$dir->target_dir}}')">
									<i class="material-icons left">delete</i>
								</a>
						</li>
          
          @endif

  @endforeach

</div>

   {{$image_dirs->links('vendor.pagination.materialize')}}
@else
画像の入ったZIPファイルをアップロードしてください。
<br><br>
<p><a href="{{url('/upload_front')}}">アップロードする</a></p>
<div id="app">
<main-view :token="'{{ csrf_token() }}'" :user_id="'{{$user->id}}'"></main-view>
  </div>
  <script src="js/app.js"></script>
   @endif


   <form id="delete" action="{{ url('delete') }}" method="POST" style="display: none;">
    <input type="hidden" name="target_dir" value="">
    {{method_field('DELETE')}}
      @csrf
    </form>


@endsection