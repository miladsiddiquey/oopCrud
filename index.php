<?php
include "database.php";
$obj = new Database();

$obj->insert('client', ['name' =>'milad siddiquey', 'address'=>'bangladesh']);
echo "insert result is: ";
print_r($obj->getResult());

?>
