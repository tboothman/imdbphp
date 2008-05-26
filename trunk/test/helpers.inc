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

$methods  = 0;
$failures = 0;

function page($title) {
  echo "<B>Checking $title page:</B><UL>\n";
  flush();
}

function endpage() {
  echo "</UL>\n<HR>\n";
  flush();
}

function pass() {
  echo "<SPAN STYLE='color:#0f0;'>PASS</SPAN>";
}

function fail() {
  echo "<SPAN STYLE='color:#f00;font-weight:bold;'>FAIL</SPAN>";
  ++$GLOBALS["failures"];
}

function method(&$class,$name) {
  echo " <LI>method $name(): ";
  $rv = $class->$name();
  if (empty($rv)) fail();
  else pass();
  echo "</LI>\n";
  ++$GLOBALS["methods"];
}

function setid(&$class,$id) {
  echo " <LI><B>Using IMDBID $id</B></LI>\n";
  $class->setid($id);
}

?>