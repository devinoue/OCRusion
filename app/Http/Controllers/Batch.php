<?php

namespace App\Http\Controllers;


use App\State;
use App\Queue;
use App\BatchErrorLog;

use App\Libs\RequestCloudVision;

class Batch
{

	function __invoke()
	{
		if (State::first() != null){
			exit;
		}
		// queueの一番最初のデータを取り出す
		$target = Queue::first();

		$target_dir = $target->target_dir;
		$user_id = $target->user_id;

		// stateを更新する
		$state = new State();
		$state->target_dir = $target_dir;
		$state->save();

		// APIを叩く
		$req_ = new RequestCloudVision($user_id);
		$result =  $req_->getOcrTexts($target_dir);

		// 成功の場合
		if ($result == true) {
			$target->delete();//キューから削除
			$state->delete();//stateから削除
		} else {
			$eror_log = new BatchErrorLog;
			$eror_log->error_message = $result;
			$eror_log->user_id = $user_id;
			$error_log->target_dir = $target_dir;
			$eror_log->save();

			$state->delete();//stateから削除
		}
	}


}