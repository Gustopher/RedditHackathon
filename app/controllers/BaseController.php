<?php

class BaseController extends Controller {

	protected static $isJsonRequest = false;

	public function __construct() {
		self::$isJsonRequest = Input::has('response-type') && Input::get('response-type') === 'json' ? true : false;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public static function isJsonRequest() {
		return self::$isJsonRequest;
	}

}