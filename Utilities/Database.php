<?php
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    public static $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect() {
        self::$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if (self::$conn->connect_error) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script type='text/javascript'>
    Swal.fire({
        title: 'Error!',
        text: '"."Connection failed: " . self::$conn->connect_error."',
        icon: 'error',
        confirmButtonText: 'Close'
    })
    </script>";
            // die("Connection failed: " . self::$conn->connect_error);
        }
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script type='text/javascript'>
    Swal.fire({
        title: 'Success!',
        text: 'Connection 200' ,
        icon: 'success',
        confirmButtonText: 'Close'
    })
    </script>";
    }
}

?>
