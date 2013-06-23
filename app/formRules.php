<?php

Validator::extend('age', function($attr, $value, $params) {
	return $value > 15 && $value < 71;
});