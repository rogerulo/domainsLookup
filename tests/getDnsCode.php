<?php
// error_reporting(0);
 $result = dns_get_record("cbssports.com");
 print(json_encode($result)) . "\n";
// print_r($result);
// foreach($result as $dr){
    // print(json_encode($result)) . "\n";
// }
// print_r($result);
// echo sizeof($result);
// echo "\n";
