<?php

	class MovieMySql
	{
		private $database;
		private $connection;

		public function __construct($dbName)
		{
			$this->database = $dbName;

			$host = "mysql:host=localhost; dbname={$this->database}; charset=utf8mb4";
			$user = 'root';
			$pass = '';

			try{
				$this->connection = new PDO(
					$host,
					$user,
					$pass,
					[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			}catch( PDOException $Exception ) {
		   	echo $Exception->getMessage();
			}
		}

		public function getAllMovies()
		{
			$stmt = $this->connection->prepare("SELECT id, rating, title FROM movies ORDER BY title");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function totalRows($queryResult)
		{
			if ( gettype($queryResult) == 'array' ) {
				return count($queryResult);
			} else {
				return 1;
			}
		}
	}
