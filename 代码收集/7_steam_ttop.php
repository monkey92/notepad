<?php

function getCode($shared_secret){
	$key = base64_decode($shared_secret);
	$data = pack("NN", 0, floor(time() / 30));
	$byte_array = array_values(unpack("C*", hash_hmac("sha1", $data, $key, true)));
	$start = $byte_array[19] & 0x0F;
	$codePoint =  ($byte_array[$start] & 0x7F) << 24 |
	($byte_array[$start+1] & 0xfF) << 16 |
	($byte_array[$start+2] & 0xfF) << 8 |
	($byte_array[$start+3] & 0xFF);
	$s = "23456789BCDFGHJKMNPQRTVWXY";
	$code = "";
	for ($i = 0; $i < 5; $i++) {
	    $code .= $s[$codePoint % strlen($s)];
	    $codePoint /= strlen($s);
	}
	return $code;
}



