<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queue;
use App\ImageDir;
use App\OcrText;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function dashboard(){
		$user = Auth::user();
		$image_dirs = ImageDir::where('user_id', $user->id)->orderBy('created_at','desc')->paginate(5);
		return view('dashboard',compact('image_dirs','user'));
	}


	public function disp($target_dir){
		$user = Auth::user();
		$target_dir = './tmp/' .$target_dir;
		
		$ocr_texts = OcrText::where('target_dir',$target_dir)->orderBy('img_path')->get();
		if ($ocr_texts == null) return "そのようなディレクトリは存在しません";

		$dir_exist_flg = file_exists($target_dir) ?? '';

		return view('disp',compact('ocr_texts','user','dir_exist_flg'));

	}

	public function upload_front(){
		$user = Auth::user();
		return view('upload_front',compact('user'));

	}

	public function deleteDir(Request $request){
		$target_dir = $request->target_dir;
		$ocr_texts = OcrText::where('target_dir',$target_dir)->get();
		if ($ocr_texts == null) return "そのようなディレクトリは存在しません";

		// データを全てのテーブルから消去する
		$queue = Queue::where('target_dir',$target_dir);
		$queue->delete();
		$ocr_texts = OcrText::where('target_dir',$target_dir);
		$ocr_texts->delete();
		$image_dirs = ImageDir::where('target_dir',$target_dir);
		$image_dirs->delete();

		$this->remove_directory($target_dir);

		return back();
		

		// $user = Auth::user();
		// $image_dirs = ImageDir::where('user_id', $user->id)->orderBy('created_at','desc')->paginate(5);
		// return view('dashboard',compact('image_dirs','user'));

		// todo フォルダを消去する
	}

	/**
	 * 指定されたディレクトリとファイルを再帰的に削除する(PHP公式を参考)
	 *　http://jp.php.net/rmdir
	 * @param string $dir	削除したいディレクトリ
	 * @return void
	 */
	function remove_directory($dir) {
		if ($handle = opendir("$dir")) {
			while (false !== ($item = readdir($handle))) {
				if ($item != "." && $item != "..") {
					if (is_dir("$dir/$item")) {
					$this->remove_directory("$dir/$item");
					} else {
					unlink("$dir/$item");
					}
				}
			}
		closedir($handle);
		rmdir($dir);
	
		}
	}
}
