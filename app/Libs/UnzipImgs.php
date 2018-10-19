<?php

namespace App\Libs;
/**
 * ZipArchiveのラッパークラス
 * 画像形式のファイルか判断し、ナンバリングする。
 */
class UnzipImgs
{
	
	public $path=Null;
	public $imageNum = Null;
	public $imageList = Null;
	private $destroy_mode = Null;

	/**
	 * @constructor
	 *
	 * @param string $zip_path	解凍したいzipファイルの相対パス
	 * @param boolean $destroy_mode 解凍後、trueならzipファイルを削除する(デバッグ用にfalseを使う)
	 */
	function __construct($zip_path,$destroy_mode=false)
	{
		$this->path = $zip_path;
		$this->imageNum = 0;
		$this->destroy_mode = $destroy_mode;
	}

	/**
	 * 解凍用メソッド
	 *
	 * @param string $new_dir_name 保存用ディレクトリの名前
	 * @return mixed 正常に終了すればtrueが返ってくるが、それ以外はエラーメッセージが返る。
	 */
	function unzip ($new_dir_name,$strict_check=0)
	{
		$tmp_dir = uniqid();

		// 新規保存するディレクトリが存在するかチェックする
		if (!file_exists($new_dir_name)) {
			mkdir($new_dir_name);
		}

		// 一時保存ディレクトリが存在するかチェックする
		if (!file_exists($tmp_dir)) {
			mkdir($tmp_dir);
		}

		$zip = new \ZipArchive();
		$res = $zip->open($this->path);

		if($res === true){
			$zip->extractTo($tmp_dir);
			$zip->close();
		} else {
			return "Error. Can't unzip.";
		}
		if ($this->destroy_mode) {
			unlink($this->path);
		}

		// ファイルのパスを保存する
		if ($handle = opendir($tmp_dir)) {
			while (false !== ($file = readdir($handle))) {
				if ( $file != "." && $file != ".." ) {
					$tmp_files[] = $file;
				}
			}
			closedir($handle);
		}
		if (count ($tmp_files) === 0) {
			return "Error. No file exits.";
		}

		// 昇順でソート
		natcasesort($tmp_files);
		$img_flag=0;
		foreach ($tmp_files as $file) {

			$target = $tmp_dir . "/" . $file;
			// ディレクトリなら
			if (is_dir($target)) {
				$sub_files=scandir($target);
		
				//ファイル数をチェック
				$count=count($sub_files) - 2;//余計なドットを弾いている。
				
				foreach ($sub_files as $sub_file) {
					if ( $sub_file == "." || $sub_file == ".." ) continue;
					
					$sub_file_path = $target . "/" . $sub_file;

					// 画像ファイルか適切かチェック
					if (!$ext = $this->isValidImage($sub_file_path)){
						if ($this->destroy_mode) {
							//画像以外は削除してコンティニュー
							unlink($sub_file_path);
							continue;
						} else {
							continue;
						}
					}
					$this->imageNum++;

					$new_file_name = sprintf('%04d', $this->imageNum) . "." . $ext;
					$this->imageList[] = $new_file_name;
					// 移動
					rename($sub_file_path, $new_dir_name . "/" . $new_file_name);
					chmod($new_dir_name . "/" .   $new_file_name, 0644);

				}
			
			} else {
				//すぐにファイルなら、画像ファイルかどうかチェック
				$file_path = $target;

				// 画像ファイルか適切かチェック
				if (!$ext = $this->isValidImage($file_path)){
					if ($this->destroy_mode) {
						//画像以外は削除してコンティニュー
						unlink($file_path);
						continue;
					} else {
						continue;
					}
				}

				$this->imageNum++;
				
				$new_file_name = sprintf('%04d', $this->imageNum) . "." . $ext;
				$this->imageList[] = $new_file_name;
				// 移動
				rename($file_path, $new_dir_name . "/" .  $new_file_name);
				chmod($new_dir_name . "/" .   $new_file_name, 0644);

			}
		
	
		}
		if (file_exists($tmp_dir)) {
			$this->remove_directory($tmp_dir);
		}
		return true;
	}
	/**
	 * 妥当な画像か判断
	 *
	 * @param string $file 判断するファイルへの相対パス
	 * @return boolean	画像と判断されれば拡張子が返される。それ以外ならfalseが返る
	 */
	public function isValidImage($file)
	{
		$check_ext = [
			'gif' => 'image/gif',
			'jpg' => 'image/jpeg',
			'png' => 'image/png',
			];

		if (!$mime = array_search(mime_content_type($file),$check_ext,true)){
			return false;
		}

		$getExt = explode('.', $file);
		$ext = strtolower(end($getExt));

		if ($ext == 'jepg') $ext = 'jpg';

		if ($mime == $ext){
			return $ext;
		} else {
			return false;
		}
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

/*
$imgZip = new UnzipImgs('./c.zip',true);
$target_dir = './tmp/' . 123;
$result = $imgZip->unzip($target_dir);
print $result;
*/
