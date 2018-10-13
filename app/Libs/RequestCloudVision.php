<?php

namespace App\Libs;

use App\OcrText;
use Illuminate\Support\Facades\Config;

/**
 * CloudVisionにアクセスするクラス
 * 与えられたパスから画像を検索する。
 */
class RequestCloudVision
{

	public $target_dir;
	public $user_id;
	public $api_key;


	/**
	 * 一度のリクエストにセットする画像枚数。Googleの仕様では現在最大16枚(2018/10/08)
	 *しかし一枚当たりの画像サイズが大きすぎるとAPIに弾かれるので、現在は15枚の画像をセットしている。
	 * @var integer
	 */
	public $max_img_num = 15;



	function __construct($user_id)
	{
		$this->user_id = $user_id;
		$this->api_key = Config::get('OCR.api_key');
	}

	/**
	 * OCRリクエスト作成メソッド
	 *
	 * @param string $target_dir	APIに飛ばす画像が入っているディレクトリ	
	 * @return mixed	成功した際はtrue、それ以外はエラー理由を返す
	 */
	function getOcrTexts($target_dir)
	{
		$this->target_dir = $target_dir;

		// 画像へのパス
		$image_paths=array();

		// ファイルのパスを保存する
		if ($handle = opendir($target_dir)) {
			while (false !== ($file = readdir($handle))) {
				if ( $file != "." && $file != ".." ) {
					$image_paths[] = $target_dir . '/' . $file;
				}
			}
			closedir($handle);
		}

		$requests=array();
		// ファイルパスの入った配列から、リクエストを作る。数に達したら、request2APIを実行。
		foreach ($image_paths as $image_path) {

			if(!file_exists($image_path)) return "file not found. path:". $image_path;
			$image = base64_encode( file_get_contents($image_path) );

			if ((strlen($image)/1000) >= 4000) {
				return "1画像当たりのファイルサイズが大きすぎます";
			}

			$requests[] = array ('image' => ['content' => $image],
				'features' => [
					['type' => 'TEXT_DETECTION'],
				],);

			$tmp_image_paths[] = $image_path;

			// もしもリクエストするデータがmax_img_num(画像枚数)になったら
			if (count($requests) >= $this->max_img_num) {
				
				if ((strlen(json_encode($requests))/1000) >= 8000) {
					return "画像のファイルサイズが大きすぎます。もう少し小さくしてアップロードしてください";
				}
				$result = $this->request2API($requests,$tmp_image_paths);
				if ($result != true) 
					return $result;
				sleep(1);
				$requests = array(); // 初期化
				$tmp_image_paths = array(); // 初期化
			}
		}
		// 残ったデータをリクエスト
		if (count($requests) > 0) {
			$result = $this->request2API($requests,$tmp_image_paths);
			if ($result != true) 
				return $result;
		}
		return true;
	
	}

	/**
	 * APIへリクエストを送る
	 *
	 * @param array $requests	主にBase64エンコードされたデータを格納した配列
	 * @param array $tmp_image_paths	画像のパス(現在は使われていないが、将来使う可能性がある)
	 * @return mixed 成功の際はtrueを、失敗であればエラー理由を返す
	 */
	protected function request2API($requests,$tmp_image_paths)
	{
		

		//要求
		$body = [];
	
		$body = [
			'requests' => $requests
		];
	
	
		// リクエスト用のJSONを作成
		$json = json_encode($body) ;
	
		// リクエストを実行
		$curl = curl_init() ;
		curl_setopt( $curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $this->api_key ) ;
		curl_setopt( $curl, CURLOPT_HEADER, true ) ; 
		curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" ) ;
		curl_setopt( $curl, CURLOPT_HTTPHEADER, array( "Content-Type: application/json" ) ) ;
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false ) ;
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true ) ;
		//if( isset($referer) && !empty($referer) ) curl_setopt( $curl, CURLOPT_REFERER, $referer ) ;
		curl_setopt( $curl, CURLOPT_TIMEOUT, 15 ) ;
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $json ) ;
		$res1 = curl_exec( $curl ) ;
		$res2 = curl_getinfo( $curl ) ;
	
	
	
	   //エラーがあった場合には失敗とする
		 if(curl_errno($curl)) {
			return curl_errno($curl) . "Error";
		}

		curl_close( $curl ) ;
	
		// 取得したデータ
		$json = substr( $res1, $res2["header_size"] ) ;
	
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
		$arr = json_decode($json,true);
		
		// 配列の数
		$json_count = count($arr['responses']);
	
		$text=array();
	
		// 出力
		for($i=0;$i <= $json_count-1;$i++){
			if (isset($arr['responses'][$i]['textAnnotations'][0]['description'])) {
				$ocr = new OcrText;
				$ocr->user_id = $this->user_id;
				$ocr->target_dir = $this->target_dir;
				$ocr->img_path = $tmp_image_paths[$i];
				$ocr->ocr_text = $arr['responses'][$i]['textAnnotations'][0]['description'];
				$ocr->save();
			}
		}
	
		return true;
	
	}
}