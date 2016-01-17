<?php
//this is the less compiler. It is not used in production, it is just for developers who want to use our theme with less


ob_start('ob_gzhandler');
header('Content-type: text/css');


require_once("less_files/less/lessc.inc.php");
$less = new lessc;


/**
 *
 * @import url(http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic);
@import url(http://fonts.googleapis.com/css?family=Vollkorn:400italic,700italic,400,700);

 */



//import the google fonts
echo '

@import url(http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic);
@import url(http://fonts.googleapis.com/css?family=Vollkorn:400italic,700italic,400,700);

';

echo $less->compileFile("less_files/editor-style.less");

