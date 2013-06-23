<?php

class HomeController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('auth', ['only' => ['getLogout']]);
		$this->beforeFilter('guest', ['only' => ['getActivate', 'postLogin', 'postRegister']]);
		$this->beforeFilter('csrf', ['only' => ['postLogin', 'postRegister']]);
	}

	public function getIndex() {
		return ! Sentry::check() ? View::make('home.default')->with('title', 'Hackit') : View::make('home.user')->with('title', 'Hackit'); 
	}

	public function postLogin() {
		return User::login(Input::get());
	}

	public function getRegister() {
		return View::make('user.register')->with('title', 'Hackit - Sign Up!');
	}

	public function postRegister() {
		return User::register(Input::get());
	}

	public function getThanks() {
		return View::make('thanks')->with('title', 'Hackit - Thanks');
	}

	public function getActivate() {

		if( Input::has('acode') )
			return User::activate(Input::get('acode'));

		return View::make('user.activate')->with('title', 'Hackit - Activate');
	}

	public function getLogout() {
		Sentry::logout();
		return Redirect::to('/');
	}

}