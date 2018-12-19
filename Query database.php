<?php

header("Content-Type: text/plain");
	$output = array();

	@$name =  $_GET['name'];
	@$lname = $_GET['lname'];
	@$code  = $_GET['code'];
	@$title = $_GET['title'];
	@$cross = $_GET['cross'];
	@$major = $_GET['major'];
	
	$tableName = 'test';
	foreach($_REQUEST as $key=>$value ){
		switch($key){
			case 'name'	: $output[] = "`{$tableName}`.`name`  = '{$name}'  OR "; break;
			case 'lname'	: $output[] = "`{$tableName}`.`lname` = '{$lname}'  OR "; break;
			case 'code'	: $output[] = "`{$tableName}`.`code`  = '{$code}' OR "; break;
			case 'title'	: $output[] = "`{$tableName}`.`title` = '{$title}' OR "; break;
			case 'cross'	: $output[] = "`{$tableName}`.`cross` = '{$cross}' OR "; break;
			case 'major'	: $output[] = "`{$tableName}`.`major` = '{$major}'  OR "; break;
		}
	}
		$result = substr($output[0] . @$output[1] . @$output[2] . @$output[3] . @$output[4] . @$output[5], 0, -3);
		echo "SQL RESULT: { $result }";
	
