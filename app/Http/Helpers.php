<?php

function translateToGerman($month) {
  switch($month) {
    case "January":
        return "Januar";
    case "February":
        return "Februar";
    case "March":
        return "März";
    case "April":
        return "April";
    case "May":
        return "Mai";
    case "June":
        return "Juni";
    case "July":
        return "Juli";
    case "August":
        return "August";
    case "September":
        return "September";
    case "October":
        return "Oktober";
    case "November":
        return "November";
    case "December":
        return "Dezember";
  }
  return $month;
}

function translateToEnglish($month) {
  switch($month) {
    case "Januar":
        return "January";
    case "Februar":
        return "February";
    case "März":
        return "March";
    case "April":
        return "April";
    case "Mai":
        return "May";
    case "Juni":
        return "June";
    case "Juli":
        return "July";
    case "August":
        return "August";
    case "September":
        return "September";
    case "Oktober":
        return "October";
    case "November":
        return "November";
    case "Dezember":
        return "Dezcember";
  }
  return $month;
}

function get_string_between($string, $start, $end) {
	$string = " ".$string;
	$ini = strpos($string, $start);
	if($ini == 0) {
    return "";
  }
	$ini += strlen($start);
	$len = strpos($string, $end, $ini) - $ini;
	return substr($string, $ini, $len);
}

function get_artist_information($artist) {
  $url = "https://en.wikipedia.org/w/api.php?action=query&prop=revisions&rvprop=content&format=json&titles='.$artist.'&rvsection=0";
  $myURL = 'https://en.wikipedia.org/w/api.php?';
  $options = array("action" => "query", "prop" => "revisions", "rvprop" => "content", "format" => "json", "titles" => $artist, "rvsection" => "0");
  $myURL .= http_build_query($options, '' , '&');
  $json = file_get_contents($myURL);
  //$json = file_get_contents($url);

  preg_match("/(?=\{Infobox)(\{([^{}]|(?1))*\})/", $json, $new);
  $tagss = explode('\\n| ', $new[0]);
  $array = array();
  for($i = 0; $i < count($tagss); $i++) {
    if(strpos($tagss[$i], 'origin') !== false) {
      $temp = explode(' = ', $tagss[$i]);
      $toDelete = array('[[', ']]', '|', 'URL', '{{', '}}', '*', 'flatlist');
      $temp = str_replace($toDelete, '', $temp);
      $temp[0] = 'Origin';
      array_push($array, $temp);
    }
    if(strpos($tagss[$i], 'label') !== false) {
      $temp = explode(' = ', $tagss[$i]);
      $labels = array();
      while(strpos($temp[1], '[[') !== false) {
        $label = get_string_between($temp[1], '[[', '|');
        $temp[1] = str_replace_first('[[', '', $temp[1]);
        array_push($labels, $label);
      }
      $temp[0] = 'Label';
      $temp[1] = $labels;
      array_push($array, $temp);
    }
  }
  return $array;
}
