<pre>
<?php
error_reporting(-1); // tweak this for production
ini_set('display_errors', '0');

echo time_taken();
$str = file_get_contents('4.txt');
$rooms = explode("\n", $str);

foreach ($rooms as $room) {
    list($stuff, $checksum) = explode('[', substr($room, 0, -1));
    $chars = str_replace('-', '', substr($stuff, 0, $pos = strrpos($stuff, '-')));
    $num = substr($stuff, $pos+1);
    $chars = count_chars($chars, 1);
    
    var_export($chars);
    die();
    continue;
    // hqcfqwydw-fbqijys-whqii-huiuqhsx-660[qhiwf]
    preg_match("/([a-z-]+)(\d+)\[([a-z]+)\]/", $room, $m);
    $chars = count_chars(str_replace('-', '', $m[1]), 1);
    arsort($chars);
    var_export($chars);
    die();
}






echo time_taken();


//_____________________________________
// time_taken($tally=0, $precision=5) /
function time_taken($tally=0, $precision=5) {
  static $start = 0; // first call
  static $notch = 0; // tally calls
  static $time  = 0; // set to time of each call (after setting $duration)
  $now = microtime(1);
  if (! $start) { // init, basically
    $time = $notch = $start = $now;
    return "Starting at $start.\n";
  }
  $duration = $now - $time;
  $time = $now;
  $out = "That took ".round($duration, $precision)." seconds.";
  if ($tally) { // time passed since last tally
    $since_start      = $now - $start;
    $since_last_notch = $now - $notch;
    $notch = $now;
    $out .= "<br>\n". round($since_start, $precision) .' seconds since start'.($since_start!=$since_last_notch ? ' ('.round($since_last_notch, $precision) .' since last sum).':'.');
  }
  return $out."\n";
}


?>