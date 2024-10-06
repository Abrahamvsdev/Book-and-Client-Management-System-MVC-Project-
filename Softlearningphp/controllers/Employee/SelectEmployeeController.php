<?php
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Marketable.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Person.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Employee.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/persistence/MysqlEmployeeAdapter.php');

$dni = trim(filter_input(INPUT_POST, "Dni")); // DNI

$mysql = new MysqlEmployeeAdapter();
try { 
        $c = $mysql->getEmployee($dni);
print "Nombre: " . $c->getName() . ', ' . "Apellido: " . $c->getSurname() . ', ' . "Correo electrónico: " . $c->getEmail() .
       ', ' . "Dirección: " . $c->getAddress() . ', ' . "DNI: " . $c->getDni() . ', ' . "Número: " . $c->getNumber() . ', ' .
       "Antigüedad: " . $c->getAntiquity() . ', ' . "Modo de pago: " . "Dia contratado:". $c->getContractday() . "Id de empleado:". $c->getIdemployee();
    
}catch (BuildException $ex) {
print ($ex->getMessage()) ;

}catch (ServiceException $ex){
    print ($ex->getMessage());
}
print "<p><a href=\"../view/SelectEmployee.html\">Return to the previous page</a></p>\n";
