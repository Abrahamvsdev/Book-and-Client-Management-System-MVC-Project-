<?php

include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Marketable.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Person.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Employee.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/persistence/MysqlEmployeeAdapter.php');

$name = trim(filter_input(INPUT_POST, "Name"));
$surname = trim(filter_input(INPUT_POST, "Surname"));
$email = trim(filter_input(INPUT_POST, "Email"));
$address = trim(filter_input(INPUT_POST, "Address"));
$dni = trim(filter_input(INPUT_POST, "Dni")); // DNI
$number = trim(filter_input(INPUT_POST, "Number"));
$antiquity = trim(filter_input(INPUT_POST, "Antiquity"));
$contractday = trim(filter_input(INPUT_POST, "Contractday"));
var_dump($contractday);
$idemployee = trim(filter_input(INPUT_POST, "Idemployee"));

$mysql = new MysqlEmployeeAdapter();

try {

    if (!$mysql->exists($dni)) {
        $Employee1 = new Employee($name, $surname, $email, $address, $dni, $number, $antiquity,$contractday,$idemployee);
        $mysql->addEmployee($Employee1);
    } else {
        print "No se pudo agregar el empleado con Dni $dni por que ya existe.";
    }
} catch (Exception $ex) {
    print($ex->getMessage());
}

print "<p><a href=\"../view/index.html\">Tornar a la pàgina anterior</a></p>\n";
?>
