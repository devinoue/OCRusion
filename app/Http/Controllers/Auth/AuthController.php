<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Socialite;
use App\User;

class AuthController extends Controller
{
    public function redirecToProvider($provider) {
    	return Socialite::driver($provider)->redirect();
    }
    //ソーシャル 認 証 後 の 処 理 （セッションにデータを 預 けたり）
    public function handleProviderCallback($provider) {
		$user;
		if ($provider == 'google')  {
			$user = Socialite::driver('google')->stateless()->user();
		} else {
            $user = Socialite::driver($provider)->user();
        }
    	$authUser = $this->findOrCreateUser($user, $provider);

    	Auth::login($authUser, true); //Auth にソーシャル 情 報 を 預 けてログイン
    	return redirect('/dashboard');//★★ 認 証 後 に 表示 したいページを 指定 ★★
    }
    //ユーザー 追加 ＆ ユーザーデータ 取得
    public function findOrCreateUser($user, $provider) {
    	$authUser = User::where('provider_id', $user->id)->first();
		if ($authUser) {
			return $authUser;
		}
		return User::create([
			'name' => $user->name,
			'email' => $user->email,
			'provider' => $provider,
			'provider_id' => $user->id
		]);
	}



}