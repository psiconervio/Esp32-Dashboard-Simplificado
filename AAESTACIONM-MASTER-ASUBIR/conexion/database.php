<?php
	class Database {
		//database local
	    private static $dbName = 'id21999724_esp32_01'; // Example: private static $dbName = 'myDB';
	    private static $dbHost = 'localhost'; // Example: private static $dbHost = 'localhost';
	    private static $dbUsername = 'root'; // Example: private static $dbUsername = 'myUserName';
	    private static $dbUserPassword = ''; // // Example: private static $dbUserPassword = 'myPassword';
		//nuevadatabase
		//private static $dbName = 'id21999724_esp32_01'; // Example: private static $dbName = 'myDB';
		//private static $dbHost = 'localhost'; // Example: private static $dbHost = 'localhost';
		//private static $dbUsername = 'id21999724_admin'; // Example: private static $dbUsername = 'myUserName';
		//private static $dbUserPassword = 'Nodotecnologico1*'; // // Example: private static $dbUserPassword = 'myPassword';
		 
		private static $cont  = null;
		 
		public function __construct() {
			die('Init function is not allowed');
		}
		 
		public static function connect() {
      // One connection through whole application
      if ( null == self::$cont ) {     
        try {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        } catch(PDOException $e) {
          die($e->getMessage()); 
        }
      }
      return self::$cont;
		}
		 
		public static function disconnect() {
			self::$cont = null;
		}
	}
