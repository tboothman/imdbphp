<?php
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 # ------------------------------------------------------------------------- #
 # Class provided by Pablo Castorino <pablo AT castorinop DOT com DOT ar>    #
 # For details, see http://projects.izzysoft.de/trac/imdbphp/wiki/imdbXML    #
 #############################################################################
 /* $Id$ */

// include class file
require_once("XML/Serializer.php");

/** XML Generation
 * @package IMDB
 * @class imdbXML
 * @extends XML_Serializer
 * @author Pablo Castorino (pablo AT castorinop DOT com DOT ar)
 * @author Izzy (izzysoft AT qumran DOT org) (Documentation)
 * @copyright (c) 2008-2011 by Pablo Castorino, Itzchak Rehberg and IzzySoft
 * @version $Revision: 155 $ $Date: 2008-06-11 13:03:07 +0200 (Mi, 11. Jun 2008) $
 */
class imdbXML extends XML_Serializer {
        

	/** Initialize class
	 * @method __construct
	 * @param optional object obj
	 */
	function __construct($obj = NULL) {
		// create object
		parent::XML_Serializer();

		// add XML declaration
		$this->setOption("addDecl", true);

		// indent elements
		$this->setOption("indent", " ");

		// set name for root element
		$this->setOption("rootName", "imdbXML");

		$this->setOption("defaultTagName", "item");
		
		$this->setOption("ignoreNull", "true");

		// avoid replace entities
		$this->setOption("replaceEntities", XML_SERIALIZER_ENTITIES_NONE);

		// represent scalar values as attributes instead of element
		//$this->setOption("scalarAsAttributes", true);
		if ($obj) 
			$this->parse($obj);
	}

	/** Generate XML code
	 * @method parse
	 * @param object obj IMDB object to be serialized
	 */
	function parse ($obj) {
		// create array to be serialized
		$class_vars = get_object_vars($obj);
		$base_tags = array_keys(get_class_vars(get_parent_class($obj)));
		$other_tags = array ('debug', 'maxresults', 'searchvariant','page');
		$banned_tags = array_merge($base_tags, $other_tags);		

		foreach ($class_vars as $name => $value) {
			if (!in_array($name, $banned_tags) && $value != -1 && $value !="") {
			if (is_array($value) && count($value) == 0) continue;
			    	// Strip tag name prefix (main and credits)
				$name = eregi_replace("main_|credits_", NULL, $name);
				$parse_arr[$name] = $value;
			}
		}

		// perform serialization
		return $this->serialize($parse_arr);
	}

} // end class imdbXML
?>
