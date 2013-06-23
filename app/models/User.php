<?php

class User extends Eloquent {

	public static function login($info) {

		$validator = Validator::make($info, [
			'email' => 'required|email',
			'password' => 'required|min:6'
		]);

		if( $validator->fails() )
			return Redirect::to('/')->withErrors($validator->messages());

		try {

			$user = Sentry::authenticate([
				'email' => $info['email'],
				'password' => $info['password']
			], true);

			return Redirect::to('/');

		} catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
			
			return Redirect::to('/')->withErrors(['Please enter an email address!']);

		} catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
			
			return Redirect::to('/')->withErrors(['Please enter a password!']);

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			
			return Redirect::to('/')->withErrors(['A user with those details does not exist!']);

		} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
			
			return Redirect::to('/')->withErrors(['Wrong email or password!']);

		} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {

			return Redirect::to('/')->withErrors(['You must activate your account before logging in!']);

		} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
			
			return Redirect::to('/')->withErrors(['This account has been suspended!']);

		} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
			
			return Redirect::to('/')->withErrors(['This account has been banned!']);

		}

	}

	public static function register($info) {

		$validator = Validator::make($info, [
			'email' => 'email|required|max:255|min:4|unique:users',
			'password' => 'required|min:6',
			'username' => 'required|min:3|max:18|unique:users',
			'age' => 'required|numeric|between:13,70',
			'first_name' => 'required',
			'last_name' => 'required'
		]);

		if( $validator->fails() )
			return Redirect::action('HomeController@getRegister')->withErrors($validator->messages());

		try {

			$user = Sentry::register([
				'email' => $info['email'],
				'password' => $info['password'],
				'username' => $info['username'],
				'age' => $info['age'],
				'first_name' => $info['first_name'],
				'last_name' => $info['last_name']
			]);

			$activationCode = $user->getActivationCode();

			Event::fire('user.register', [$user, $activationCode]);

			return Redirect::action('HomeController@getThanks');

		} catch(Cartalyst\Sentry\Users\LoginRequiredException $e) {

			return Redirect::action('HomeController@getRegister')->withErrors(['Please enter an email address!']);

		} catch(Cartalyst\Sentry\Users\PasswordRequiredException $e) {

			return Redirect::action('HomeController@getRegister')->withErrors(['Please enter a password!']);

		} catch(Cartalyst\Sentry\Users\UserExistsException $e) {

			return Redirect::action('HomeController@getRegister')->withErrors(['A user with those details already exists!']);

		}

	}

	public static function activate($acode) {

		$user = self::where('activation_code', $acode)->first();

		if( is_null($user) )
			return Redirect::action('HomeController@getActivate')->withErrors(['We could not find you in our database!']);

		try {

			$user = Sentry::getUserProvider()->findById($user->id);

			if($user->attemptActivation($acode))
				return Redirect::to('/');
			else
				return Redirect::action('HomeController@getActivate')->withErrors(['We failed to activate your account!']);

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			
			return Redirect::action('HomeController@getActivate')->withErrors(['We could not find you in our database!']);

		} catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e) {

			return Redirect::to('/');

		}

	}

}