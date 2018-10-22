<?php
/**
 *  DB - A simple database class 
 *
 * @author		Author: Vivek Wicky Aswal. (https://twitter.com/#!/VivekWickyAswal)
 * @git 		https://github.com/indieteq/PHP-MySQL-PDO-Database-Class
 * @version      0.2ab
 *
 */
namespace vendors\core;

use \PDO;

class Model
{
	protected static $config = array();
	protected static $readAdapter = NULL;
    protected static $writeAdapter = NULL;

    const DB_CONNECTION_WRITE = 2; // 010
    const DB_CONNECTION_READ =  4; // 100
    const DB_CONNECTION_BOTH =  6; // 110


	# @object, The PDO object
	private $dsn;
	# @object, The PDO object
	private $username;
	# @object, The PDO object
	private $password;


	# @object, The PDO object
	private $pdo;

	# @object, PDO statement object
	private $sQuery;

	# @array,  The database settings
	private $settings;

	# @bool ,  Connected to the database
	private $bConnected = false;

	# @object, Object for logging exceptions	
	private $log;

	# @array, The parameters of the SQL query
	private $parameters;
		
       /**
	*   Default Constructor 
	*
	*	1. Instantiate Log class.
	*	2. Connect to database.
	*	3. Creates the parameter array.
	*/
		public function __construct($config= array())
		{ 			

        	if ($config && is_array($config)) {
            	self::$config = $config;
       		 }
       		 
			$this->parameters = array();
		}
	
       /**
	*	This method makes getConnection to the database.
	*	
	*	1. Reads the database settings from a ini file. 
	*	2. Puts  the ini content into the settings array.
	*	3. Tries to connect to the database.
	*	4. If getConnection failed, exception is displayed and a log file gets created.
	*/
		protected function getConnection($type = self::DB_CONNECTION_BOTH)
		{
			global $settings;
			
			$dbConfig = self::$config['pdo']['default'];

        	$dsn=$dbConfig['dsn'];
            $username=$dbConfig['username'];
            $password=$dbConfig['password'];

			try 
			{
				# Read settings from INI file, set UTF8
				$this->pdo = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				
				# We can now log any exceptions on Fatal error. 
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				# Disable emulation of prepared statements, use REAL prepared statements instead.
				$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				
				# getConnection succeeded, set the boolean to true.
				return $this->pdo;
			}
			catch (PDOException $e) 
			{
				# Write into log
				echo $this->ExceptionLog($e->getMessage());
				die();
			}
		}

		
		 
	/*
	 *   You can use this little method if you want to close the PDO connection
	 *
	 */
	 	protected function CloseConnection()
	 	{
	 		# Set the PDO object to null to close the connection
	 		# http://www.php.net/manual/en/pdo.connections.php
	 		$this->pdo = null;
	 	}
		
       /**
     * Gets Database read connection
     *
     * @return \PDO
     */
    public function getReadConnection()
    {
        if (static::$readAdapter === NULL) {
            static::$readAdapter = $this->getConnection(self::DB_CONNECTION_READ);
        }

        return static::$readAdapter;
    }

    /**
     * Gets Database write connection
     *
     * @return \PDO
     */
    public function getWriteConnection()
    {
        if (static::$writeAdapter === NULL) {
            static::$writeAdapter = $this->getConnection(self::DB_CONNECTION_WRITE);
        }

        return static::$writeAdapter;
    }
	
}
?>
