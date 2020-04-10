<?php
require_once('config.php');

// Connect to database
$dsn = 'mysql:host=localhost;dbname=testdb';
$options = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES   => false,
        );
try{
        $db = new PDO($dsn, DB_USER, DB_PASS, $options);
        echo "Successfully Connected to Database";
}
catch(PDOException $e){
echo "Error Code: " . $e->getCode();
}

// Create tables
    
$db->query( " CREATE TABLE IF NOT EXISTS`auth_tokens` (
 `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(30) NOT NULL,
 `selector` char(16) DEFAULT NULL,
 `token` char(64) DEFAULT NULL,
 `expires` datetime DEFAULT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
    
$db->query("CREATE TABLE IF NOT EXISTS `password_reset` (
 `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `email` varchar(255) DEFAULT NULL,
 `selector` char(16) DEFAULT NULL,
 `token` char(64) DEFAULT NULL,
 `expires` bigint(20) DEFAULT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");

$db->query("CREATE TABLE IF NOT EXISTS `users` (
 `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(30) NOT NULL,
 `password` varchar(255) NOT NULL,
 `name` varchar(30) DEFAULT NULL,
 `email` varchar(255) DEFAULT NULL,
 `access` varchar(10) NOT NULL,
 `last_login` datetime NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8");
echo "<h2> the Structure of your auth_tokens table is:</h2><br>";
$tables= $db->query("describe auth_tokens");
$result = $tables->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $column){
        echo $column['Field'] . ' - ' . $column['Type'], '<br>';
    }

echo "<h2> the Structure of your password_reset table is:</h2><br>";
$tables= $db->query("describe password_reset");
$result = $tables->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $column){
            echo $column['Field'] . ' - ' . $column['Type'], '<br>';
        }

echo "<h2> the Structure of your users table is:</h2><br>";
$tables= $db->query("describe users");
$result = $tables->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $column){
            echo $column['Field'] . ' - ' . $column['Type'], '<br>';
        }