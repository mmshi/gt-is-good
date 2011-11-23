<?php

$DEFAULT_CSS_CLASS = "H";
$DEFAULT_ONCLICK_METHOD = "ats(this)";

function generatePersistantCalendarHalfEdit($tableNumber = 0, $start, $numOfDays = 7, $startHours = 0, $endHour = 24, $strOfAvailibility) {
	if (!$start)
		$start = Date('Y-m-d');
	$start = getPreviousSunday($start);
	
	$arrayOfAvailibility = getAvailibilityArrayHalf($strOfAvailibility, $numOfDays, $endHour - $startHours);
	
	$str = '<table><tr>';
	for($d=0;$d<$numOfDays;$d++) {
		$str .= getDateHeader(date('Y-m-d', strtotime("+$d days", strtotime($start))), $d);
	}
	$str .= '</tr>';
	$h=$startHours;
	$halfToggle = 0;
	for(;$h<$endHour*2;$h++) {
		$str .= '<tr>';
		for($d=0;$d<$numOfDays;$d++) {
			$str .= getTimeCell($tableNumber, $h, $d, $h>>1, $arrayOfAvailibility, $halfToggle);
		}
		$str .= '</tr>';
		$halfToggle = $halfToggle ? 0 : 1;
	}
	return $str . '</table>';
}

function generatePersistantCalendarOneEdit($tableNumber = 0, $start, $numOfDays = 7, $startHours = 0, $endHour = 24, $strOfAvailibility) {
	if (!$start)
		$start = Date('Y-m-d');
	$start = getPreviousSunday($start);
	
	$arrayOfAvailibility = getAvailibilityArrayOne($strOfAvailibility, $numOfDays, $endHour - $startHours);
	
	$str = '<table><tr>';
	for($d=0;$d<$numOfDays;$d++) {
		$str .= getDateHeader(date('Y-m-d', strtotime("+$d days", strtotime($start))), $d);
	}
	$str .= '</tr>';
	$h=$startHours;
	for(;$h<$endHour;$h++) {
		$str .= '<tr>';
		for($d=0;$d<$numOfDays;$d++) {
			$str .= getTimeCell($tableNumber, $h, $d, $h, $arrayOfAvailibility);
		}
		$str .= '</tr>';
	}
	return $str . '</table>';
}

function generatePersistantCalendarOneResults($start, $numOfDays = 7, $startHours = 0, $endHour = 24, $arraysOfAvailibilities) {
	if (!$start)
		$start = Date('Y-m-d');
	$start = getPreviousSunday($start);
	
	$arrayOfResults = mergeAvailibilityArrayOne($arraysOfAvailibilities, $numOfDays, $endHour - $startHours);
	
	$str = '<table><tr>';
	for($d=0;$d<$numOfDays;$d++) {
		$str .= getDateHeader(date('Y-m-d', strtotime("+$d days", strtotime($start))), $d);
	}
	$str .= '</tr>';
	$h=$startHours;
	for(;$h<$endHour;$h++) {
		$str .= '<tr>';
		for($d=0;$d<$numOfDays;$d++) {
			$str .= getTimeCellResults($h, $d, $h, $arrayOfResults);
		}
		$str .= '</tr>';
	}
	return $str . '</table>';
}

/*private*/ function getPreviousSunday($date) {
	$d = date("D", strtotime($date));
	if ($d == "Sun")
		return $date;
	if ($d == "Mon")
		return date('Y-m-d', strtotime("-1 days", strtotime($date)));
	if ($d == "Tue")
		return date('Y-m-d', strtotime("-2 days", strtotime($date)));
	if ($d == "Wed")
		return date('Y-m-d', strtotime("-3 days", strtotime($date)));
	if ($d == "Thu")
		return date('Y-m-d', strtotime("-4 days", strtotime($date)));
	if ($d == "Fri")
		return date('Y-m-d', strtotime("-5 days", strtotime($date)));
	if ($d == "Sat")
		return date('Y-m-d', strtotime("-6 days", strtotime($date)));
}

/*private*/ function getTimeCell($tableNumber ,$row, $col, $hour, $arrayOfAvailibility, $halfToggle=0) {
	global $DEFAULT_ONCLICK_METHOD;
	return "<td id=\"$row-$col-$tableNumber\"onclick=\"$DEFAULT_ONCLICK_METHOD\"class=\"" . $arrayOfAvailibility[$row][$col] . "\">" . 
		($hour ? $hour : '12') . ":" . ($halfToggle ? '30' : '00') . '</td>';
}

/*private*/ function getTimeCellResults($row, $col, $hour, $arrayOfResults, $halfToggle=0) {
	global $DEFAULT_ONCLICK_METHOD;
	return "<td bgcolor=\"#" . $arrayOfResults[$row][$col] . "\">" . 
		($hour ? $hour : '12') . ":" . ($halfToggle ? '30' : '00') . '</td>';
}

