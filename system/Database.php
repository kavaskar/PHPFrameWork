<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

/**
 * Database Class
 * 
 * @author stephen
 */
class Database extends PDO
{
	/**
	 * Other Fucntion that are not included in here but can be used from extends.
	 *
	 * $PDO->lastInsertId();				// Returns the id of the last inserted row
	 * $PDO->query($statement)->rowCount();	// Returns the number of rows affected
	 * $PDO->query($statement);				// Executes an sql statement
	 */


	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct($db_host, $db_name, $db_user, $db_pass){

		parent::__construct("mysql:host=$db_host;dbname=$db_name",$db_user,$db_pass);

	}
	
	
	/**
	 * Query a statement
	 *
	 * @access public
	 */
	public function query($sql, $fetch = self::FETCH_ASSOC){
		

		$stmt = $this->prepare($sql);
		$stmt->execute();
		
		return $stmt->fetchAll($fetch);
		
	}
	
	/**
	 * Returns the number of rows affected
	 *
	 * @access public
	 */
	public function row_count($sql) {
	
		return count($this->query($sql));
	
	}
	

	/**
	 * Insert a value into a table
	 *
	 * @access public
	 */
	public function insert($table, $values){

		foreach ($values as $key => $value)
		$field_names[] = $key . ' = :' . $key;

		$sql = "INSERT INTO " . $table . " SET " . implode(', ', $field_names);

		$stmt = $this->prepare($sql);
		foreach ($values as $key => $value)
		$stmt->bindValue(':' . $key, $value);

		return $stmt->execute();
	}

	/**
	 * Update a value in a table
	 *
	 * @access public
	 */
	public function update($table, $values, $where) {

		foreach ($values as $key => $value)
		$field_names[] = $key . ' = :' . $key;

		$sql  = "UPDATE " . $table . " SET " . implode(', ', $field_names) . " ";

		$counter = 0;

		foreach ($where as $key => $value) {

			if ($counter == 0) {

				$sql .= "WHERE {$key} = :{$key} ";

			} else {

				$sql .= "AND {$key} = :{$key} ";

			}
				
			$counter++;
		}

		$stmt = $this->prepare($sql);

		foreach ($values as $key => $value)
			$stmt->bindValue(':' . $key, $value);
			
		foreach ($where as $key => $value)
			$stmt->bindValue(':' . $key, $value);

		return $stmt->execute();

	}

	/**
	 * Delete a record
	 *
	 * @access public
	 */
	public function delete($table, $where) {

		$sql = "DELETE FROM " . $table . " ";
		
		$counter = 0;
		
		foreach ($where as $key => $value) {

			if ($counter == 0) {

				$sql .= "WHERE {$key} = :{$key} ";

			} else {

				$sql .= "AND {$key} = :{$key} ";

			}
				
			$counter++;
		}

		$stmt = $this->prepare($sql);
		
		foreach ($where as $key => $value)
			$stmt->bindValue(':' . $key, $value);
		
		return $stmt->execute();

	}
}
