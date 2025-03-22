<?php
// convert the values of $_POST to array of values seperat by any seperator

$values = implode(",",$_POST);

// write in file (open file , write in file , close file)

$data = file_put_contents("data.txt","\n".$values ,FILE_APPEND);

?>