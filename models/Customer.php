<?php
  class Customer {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    // Function to insert a customer object into the DB
    public function addCustomer($data) {
      // Prepare the query. Notice that values inside "VALUES" are been set up as named parameters for security reason (SQL Injection)
      $this->db->query('INSERT INTO customers (customerID, first_name, last_name, email) VALUES(:customerID, :first_name, :last_name, :email)');

      // Binding the actual values for our named parameters before execute
      $this->db->bind(':customerID', $data['customerID']);
      $this->db->bind(':first_name', $data['first_name']);
      $this->db->bind(':last_name', $data['last_name']);
      $this->db->bind(':email', $data['email']);

      
      // Execute the query simultaneously
      $execute = $this->db->execute();
      
      // If the query has been executed then return true. Else return false
      if($execute) {
        return true;
      } else {
        return false;
      }
    }

    // Function to get All customers from the DB
    public function getCustomers() {
      // Statement
      $this->db->query('SELECT * FROM customers ORDER BY created_at DESC');

      $results = $this->db->getAll();
      
      if(!$results) {
        exit('There were not any rows in the database'); 
      }
      return $results;
    }
  }