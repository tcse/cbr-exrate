<?
/*
=====================================================
 Created by drSpawn (icq 8505350 / mail: cpaun@bk.ru)  - доработки для TCSE реализовал Антон Антонов в 2014 году. Сборка и последующая доработка для DLE 13 и выше - Виталий Чуяков (talik@tcse-cms.com)
-----------------------------------------------------
 Файл: exrate.php
=====================================================
 Назначение: вывод текущего курса валют
=====================================================
*/
if(!defined('DATALIFEENGINE'))
{
  die("Hacking attempt!");
}
	$config['clear_cache'] = 180;
	
	$tpl->result['exrate'] = dle_cache( "exrate", $config['skin'] );
	
	if( ! $tpl->result['exrate'] ) {
	
		$tpl->load_template('assets/cbr-exrate/exrate.tpl');
		//за сегодня
		$today = get_currency (date("d/m/Y")); 
	  $tpl->set('{dollar}', $today[0]);
	  $tpl->set('{euro}', $today[1]);
	  $tpl->set('{byn}', $today[2]);
	  $tpl->set('{kzt}', $today[3]);
	  $tpl->set('{uah}', $today[4]);
	  
	  //на завтра
	  $tom_date = date("d/m/Y", strtotime('+1 DAY'));
	  $tomorrow = get_currency ($tom_dates);
	  if($tomorrow[0] == $today[0] && $tomorrow[1] == $today[1]) {
		$tpl->set_block( "'\\[tommorow\\](.*?)\\[/tommorow\\]'si", "" );
	  } else {
		$tpl->set('{dollar-tommrow}', $tomorrow[0]);
		$tpl->set('{euro-tomorrow}', $tomorrow[1]);
		$tpl->set('{byn-tomorrow}', $tomorrow[2]);
		$tpl->set('{kzt-tomorrow}', $tomorrow[3]);
		$tpl->set('{uah-tomorrow}', $tomorrow[4]);
		$tpl->set('[tommorow]', '');
		$tpl->set('[/tommorow]', '');
	  }
	  
	  $tpl->copy_template = preg_replace_callback ( "#\{(.*?)-date=(.+?)\}#i", "exrate_date", $tpl->copy_template );
	  
	  $tpl->compile('exrate');
	  
	  create_cache( "exrate", $tpl->result['exrate'], $config['skin'] );
 }
	$tpl->clear();
	
  function exrate_date ( $matches=array() ) {
	$date = time();
	if(intval($matches[1])>0) $date += $matches[1]*86000;
	return langdate($matches[2], $date);
}

  function get_currency ($date){
	  $content = get_content($date); 
	  // Разбираем содержимое, при помощи регулярных выражений 
	  $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i"; 
	  preg_match_all($pattern, $content, $out, PREG_SET_ORDER); 
		$currency = array();
	  foreach($out as $cur) 
	  { 
		if($cur[2] == 840) $currency[0] = str_replace(",",".",$cur[4]); 
		if($cur[2] == 978) $currency[1]   = str_replace(",",".",$cur[4]); //978 евро | 933 - бел. рубли
		if($cur[2] == 933) $currency[2]   = str_replace(",",".",$cur[4]);
		if($cur[2] == 398) $currency[3]   = str_replace(",",".",$cur[4]);
		if($cur[2] == 980) $currency[4]   = str_replace(",",".",$cur[4]);
	  }
	return $currency;
  }
  
  function get_content($date) 
  { 
    // Формируем ссылку 
    $link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$date"; 
    // Загружаем HTML-страницу 
    $fd = fopen($link, "r"); 
    $text=""; 
    if ($fd)
    { 
      // Чтение содержимого файла в переменную $text 
      while (!feof ($fd)) $text .= fgets($fd, 4096); 
    } 
    // Закрыть открытый файловый дескриптор 
    fclose ($fd); 
    return $text; 
  }

?>