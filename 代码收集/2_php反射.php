<?php
define('APP_PATH', __DIR__);
define('LOG_PATH', APP_PATH.'/runtime');
require_once APP_PATH."/vendor/autoload.php";

if(!isset($argv[1])){
	echo "you sucks...".PHP_EOL;
	exit(0);
}

$params = require_once APP_PATH."/config/config.php";

App\App::setParams($params);

$command = $argv[1]."Command";
$action = isset($argv[2]) ? $argv[2] : "run";
$action = "action".ucfirst($action);
$command_class = "App\\Commands\\".$command;
try{
	$c = new $command_class();

	//玩一下反射
	$reflector  = new ReflectionClass($c);
	$method = $reflector ->getMethod($action);
	$params = $method->getParameters();

	$p_names = [];
	foreach ($params as $key => $v) {
		$default_v = null;
		if($v->isDefaultValueAvailable()){
			$default_v = $v->getDefaultValue();
		}
		$p_names[$v->getName()] = [
			'postion' => $v->getPosition(),
			'value' => $default_v,
		];
	}

	if(empty($p_names)){

		$c->$action();

	}else{
			// argv 0 文件名  1 脚本名 2 方法名 ...方法参数
			$actionArgs = $argv;
			for($i=0; $i<3; $i++) {
				array_shift($actionArgs);
			}
			foreach ($actionArgs as $a) {
				preg_match("/--([a-zA-z]\w*)=(\w+)/", $a, $ms);
				if(empty($ms) || !isset($ms[2])){
					throw new Exception("args wrong...");
				}
				if(isset($p_names[$ms[1]])){
					$p_names[$ms[1]]['value'] = $ms[2];
				}
			}
		 	$as = [];
		 	foreach ($p_names as $key => $value) {
		 		if($value['value'] === null){
		 			throw new Exception("params: ".$key.", not asigned.eg: --$key=value");
		 		}
		 		$as[] = $value['value'];
		 	}
			call_user_func_array([$c, $action], $as);
	}
	
}catch(Exception $e){
	echo $e->getMessage().PHP_EOL;
}





