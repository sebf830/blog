<?php

# environment dev/prod
define("ENVIRONMENT", "dev");

# root path 
define("ROOT", str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

# define sql connection variables
define("DBHOST", "127.0.0.1");
define('DBNAME', 'blog');
define("DBPORT", "3306");
define("DBDRIVER", "mysql");
define("DBUSER", "root");
define("DBPWD", "root");

# define domain name
define('DOMAIN', 'mon-blog.fr');