<?php
function randomNumber($length) {
	$result = '';

	for($i = 0; $i < $length; $i++) {
		$result .= mt_rand(0, 9);
	}

	return $result;
}

echo randomNumber(12);