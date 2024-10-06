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
$idemployee = trim(filter_input(INPUT_POST, "Idemployee"));
$mysql = new MysqlEmployeeAdapter();

try {
    if ($mysql->exists($dni)) {
        $Employee1 = new Employee($name, $surname, $email, $address, $dni, $number, $antiquity, $contractday,$idemployee);
        
        if ($mysql->updateEmployee($Employee1)) {
            print "<br><br>El empleado  con DNI $dni ha sido actualizado correctamente.";
        } else {
            print "<br><br>No se pudo actualizar el empleado.";
        }
    } else {
        print "<br><br>El empleado con el DNI " . $dni . " que has introducido no existe.";
    }
} catch (BuildException $ex) {
    print $ex->getMessage();
} catch (ServiceException $ex) {
    print $ex->getMessage();
}

print "<p><a href=\"../view/UpdateEmployee.html\">Return to the previous page</a></p>\n";

?>
