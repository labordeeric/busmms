<?php
class User {
    
    private $username;
    private $password;
    private $role;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function getUsername() {
        return $this->username;
    }

    public function checkPassword($password) {
        return password_verify($password, $this->password);
    }

    public function checkLogin(){
        $role='Admin'
        $username = Database::$conn->real_escape_string($this->$username);
        $password = Database::$conn->real_escape_string($this->$password);
        $sql ="SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = Database::$conn->query($sql);
        if($result->num_rows >0){
            login();
            return true
        }
        return false
    }

    public function getRole() {
        return $this->role;
    }

    public function login() {
        $_SESSION['username'] = $this->username;
        $_SESSION['role'] = $this->role;
    }

    public static function logout() {
        session_unset();
        session_destroy();
    }
    public static function getUserInfo($username) {
        // Make sure to sanitize the input to prevent SQL injection
        $username = Database::$conn->real_escape_string($username);

        // Prepare the SQL statement
        $sql = "SELECT * FROM users WHERE username = '$username'";

        // Execute the SQL statement
        $result = Database::$conn->query($sql);
        $UsersInfo=[]
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "Username: " . $row["username"]. " - Role: " . $row["role"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    }
}

// Start the session
// session_start();

// Usage
// $user = new User('username', password_hash('password', PASSWORD_DEFAULT), 'admin');

// if ($user->checkPassword('password')) {
//     $user->login();
//     echo 'Logged in as ' . $_SESSION['role'];
// } else {
//     echo 'Invalid password';
// }

// To log out
// User::logout();
?>
