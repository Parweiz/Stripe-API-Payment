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
        if (empty($data['UserName']) || empty($data['Email']) || empty($data['Password']) || empty($data['RepeatPassword'])) {
            header("Location: ../signup.php?error=emptyfields&username=" . $data['UserName'] . "&mail=" . $data['Email']);
            exit();
        }
        // Checks whether the mail is validated as an actual email AND the username matches the search pattern that is being checked for
        elseif (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $data['UserName'])) {
            header("Location: ../signup.php?error=invalidmailAndusername");
            exit();
        }
        // Look at line 19 for explanation - Basically ONLY checking if the mail is validated or not
        elseif (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&username=" . $data['UserName']);
            exit();
        }
        // Look at line 19 for explanation - Basically ONLY checking if the username matches the search pattern that is being checked for
        elseif (!preg_match("/^[a-zA-Z0-9]*$/", $data['UserName'])) {  // We are basically searching for what we have inside [].
            header("Location: ../signup.php?error=invalidusername&mail=" . $data['Email']);
            exit();
        } else if ($data['Password'] !== $data['RepeatPassword']) {
            header("Location: ../signup.php?error=passwordcheckfailed&username=" . $data['UserName'] . "&mail=" . $data['Email']);
            exit();
        }
        // See if there is already an existing username in the database
        else {

            // Prepare the query. Notice that values inside "VALUES" are been set up as named parameters for security reason (SQL Injection)
            $this->db->query('SELECT UserName FROM users WHERE UserName=:UserName');

            // Binding the actual values for our named parameters before execute
            $this->db->bind(':UserName', $data['UserName']);
            $this->db->execute();

            // Checks how many rows or results we get from the db
            $resultCheck = $this->db->rowCount();
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usernametaken&mail=" . $data['Email']);
                exit();
            } else {
                // Prepare the query
                $this->db->query('INSERT INTO users (UserName, FullName, Email, Pwd) VALUES (:UserName,:FullName,:Email, :Pwd)');

                $hashedPwd = password_hash($data['Password'], PASSWORD_DEFAULT);

                // Bind the values for our named parameters
                $this->db->bind(':UserName', $data['UserName']);
                $this->db->bind(':FullName', $data['FullName']);
                $this->db->bind(':Email', $data['Email']);
                $this->db->bind(':Pwd', $hashedPwd);

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
        if (empty($data['UserName']) || empty($data['Password'])) {
            header("Location: ../signin.php?error=emptyfields");
            exit();
        } else {
            // Since we'd like to user to login with their username then that's how the sql statement will be implemented
            $this->db->query('SELECT * FROM users WHERE UserName=:UserName');
            $this->db->bind(':UserName', $data['UserName']);

            $result = $this->db->getSingle();
            // Converting from stdClass to array - https://stackoverflow.com/questions/18576762/php-stdclass-to-array
            $array = json_decode(json_encode($result), true);

            if ($array) {
                $pwdCheck = password_verify($data['Password'], $array['Pwd']);
                if ($pwdCheck === false) {
                    header("Location: ../signin.php?error=wrongpwd");
                    exit();
                } elseif ($pwdCheck == true) {

                    /* What we need to do in order to let the user to login is to start a session. The reason behind this 
                    is that the way loginsystem works is that we create a global variable that has the info about the user, when
                    he/she is signed in the website. In that matter we simply check inside the website check whether the global 
                    variable is available or not. This is where "session" comes into play, because the type of variable we'd like
                    to store globally is going to be a "session" variable. 
                    */
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $array['userID'];
                    $_SESSION['username'] = $array['UserName'];
                    $_SESSION['fullname'] = $array['FullName'];

                    header("Location: ../index.php?login=success");
                } else {
                    header("Location: ../signin.php?error=wrongpwd");
                    exit();
                }
            } else {
                header("Location: ../signin.php?error=nouser");
                exit();
            }
        }
    }
}