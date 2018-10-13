<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\State;
use App\Queue;
use App\ImageDir;
use App\BatchErrorLog;

use App\Libs\UnzipImgs;
use App\Libs\RequestCloudVision;


class OCRusionController extends Controller
{
	protected $image_paths = array();

	public function __construct()
	{
		//
	}


	public function index()
	{
		$msg=config('OCR.test');
		return view('index',compact('msg'));
	} 
	public function registerDir(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'upfile' => 'required|max:30720'
        ]);
 
        if ($validator->fails())
        {
            return ['error' => 'ファイルサイズが大きすぎます。30MB以内に収めてください。'];
        }

		$texts = array();
		$file = $request->file('upfile');
		
		$str = str_random(12);

		$new_zip_path = $file->move('./tmp/', $str.'_temp.zip');

		$imgZip = new UnzipImgs($new_zip_path,true);
		$target_dir = './tmp/' . str_random(16);
		$result = $imgZip->unzip($target_dir);

		// エラーがあった場合、エラーメッセージを飛ばす
		if ($result != true) {
			return ['error' => $result];
		}

		//画像ディレクトリの登録
		$image_dir = new ImageDir;
		$image_dir->user_id = $request->user_id;
		$image_dir->original_zip = $file->getClientOriginalName();
		$image_dir->target_dir = $target_dir;
		$image_dir->state = 0;
		$image_dir->save();

		// キューに登録
		$queue = new Queue;
		$queue->user_id = $request->user_id;
		$queue->target_dir = $target_dir;
		$queue->save();
		
		$oldest = Queue::first();

		// バッチの実行
		if ($_SERVER['SERVER_NAME'] == 'localhost'){
		//	$result = $this->ocrBatch();
		} else {
			exec ('curl http://ocrusion.my-portfolio.site/batch');
		}

		
		$msg = $file->getClientOriginalName() . "を登録しました";

		return ['message' => $msg];
	}


	public function ocrBatch()
	{

		// queueの一番最初のデータを取り出す
		$queue = Queue::first();

		// statesテーブルを見て、処理中かどうか判別する。
		$is_exec = State::first();
		if ($is_exec != null){
			$exec_time = time() - strtotime($is_exec->created_at); 

			// stateが5分以内に登録されたものならば、現在APIに送信中と判断して終了
			if ($exec_time < 5*60) return;

			// 5分を超えていたら不正終了したと判断してstatesテーブルから消す。
			$error_log = new BatchErrorLog;
			$error_log->error_message = "不正終了";
			$error_log->user_id = 0;
			$error_log->target_dir = $is_exec->target_dir;
			$error_log->save();

			$is_exec->delete();

			// もしも最初のキューとstateに残ったデータが等しければ、タイムアウトなどが理由による不正終了と判断
			// キューからも削除する
			if ($queue->target_dir == $is_exec->target_dir)
				$queue->delete();
		}

		// queueの一番最初のデータを取り出す
		$queue = Queue::first();

		if($queue == null) return;


		$target_dir = $queue->target_dir;
		$user_id = $queue->user_id;

		// stateを更新する
		$state = new State();
		$state->target_dir = $target_dir;
		$state->save();

		// APIを叩く
		$req_ = new RequestCloudVision($user_id);
		$result =  $req_->getOcrTexts($target_dir);

		// 成功の場合
		if ($result == true) {
			$queue->delete();//キューから削除
			$state->delete();//stateから削除
			$image_dir = ImageDir::find($target_dir);
			$image_dir->state=1;
			$image_dir->save();
			return;
		} else {
			$eror_log = new BatchErrorLog;
			$eror_log->error_message = $result;
			$eror_log->user_id = $user_id;
			$error_log->target_dir = $target_dir;
			$eror_log->save();

			$state->delete();//stateから削除
			return false;
		}
	}



}
