<?php

include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Marketable.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Person.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Employee.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/persistence/MysqlEmployeeAdapter.php');

$dni = trim(filter_input(INPUT_POST, "Dni"));
$mysql = new MysqlEmployeeAdapter();

try {
    if (!$mysql->exists($dni)) {
        print "<br><br>El empleado con el $dni no se encuentra en la base de datos.";
    } else {
        $d = $mysql->deleteEmployee($dni);
        print "<br><br>El empleado que has introducido con el $dni se ha boprrado de la DB";
    }
} catch (ServiceException $ex) {
    print "Service Error: " . $ex->getMessage();
}

print "<p><a href=\"../view/DeleteEmployee.html\">Return to the previous page</a></p>\n";