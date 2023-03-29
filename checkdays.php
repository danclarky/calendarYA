<?php
	require_once __DIR__ . '/simpleCalDAV/SimpleCalDAVClient.php';
	
	function getBetween($string, $start = "", $end = ""){
    if (strpos($string, $start)) { // required if $start not exist in $string
	$startCharCount = strpos($string, $start) + strlen($start);
	$firstSubStr = substr($string, $startCharCount, strlen($string));
	$endCharCount = strpos($firstSubStr, $end);
	if ($endCharCount == 0) {
	$endCharCount = strlen($firstSubStr);
	}
	return substr($firstSubStr, 0, $endCharCount);
    } else {
	return '';
    }
	}
	
	$client = new SimpleCalDAVClient();
	$client->connect('https://caldav.yandex.ru/', 'user@ya.ru', 'pass');
	$arrayOfCalendars = $client->findCalendars();
	$client->setCalendar($arrayOfCalendars['events-9005337']);
	
	$arrayOfCalendar = $client->getEvents($_POST['data'].'Z', $_POST['data1'].'Z');

	$str="";
	foreach ($arrayOfCalendar as $color) {
		$start = preg_replace("/[^0-9]/", '',getBetween(getBetween(serialize($color), 'BEGIN:VEVENT', 'END:VEVENT'),'DTSTART','DTEND'));
		$end = preg_replace("/[^0-9]/", '',getBetween(getBetween(serialize($color), 'BEGIN:VEVENT', 'END:VEVENT'),'DTEND','SUMMARY'));
		$start = strtotime($start);
		$end = strtotime($end);
		
		$time = strtotime("+30 minutes", $start);
		$timenorm = date('YmdHis',strtotime("+30 minutes", $start));
		
		$startnorm = date('YmdHis',$start);
		$end= date('YmdHis',$end);
	
		if(date('Hi',$start)<='1630' and date('Hi',$start)>='0900' and date('Hi',$start)!='1300' and date('Hi',$start)!='1330'){$str = $str.$startnorm.";";}

		if ($timenorm<$end and date('Hi',$time)<='1630' and date('Hi',$time)>='0900' and date('Hi',$time)!='1300' and date('Hi',$time)!='1330'){$str = $str.$timenorm.';';}
		
		while ($timenorm<$end)
		{
			$time =  strtotime("+30 minutes", $time);
			$timenorm = date('YmdHis',$time);
			if(date('Hi',$time)<='1630' and date('Hi',$time)>='0900' and date('Hi',$time)!='1300' and date('Hi',$time)!='1330')
			{
				$str = $str.$timenorm.';';
			}
		}	
	} 
	echo $str;
?>
