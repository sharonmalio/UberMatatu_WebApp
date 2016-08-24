<?php 
	
    //Path constants (directories contain / at the end)
    define("CONTROLS_PATH", __DIR__ . "/../");
    define("FUNCTIONS_PATH", __DIR__ . "/../includes/");
    define("VIEWS_PATH", __DIR__ . "/../views/");
    define("LIBS_PATH", __DIR__ . "/../libs/");
    define("HEADER_PATH", VIEWS_PATH . "templates/header.php");
    define("FOOTER_PATH", VIEWS_PATH . "templates/footer.php");
    define("NEWSTREAM_PATH", VIEWS_PATH . "templates/newstream.php");
    define("NOSCRIPT_PATH", VIEWS_PATH . "templates/noscript.php");
    define("LOAD_PATH", VIEWS_PATH . "templates/load.php");

    //Database constants (for connecting to mysql)
    define("DATABASE", "taxi");
    define("SERVER", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "1234");
?>