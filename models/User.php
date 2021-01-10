<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Function to signin with
    public function Signin($data)
    {
        if (empty($data['Email']) || empty($data['Password'])) {
            header("Location: ../login.php?error=emptyfields");
            exit();
        } else {
            // Prepare the query - Trying to see if there's already an User object in DB
            $this->db->query('SELECT * FROM paymentuser WHERE PaymentEmail=:PaymentEmail');
            $this->db->bind(':PaymentEmail', $data['Email']);

            // If there's an User object in DB with that specific username then grab the object
            $result = $this->db->getSingle();
            // Converting from stdClass to array
            $array = json_decode(json_encode($result), true);

            if (!$array) {
                header("Location: ../login.php?error=nouser");
                exit();
            } else {
                $pwdCheck = password_verify($data['Password'], $array['PaymentPwd']);
                if ($pwdCheck === false) {
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                } elseif ($pwdCheck == true) {

                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['paymentID'] = $array['PaymentID'];
                    $_SESSION['productID'] = $array['ProductID'];
                    $_SESSION['email'] = $array['PaymentEmail'];

                    header("Location: ../index.php?login=success");
                } else {
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
            }
        }
    }
}