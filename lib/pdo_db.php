<?php
	/* 
   *  PDO DATABASE CLASS
   *  Connects Database Using PDO
	 *  Creates Prepeared Statements
	 * 	Binds params to values
	 *  Returns rows and results
	 * https://websitebeaver.com/php-pdo-prepared-statements-to-prevent-sql-injection
   */
class Database {
	private $dbServerName = DB_SERVERNAME;
	private $dbUsername = DB_USERNAME;
	private $dbPassword = DB_PASSWORD;
	private $dbTableName = DB_TABLENAME;
	
	private $dbhandler;
	private $error;
	private $prepared_statement;
	
	public function __construct() {
		// Set DSN (Data source name - Basically a string that describes the connection to datasource) 
		$dsn = 'mysql:host=' . $this->dbServerName . ';dbname=' . $this->dbTableName;
		$options = array (
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  //Turn on error handling - Throws exceptions
		);
		// Create a new PDO instanace
		try {
			$this->dbhandler = new PDO ($dsn, $this->dbUsername, $this->dbPassword, $options);
		}		
		// Catch any errors
		catch ( PDOException $e ) {
			$this->error = $e->getMessage();
			exit('Something weird happened');
		}
	}

	// Function to connect connection with after use in PDO
	public function closeConnection() {
		$this->dbhandler = null;
	}
	
	// Prepare the statement with query
	public function query($query) {
		$this->prepared_statement = $this->dbhandler->prepare($query);
	}
	
	// Bind values - https://www.php.net/manual/en/pdostatement.bindvalue.php
	public function bind($param, $value, $type = null) {
		if (is_null ($type)) {
			switch (true) {
				case is_int ($value) :
					$type = PDO::PARAM_INT;
					break;
				case is_bool ($value) :
					$type = PDO::PARAM_BOOL;
					break;
				case is_null ($value) :
					$type = PDO::PARAM_NULL;
					break;
				default :
					$type = PDO::PARAM_STR;
			}
		}
		$this->prepared_statement->bindValue($param, $value, $type);
	}
	
	// Execute the prepared statement
	public function execute(){
		return $this->prepared_statement->execute();
	}
	
	// Get all records as array of objects
	public function getAll(){	
		$this->execute();
		return $this->prepared_statement->fetchAll(PDO::FETCH_OBJ);
	}
	
	// Get a single record as object
	public function getSingle(){
		$this->execute();
		return $this->prepared_statement->fetch(PDO::FETCH_OBJ);
	}
	
	// Get record row count
	public function rowCount(){
		return $this->prepared_statement->rowCount();
	}
	
	// Get the ID of the last inserted row or value
	public function lastInsertId(){
		return $this->dbhandler->lastInsertId();
	}
}