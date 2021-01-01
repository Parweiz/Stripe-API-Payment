<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function SignUp($data)
    {
        // If any of the fields are empty then the user should be redirected back to signup page
        if (empty($data['uid']) || empty($data['mail']) || empty($data['pwd']) || empty($data['pwdRepeat'])) {
            header("Location: ../signup.php?error=emptyfields&uid=" . $data['uid'] . "&mail=" . $data['mail']);
            exit();
        }
        // Checks whether the mail is validated as an actual email AND the username matches the search pattern that is being checked for
        elseif (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $data['uid'])) {
            header("Location: ../signup.php?error=invalidmailAnduid");
            exit();
        }
        // Look at line 19 for explanation - Basically ONLY checking if the mail is validated or not
        elseif (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&uid=" . $data['uid']);
            exit();
        }
        // Look at line 19 for explanation - Basically ONLY checking if the username matches the search pattern that is being checked for
        elseif (!preg_match("/^[a-zA-Z0-9]*$/", $data['uid'])) {  // We are basically searching for what we have inside [].
            header("Location: ../signup.php?error=invaliduid&mail=" . $data['mail']);
            exit();
        } else if ($data['pwd'] !== $data['pwdRepeat']) {
            header("Location: ../signup.php?error=passwordcheckfailed&uid=" . $data['uid'] . "&mail=" . $data['mail']);
            exit();
        }
        // See if there is already an existing username in the database
        else {
            
            // Prepare the query. Notice that values inside "VALUES" are been set up as named parameters for security reason (SQL Injection)
            $this->db->query('SELECT uidUsers FROM users WHERE uidUsers=:uidUsers');
        
            // Binding the actual values for our named parameters before execute
            $this->db->bind(':uidUsers', $data['uid']);

            $this->db->getSingle();

            // Checks how many rows or results we get from the db
            $resultCheck = $this->db->rowCount();
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usernametaken&mail=" . $data['mail']);
                exit();
            } else {
                // Prepare the query
                $this->db->query('INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (:uidUsers,:emailUsers,:pwdUsers)');

                $hashedPwd = password_hash($data['pwd'], PASSWORD_DEFAULT);

                // Bind the values for our named parameters
                $this->db->bind(':uidUsers', $data['uid']);
                $this->db->bind(':emailUsers', $data['mail']);
                $this->db->bind(':pwdUsers', $hashedPwd);

                $execute = $this->db->execute();

                if ($execute) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        // Think this is the proper way to close connection in PDO
        $this->db->closeConnection();
    }

    public function SignIn($data)
    {
        
    }
}