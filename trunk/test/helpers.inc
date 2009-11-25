<?php
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # Helpers for the function check                                            #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

#======================================================[ Global Variables ]===
$methods  = 0;
$failures = 0;
if ( $_REQUEST["cron"] || (is_array($argv) && in_array("cron",$argv)) ) define("CRON",TRUE);
else define("CRON",FALSE);
$method = "";
$failed = array();
$classname = "";

#======================================================[ Helper functions ]===
# All these functions produce output on condition:
# - cron=1 passed on the URL: plain text, and on failures only
# - otherwise HTML, commenting every single step

function headline($title,$class="") {
  if (!empty($class)) $GLOBALS["classname"] = $class;
  if (!CRON) echo "<H3>$title</H3>\n";
}

function comment($text) {
  if (!CRON) echo "<P>$text</P>\n";
}

function raw($text) {
  if (!CRON) echo $text;
}

function page($title) {
  if (CRON) return;
  echo "<B>Checking $title page:</B><UL>\n";
  flush();
}

function endpage() {
  if (CRON) return;
  echo "</UL>\n<HR>\n";
  flush();
}

function pass() {
  if (CRON) return;
  echo "<SPAN STYLE='color:#0f0;'>PASS</SPAN>";
}

function fail($name) {
  ++$GLOBALS["failures"];
  if (CRON) {
    $GLOBALS["failed"][] = $GLOBALS["classname"] .": $name";
    return;
  }
  echo "<SPAN STYLE='color:#f00;font-weight:bold;'>FAIL</SPAN>";
}

function method(&$class,$name) {
  ++$GLOBALS["methods"];
  if (CRON) return;
  echo " <LI>method $name(): ";
  if ($name=='movies_actress') { // this method somehow behaves strange here and gives false negatives
    $dummy = new imdb_person($class->imdbid());
    $rv = $dummy->movies_actress();
    unset($dummy);
  } else {
    $rv = $class->$name();
  }
  if (empty($rv)||$rv==-1) fail($name);
  else pass();
  echo "</LI>\n";
}

function setid(&$class,$id) {
  if (CRON) return;
  echo " <LI><B>Using IMDBID $id</B></LI>\n";
  $class->setid($id);
}

?>