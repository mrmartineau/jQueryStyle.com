<?php
header("Cache-Control: no-cache");
header("Pragma: nocache");

include_once 'textpattern/config.php';
include_once 'textpattern/lib/constants.php';
include_once 'textpattern/lib/txplib_db.php';
include_once 'textpattern/lib/txplib_misc.php';
	
$tableName="txp_ratings";
//getting the values
$vote = explode(":",base64_decode($_REQUEST['v']));

//base64_encode("$ncount:$id:$ip:$units:$unitwidth")
$vote_sent=$vote[0];
$id=$vote[1];
$ip_num=$vote[2];
$units=$vote[3];
$unitwidth=$vote[4];



$ip = $_SERVER['REMOTE_ADDR'];

//connecting to the database to get some information
$numbers=safe_row("total_votes, total_value, used_ips", $tableName, "id = $id");
extract($numbers);
$checkIP = unserialize($used_ips);

$count = $total_votes; //how many votes total
$current_rating = $total_value; //total number of rating added together and stored
$sum = $vote_sent+$current_rating; // add together the current vote value and the total vote value
$tense = ($count==1) ? "vote" : "votes"; //plural form votes/vote


// checking to see if the first vote has been tallied
// or increment the current number of votes
($sum==0 ? $added=0 : $added=$count+1);

// if it is an array i.e. already has entries the push in another value

if(is_array($checkIP)){
	if(!in_array($ip_num,$checkIP)){
		array_push($checkIP,$ip_num);
		$voted_before=false;
	}
	else 
		$voted_before=true;
}
else 
$checkIP=array($ip_num);


$insertip=serialize($checkIP);

if (!$voted_before && ($vote_sent >= 1 && $vote_sent <= $units) && ($ip == $ip_num)) { // keep votes within range, make sure IP matches - no monkey business!
	safe_update($tableName, "total_votes='".$added."', total_value='".$sum."', used_ips='".$insertip."'", "id='$id'"); 


// these are new values!
$count = $added;//how many votes total
$current_rating = $sum;//total number of rating added together and stored
$tense = ($count==1) ? "vote" : "votes"; //plural form votes/vote

$new_back = 
"<ul class=\"unit-rating\" style=\"width:". $units*$unitwidth ."px;\">\n".
"<li class=\"current-rating\" style=\"width:". @number_format($current_rating/$count,2)*$unitwidth ."px;\">Current rating.</li>\n".
"<li class=\"r1-unit\">1</li>\n".
"<li class=\"r2-unit\">2</li>\n".
"<li class=\"r3-unit\">3</li>\n".
"<li class=\"r4-unit\">4</li>\n".
"<li class=\"r5-unit\">5</li>\n".
"<li class=\"r6-unit\">6</li>\n".
"<li class=\"r7-unit\">7</li>\n".
"<li class=\"r8-unit\">8</li>\n".
"<li class=\"r9-unit\">9</li>\n".
"<li class=\"r10-unit\">10</li>\n".
"</ul>".
"<p class=\"voted\">Rating: <strong>".@number_format($sum/$added,1)."</strong>/".$units." (".$count." ".$tense." cast) ".
"<span class=\"thanks\">Thanks for voting!</span></p>";//show the updated value of the vote


//name of the div id to be updated | the html that needs to be changed
$output = "unit_long$id|$new_back";
}
else {
	
$tense = ($count==1) ? "vote" : "votes"; //plural form votes/vote

$new_back = 
"<ul class=\"unit-rating\" style=\"width:". $units*$unitwidth ."px;\">\n".
"<li class=\"current-rating\" style=\"width:". @number_format($current_rating/$count,2)*$unitwidth ."px;\">Current rating.</li>\n".
"<li class=\"r1-unit\">1</li>\n".
"<li class=\"r2-unit\">2</li>\n".
"<li class=\"r3-unit\">3</li>\n".
"<li class=\"r4-unit\">4</li>\n".
"<li class=\"r5-unit\">5</li>\n".
"<li class=\"r6-unit\">6</li>\n".
"<li class=\"r7-unit\">7</li>\n".
"<li class=\"r8-unit\">8</li>\n".
"<li class=\"r9-unit\">9</li>\n".
"<li class=\"r10-unit\">10</li>\n".
"</ul>".
"<p class=\"voted\">Rating: <strong>".@number_format($current_rating/($added-1),1)."</strong>/".$units." (".$count." ".$tense." cast) ".
"<span class=\"thanks\">You ($ip_num) have voted before!</span></p>";//show the updated value of the vote


//name of the div id to be updated | the html that needs to be changed
$output = "unit_long$id|$new_back";
	
	
}

echo $output;
//print_r($vote);
//echo mysql_error();
?>