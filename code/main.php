<?php
system('clear');
include('address.php');
$url = [
  'bits' => "https://bits.markets-coin.com/doge/",
  'get' => "https://dogeget.xyz/",
  'bnb' => "https://binancefaucet.com/doge/"
  ];
  
  
  $ua[] = "user-agent: Mozilla/5.0 (Linux; Android 9; vivo 1902) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Mobile Safari/537.36";
  $ua[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
  
  function getData($u, $url){
    $ch=curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => 1,
   //  CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_HTTPHEADER => $u,
    CURLOPT_SSL_VERIFYPEER => 0
    )
    );
    $result = curl_exec($ch);
    //$http = curl_getinfo($ch);
    //show_curl_info($http);
    // print_r($result);
    curl_close($ch);
    return $result;
  } // end funct


function takeBits($res){
  $m = explode('</td></tr>', $res);
  for($i=0; $i < count($m)-1; $i++){
   $x[$i] = explode('class="text-break">', $m[$i])[1];
   $wl[$i] = explode('</td><td scope="row">', $x[$i])[0]; 
  //print_r($wl[$i]);  
  }
  return $wl;
}

function filter_arr($arr) {
  $ar = array_unique($arr);
  $array = array_values($ar);
  return $array;
}

function duplicate($arr1, $arr2){
  
  $news = array();
  for($nn=0; $nn < count($arr1); $nn++){
    for($mm=0; $mm < count($arr2); $mm++){
      
      if($arr1[$nn] == $arr2[$mm]){
        $news[$nn][$mm] = "";
      } else {
        $news[$nn][$mm] = $arr1[$nn];
      }
    }
  }
  return $news;
}

function findDuplicates($array1,$array2)
{
    $combined = array_merge($array1,$array2);
    $counted = array_count_values($combined);
    $dupes = [];
    $keys = array_keys($counted);
    foreach ($keys as $key)
    {   
        if ($counted[$key] > 1)
        {$dupes[] = $key;}
    }
    sort($dupes);
    return $dupes;
}


  $doge[1] = getData($ua, $url['bits']);
  $doge[0] = getData($ua, $url['get']);
  $doge[2] = getData($ua, $url['bnb']);
  
  $tkDoge[1] = takeBits($doge[1]);
  $tkDoge[0] = takeBits($doge[0]);
  $tkDoge[2] = takeBits($doge[2]);
  
  $string = preg_replace('/\s+/', '', $address);
  $add = explode(';', $string);
  $count = 0;
  $addr = array();
  for($q=0; $q < count($add); $q++){
    $str[$q] = strlen($add[$q]);
    if($str[$q] > 33) {
      $addr[$count] = $add[$q];
    }
    
    $count++;
  }
  $addrss = array_values($addr);
  
  //print_r();
  echo "\n";
  echo "\n Total Address ".count($addr);
  echo "\n";
  echo "🔻🔸🔻Copy address 🔻🔸🔻\n\n";
  
  
  $vl[0] = filter_arr($tkDoge[1]);
  $vl[1] = filter_arr($tkDoge[0]);
  $vl[2] = filter_arr($tkDoge[2]);
 
$dupes[1] = findDuplicates($vl[1],$addrss);
$dupes[0] = findDuplicates($vl[0],$addrss);
$dupes[2] = findDuplicates($vl[2],$addrss);
  
  $dup[0] = duplicate($vl[0], $dupes[0]);
  $dup[1] = duplicate($vl[1], $dupes[1]);
  $dup[2] = duplicate($vl[2], $dupes[2]);
  
  function hasil($vl, $dup) {
    if(count($dup) > 0) {
  for($r=0; $r < count($vl); $r++) {
    $qg[$r] = array_unique($dup[$r]);
    if(count($qg[$r]) == 1) {
      echo $dup[$r][0].";\n";
    }
  }
    } else {
      for($r=0; $r < count($vl); $r++) {
    //$qg[$r] = array_unique($dup[$r]);
    //if(count($qg[$r]) == 1) {
      echo $vl[$r].";\n";
   // }
  }
    }
  }
  
  
  //echo $url['bits']."\n";
  hasil($vl[0], $dup[0]);
 // echo $url['get']."\n";
  hasil($vl[1], $dup[1]);
  //echo $url['bnb']."\n";
  hasil($vl[2], $dup[2]);
  //print_r($vl[2]);
  //print_r($dupes[2]);
  //print_r(count($dup[2]));
  //print_r($doge[2]);
 //print_r($tkDoge[2]);
  echo "\n";

?>
