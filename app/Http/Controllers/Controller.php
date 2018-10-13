<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function artisan($cmd)
    {
        switch ($cmd) {
            case 'dbmigrate': //マイグレーション
                $exit = \Artisan::call('migrate', [
                        '--force' => true,
                    ]);
                break;
            case 'dbrollback': //ロールバック
                $exit = \Artisan::call('migrate:rollback', [
                    '--force' => true,
                ]);
                break;
            case 'storage': //public/storage→storage/app/publicにシンボリックリンク作成
                $exit = \Artisan::call('storage:link');
                break;
            case 'down': //メンテナンスモード有効(メンテナンスモードの適用対象に制限をかけないと復帰できなくなります)
                $exit = \Artisan::call('down');
                break;
            case 'up': //メンテナンスモード無効
                $exit = \Artisan::call('up');
                break;
            case 'cache': //キャッシュ全消去
                $exit = \Artisan::call('cache:clear');
                break;
            default:
                return view('welcome');
                break;
        }

        return dd($exit);
    }

}
