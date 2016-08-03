<?php 
class counter{ 

/*** our count variable ***/
private static $count = 0;

/**
* Constructor, duh
**/
function __construct() { 
  self::$count++;
} 

/**
*
* get the current count
*
* @access public
*
* @return int
*
**/
public static function getCount() { 
 return self::$count; 
} 

} /*** end of class ***/

/*** create a new instance ***/
$count = new counter(); 
/*** get the count ***/
echo counter::getCount() . '<br />';



/*** create another instance ***/
$next = new counter(); 
/*** echo the new count ***/
echo counter::getCount().'<br />'; 
/*** and a third instance ***/
$third = new counter;
echo counter::getCount().'<br />';