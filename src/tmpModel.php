<?php

class {{className}} extends Model {

  /**
   * Rule constructor class it's call __construct of parent class
   *
   */
  public function __construct() {
      parent::__construct();
  }

  /**
   * Get results
   * 
   * @return Response
   * 
   */
  public function get() {
    // Preparing sql statements
    $stmt = $this->db->prepare("SELECT * FROM fruits");
          
    // Execute statements
    $stmt->execute();
    
    // Return response rows
    return $stmt->fetch_assoc();
  }

  /**
   * Set something in one field
   * 
   * @param Text $table
   * @param Array $field
   * @param Array $where
   * 
   * @return Response
   * 
   */
  public function set($table, $field, $where) {

  }

  /**
   * Store data new reccord
   * 
   * @param Text $table
   * @param Array $fieldsData
   * 
   * @return Response
   * 
   */
  public function store($table, $fieldsData) {

  }

  /**
   * Update multiple fields
   * 
   * @param Text $table
   * @param Array $fields
   * @param Array $where
   * 
   * @return Response
   * 
   */
  public function update($table, $fields, $where) {

  }

  /**
   * Delete something
   * 
   * @param Text $table
   * @param Array $where
   * 
   * @return Response
   * 
   */
  public function delete($table, $where) {

  }


}