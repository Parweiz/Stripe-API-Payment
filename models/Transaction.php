<?php
  class Transaction {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    // Function to insert a transaction object into the DB
    public function addTransaction($data) {
      // Prepare the query. Notice that values inside "VALUES" are been set up as named parameters for security reason (SQL Injection)
      $this->db->query('INSERT INTO transactions (transactionID, customerID, product, amount, currency, status) VALUES(:transactionID, :customerID, :product, :amount, :currency, :status)');

      // Binding the actual values for our named parameters before execute
      $this->db->bind(':transactionID', $data['transactionID']);
      $this->db->bind(':customerID', $data['customerID']);
      $this->db->bind(':product', $data['product']);
      $this->db->bind(':amount', $data['amount']);
      $this->db->bind(':currency', $data['currency']);
      $this->db->bind(':status', $data['status']);

      // Execute the query simultaneously
      $execute = $this->db->execute();
      
      // If the query has been executed then return true. Else return false
      if($execute) {
        return true;
      } else {
        return false;
      }
    }

    // Function to get All transactions from the DB
    public function getTransactions() {
      $this->db->query('SELECT * FROM transactions ORDER BY created_at DESC');

      $results = $this->db->getAll();

       if(!$results) {
        exit('There were not any rows in the database'); 
      }

      return $results;
    }
  }