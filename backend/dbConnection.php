<?php

    function getDatabaseConnection($dbName) {
    
        $host = "localhost";
        $username = "root";
        $password = "";
        
        //checks whether the URL contains "herokuapp" (using Heroku)
        // need this to be able to run in HEROKU
        if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false || strpos($_SERVER['HTTP_HOST'], getenv("CUSTOM_URL")) !== false) {
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $host = $url["host"];
            $dbName = substr($url["path"], 1);
            $username = $url["user"];
            $password = $url["pass"];
        }
        $dbConn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $dbConn;
    }
?>