/*private*/ function getDateHeader($date, $col) {
	return "<th id=\"d-$col\"class=\"dH\">". date("D", strtotime($date)) .'</th>';
}

/*private*/ function getAvailibilityArrayHalf($strOfAvailibility, $numOfDays, $numOfHours) {
	global $DEFAULT_CSS_CLASS;
	$arr = array();
	$len = strlen($strOfAvailibility);
	for ($row=0;$row<$numOfHours * 2;$row++){
		$arr[$row] = array();
		for($col=0;$col<$numOfDays;$col++) {
			$i = $row + ($numOfHours * $col * 2);
			$arr[$row][$col] = $i < $len && $strOfAvailibility[$i] ? $strOfAvailibility[$i] : $DEFAULT_CSS_CLASS;
		}
	}
	return $arr;
}

/*private*/ function getAvailibilityArrayOne($strOfAvailibility, $numOfDays, $numOfHours) {
	global $DEFAULT_CSS_CLASS;
	$arr = array();
	$len = strlen($strOfAvailibility);
	for ($row=0;$row<$numOfHours;$row++){
		$arr[$row] = array();
		for($col=0;$col<$numOfDays;$col++) {
			$i = $row + ($numOfHours * $col);
			$arr[$row][$col] = $i < $len && $strOfAvailibility[$i] ? $strOfAvailibility[$i] : $DEFAULT_CSS_CLASS;
		}
	}
	return $arr;
}

/*private*/ function mergeAvailibilityArrayOne($arrayOfAvailibilities, $numOfDays, $numOfHours) {
	global $DEFAULT_CSS_CLASS;
	$arr = array();
	$count = count($arrayOfAvailibilities);
	for ($row=0;$row<$numOfHours;$row++){
		$arr[$row] = array();
		for($col=0;$col<$numOfDays;$col++) {
			$arr[$row][$col] = 0;
		}
	}
	for ($user=0;$user<$count;$user++) {
		$len = strlen($arrayOfAvailibilities[$user]);
		for ($row=0;$row<$numOfHours;$row++){
			for($col=0;$col<$numOfDays;$col++) {
				$i = $row + ($numOfHours * $col);
				$arr[$row][$col] += ($i < $len && $arrayOfAvailibilities[$user][$i]) ? getCssClassValue($arrayOfAvailibilities[$user][$i]) : $DEFAULT_CSS_CLASS;
			}
		}
	}
	$count = $count ? $count : 1;
	for ($row=0;$row<$numOfHours;$row++){
		for($col=0;$col<$numOfDays;$col++) {
			$arr[$row][$col] = convertColor($arr[$row][$col] / $count / 4);
		}
	}
	return $arr;
}

/*private*/ function getCssClassValue($val) {
	return ($val == "H") ? 0 : (($val == "B") ? 1 : (($val == "G") ? 2.5 : 3));
}

/*private*/ function convertColor($cellScore) {
	//echo $cellScore . "<br />";
	$cellScore = (int)($cellScore * 255);
	//echo "&emsp;" . $cellScore . "&emsp;:&emsp;" . dechex((255-($cellScore<56?0:$cellScore)<<16)+(($cellScore>200?255:$cellScore)<<8));
	return dechex((255-($cellScore<56?0:$cellScore)<<16)+(($cellScore>200?255:$cellScore)<<8));
}

function printFormatted($obj) {
	echo '<br /><br /><pre>';
	print_r($obj);
	echo '</pre>';
}

//printFormatted(getAvailibilityArrayOne("HHHHHHHHHHBBBBBBBBBBOOOOOOOOOO", 3, 5));

//$arr = array();
//$arr[] = "HHHHBBBBGGGGAAAA";
//$arr[] = "HBGAHBGAHBGAHBGA";
//printFormatted(mergeAvailibilityArrayOne($arr, 4, 4));

//generatePersistantCalendar($tableNumber = 0, $start, $numOfDays = 7, $startHours = 0, $endHour = 24, $strOfAvailibility)
//echo generatePersistantCalendarOneEdit(0, 0, 7, 0, 24, "HHHHHHHHHHBBBBBBBBBBOOOOOOOOOO");

$arr = array();
$arr[] = "HHHHBBBBGGGGAAAA";
$arr[] = "HBGAHBGAHBGAHBGA";
//$arr[] = "BGAHBGAHBGAHBGAH";
//$arr[] = "AAAAAAAAGGGGAAAA";
//$arr[] = "BBBBBAAAAAGGBBAA";
echo generatePersistantCalendarOneResults(0, 7, 0, 24, $arr);
?>