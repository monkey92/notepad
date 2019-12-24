<?php



function formatInsertSql($table, $rows){
		$sql = "insert into $table ";
		$first_row = $rows[0];
		$fields = array_keys($first_row);
		$fields_str = "(". implode(", ", $fields) . ")";
		$v = "(" . implode(", ",array_map(function($v){
			$v = addslashes($v);
			return '"'.$v.'"';
		}, array_values($first_row))) . ")";
		for ($i = 1; $i < count($rows) ; $i++) {
			$row = $rows[$i];
			$v .= ",(" . implode(", ",array_map(function($v){
				$v = addslashes( $v);
				return '"'.$v.'"';
			}, array_values($row))) . ")";
		}
		$sql .= $fields_str. " values ". $v;
		return $sql;
}
