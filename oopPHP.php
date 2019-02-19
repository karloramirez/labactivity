<? php
class User {
  public $username;
  private $email;
  private $password;

  public function register() {
   //Check if the username input is set.
   if(isset( $_POST['username'] )) {
     //Assign the variables.
     $this->username = $_POST['username'];
     $this->email = $_POST['email'];
     $unhashed_pass = $_POST['password'];

     //Hash the password   
     $this->password = password_hash($unhashed_pass, PASSWORD_BCRYPT);

     $sql = "INSERT INTO 'users' ('id', 'username', 'email', 'password') VALUES (NULL, '$this->username', '$this->email', '$this->password')";
     $results = mysql_query($sql);

     if($results) {
      //Query was successful
      echo "Success";
     } else {
      echo mysql_error();
     }
   }
  }
}

<?