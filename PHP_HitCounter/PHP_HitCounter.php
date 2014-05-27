<?php
/**
 * Plugin Name: PHP HitCounter
 * Plugin URI: https://github.com/obiwanakin/turbo-nemesis/tree/master/PHP_HitCounter
 * Description: This plugin logs the total number of hits to a WP site.
 * Version: 1.0.0
 * Author: Benjamin A. Lippincott
 * Author URI: http://phatlipp.dnsdynamic.com
 * License: GPL2
 */

function checkForCookie()
{
	$cookieCheck = setcookie("PHP HitCounter");
	return $cookieCheck;
}

function incrementCounter()
{
	$increment = $wpdb->query("UPDATE  `hitcounter` SET  `hits` =  `hits` +1;");
}
function readCounter()
{
	/* $numberOfHits = $wpdb->get_results("SELECT `hits` FROM `hitcounter` WHERE 1;");
	return $numberOfHits; */
	$myText = "Here's some test text!";
	return $myText;
}

function mainFunction(){

	$cookieCheck = checkForCookie();

	if ($cookieCheck = true){
		return;
	}

	else{
		incrementCounter();
	}

	$numberOfHits = readCounter();
	echo "<p id='hit'>$numberOfHits</p>";
}

add_action( 'get_sidebar', 'mainFunction');

function hit_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#hit {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'wp_sidebar', 'hit_css');


/*EOF*/