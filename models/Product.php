<?php

require_once('../config/dbConfig.php');

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    // Function to insert a payment object into the DB
    public function SubscribeToProduct($data)
    {
        // Preparing the query to see if an user object with the email already exists in DB
        $this->db->query('SELECT PaymentID FROM paymentuser WHERE PaymentEmail=:PaymentEmail');
        $this->db->bind(':PaymentEmail', $data['email']);

        $rowCount = $this->db->rowCount();
        // If the count is higher than 0, then go ahead and update the id of the product that the person has purchased
        if ($rowCount > 0) {
            $this->db->query("UPDATE productuser SET ProductID=:ProductID WHERE PaymentEmail=:PaymentEmail");
            $password = "Your Old Password";
        } else {
            // Create an user object
            $this->db->query('INSERT INTO paymentuser (PaymentEmail, ProductID, PaymentPwd) VALUES(:PaymentEmail, :ProductID, :PaymentPwd)');

            // Binding the actual values for our named parameters before execute
            $this->db->bind(':PaymentEmail', $data['email']);
            $this->db->bind(':ProductID', $data['productID']);
            $this->db->bind(':PaymentPwd', $data['hashedPwd']);

            // Execute the query simultaneously
            $execute = $this->db->execute();

            // If the query has been executed then return true. Else return false
            if ($execute) {
                return true;
            } else {
                return false;
            }
        }
    }
}