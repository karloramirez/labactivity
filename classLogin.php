<? php

class Login
{
    private $host = "localhost";
    private $user = "username";
    private $pw = "password";
    private $database = "database_name";

    public function db_connect()
    {
        $db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database . '', $this->user, $this->pw) or die("Cannot connect to mySQL.");

        return $db;
    }
}

class Posted extends Login
{

    private $username;
    private $password;
    private $result;
    private $my_array;

    function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        $this->login2 = new Login();
        $this->db = $this->login2->db_connect();

        $command = $this->db->prepare("SELECT * FROM logins_test WHERE login =:login AND password = password(:password)");
        $command->bindParam(':login', $this->username);
        $command->bindParam(':password', $this->password);
        $command->execute();
        $result = $command->fetchAll();
        $this->result = $result;

        //var_dump($result);
        $my_array = array();
        foreach ($this->result as $row) {

            $my_array[] = $row;
        }

        $this->my_array = $my_array;
        if (!empty($this->my_array)) {
            $_SESSION['id'] = $this->my_array[0]['id'];
            $_SESSION['login'] = $this->my_array[0]['login'];
            $_SESSION['timestamp'] = time();
            echo $_SESSION['id'] . " - " . $_SESSION['login'] . " - " . $_SESSION['timestamp'];
            echo "<br/>Success<br/>";

            $this->mytime = $_SESSION['timestamp'];
            $this->myuser = $_SESSION['id'];
            $command = "INSERT INTO logins_validate VALUES (NULL,:user_id, :time_current)";
            $command1 = $this->db->prepare($command);
            $command1->bindParam(':user_id', $this->myuser);
            $command1->bindParam(':time_current', $this->mytime);
            $command1->execute();

        } else {
            echo "Wrong username or password!";
        }

    }

}

<?