<?php

# environment dev/prod
define("ENVIRONMENT", "dev");

# root path 
define("ROOT", str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

# define sql connection variables
define("DBHOST", "database");
define('DBNAME', 'blog');
define("DBPORT", "3306");
define("DBDRIVER", "mysql");
define("DBUSER", "root");
define("DBPWD", "");
define('DBPREFIXE', 'seb_');

# define domain name
define('DOMAIN', 'mon-blog.fr');