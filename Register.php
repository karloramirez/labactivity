<?php
//RegisterUI.php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
function __autoload($class_name) 
{
    include $class_name . '.php';
}
class RegisterUI 
{
    //Get the table name from constant in interface
    private $bletchley=IUI::BLETCHLEY;
    private $regUI;
 
    public function __construct()
    {
        //Use the Security object to encode table
        $sec=new Security();
        $this->bletchley=$sec->doEncode($this->bletchley);
        $this->regUI=<<<REGISTER
        <!DOCTYPE html>
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="login.css">
                <meta charset="UTF-8">
                <title>Registration</title>
            </head>
 
            <body>
                <h2>Registration</h2>
            <h5>Create a user name and password.<br /> Make ones that are easy to remember but unique. (Like you!) 30-character limit.</h5>
            <form action="Client.php" method="post" target="feedback">
            <input type="hidden" name="secreg" value=$this->bletchley>
            <input type="text" name="username" maxlength="30">&nbsp;Username: one word with no spaces<br />
            <input type="text" name="password" maxlength="30">&nbsp;Password: one word with no spaces<p />
            <input type="submit" name ="register" value ="Register me!">
            </form>
            <iframe name="feedback">Feedback</iframe>
 
            </body>
            </html>
REGISTER;
        echo $this->regUI;
    }
}
$worker=new RegisterUI();
?>