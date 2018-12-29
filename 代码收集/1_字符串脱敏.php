<?php

/**
 * 字符串脱敏
 * @param $str
 * @param $offset
 * @param $length
 * @param string $replace
 * @return string
 */
function deSensitive($str, $offset, $length, $replace="*"){
	preg_match_all('/./u', $str, $arr);
	$arr = $arr[0];
	$replace = implode(array_pad([], $length, $replace));
	array_splice($arr, $offset, $length, $replace);
	return implode('', $arr);
}