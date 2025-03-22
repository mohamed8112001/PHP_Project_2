<?php
//connection 

// _construct(string $dsn, string|null $username = null,
//  string|null $password = null, array|null $options = null): mixed

class Database {
    private $host="localhost";
    private $user="mohamed";
    private $password="Mohamed@8112001";
    private $dbname="PHP_TEST";
    private $connection ="";
    function __construct(){
        $this->connection = new pdo("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
    }
    function get_connection(){
        return $this->connection ;
    }

    public function select ($table,$condation=1){
        return $this->connection->query("select * from $table where $condation");
    }

    public function delete ($table,$condition=1){
        return $this->connection->query("DELETE FROM $table where $condition");
    }

    public function insert ($table,$columns,$values){
        $placeholders = implode(',', array_fill(0, count($values), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($values);
    }

    // public function update ($table,$columns,$condition){
    //     $placeholders = implode(',', array_map(fn($key)=>"$key=?",array_keys($columns)));

    //     $sql = "UPDATE $table set $columns where $condition";
        
    //     $stmt = $this->connection->prepare($sql);
    //     return $stmt->execute($columns);
    // }


    public function update($table, $data, $condition) {
        $setPart = "";
        $values = [];
    
        foreach ($data as $column => $value) {
            $setPart .= "$column = ?, ";
            $values[] = $value;
        }
        $setPart = rtrim($setPart, ", ");
    
        $sql = "UPDATE $table SET $setPart WHERE $condition";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($values);
    }

    
}
// try {
//     $connection = new pdo("mysql:host=localhost;dbname=PHP_TEST", "mohamed", "Mohamed@8112001");

//     //query
//     $connection->query("insert into employee(fname,lname,email,pass)
// values('{$_POST['fname']}','{$_POST['lname']}','{$_POST['email']}','{$_POST['pass']}')");
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }

//close connection 
$connection = null;



/*
-trim()                             ===> remove space
-n12br()                            ===> remove every \n or new line by <br>
-ucfirst("mohamed mustafa")         ===> Mohamed mustafa
-ucword("mohamed mustafa")          ===> Mohamed Mustafa
-strtolower("Mohamed")              ===> MOHAMED
-strtoupper("Mohamed")              ===> mohamed
-addslashes("O'Reilly")             ===> output: O\'Reilly    add slashe before (')
-stripslashes("O\'Reilly")          ===> output: O'Reilly     remove slashe
-explode(" ","piece1 piece2 piece3 piece4 piece5 piece6")
===> [piece1,piece2,piece3,piece4,piece5,piece6]  convert string to array 
-implode(",",['piece1','piece2','piece3','piece4','piece5','piece6']) convert array to string 
===> "piece1,piece2,piece3,piece4,piece5,piece6"   seperator no important
-strcmp("str","str")                ===> return (0 if =) (-1 if str1<str2) (1 if str1 > str2)
-strlen("iti")                      ===> return length of string = 3
-preg_match($patern,$data)          ===> check the string match patern or no 
-filter_var("iti@iti.com",FILTER_VALIDATE_EMAIL)  FILTER_VALIDATE_EMAIL is consrtant variable definied in php
===> check email match syntaics of email     in case the email valid return email if not valid return false
-filter_var("12213SCC32QF3FQW21",FILTER_SANITIZE_NUMBER_INT)  ===> 1221332321   FILTER AND RETURN NUMBER ONLY
*/


?>