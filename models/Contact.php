<?php

class Contact
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function Contact($data)
    {
        // Check if fields are empty or not
        if (empty($data['fullname']) || empty($data['email']) || empty($data['subject']) || empty($data['msg'])) {
            header("Location: ../contact.php?error=emptyfields");
            exit();
        }
        // Checks whether email is valid or not
        elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            header("Location: ../contact.php?error=invalidmail");
            exit();
        } else {
            $toWhomEmail  = "parweizh6@gmail.com";
            $subject = "Contact Request from: " . $data['fullname'] . ' <' . $data['email'] . '>';
            $body = "<h2>Contact Request</h2> 
                    <p>An user would like to contact you and therefore sent a mail through the website</p>
                    <h4>FullName</h4> <p>" . $data['fullname'] . "</p>
                    <h4>Email</h4> <p>" . $data['email'] . "</p>
                    <h4>Subject</h4> <p>" . $data['subject'] . "</p>
                    <h4>Message</h4> <p>" . $data['msg'] . "</p>
            ";

            // Email headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
            $headers .= "From: " . $data['fullname'] . '<' . $data['email'] . '>' . "\r\n";

            $mail = mail($toWhomEmail, $subject, $body, $headers);

            if ($mail) {
                header("Location: ../contact.php?mailsent=success");
            } else {
                header("Location: ../contact.php?mailsent=failed");
            }
        }
    }
}