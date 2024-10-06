<?php



include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Marketable.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Person.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Client.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/persistence/MysqlClientAdapter.php');








$dni = trim(filter_input(INPUT_POST, "Dni")); // DNI

$mysql = new MysqlClientAdapter();
try { 
        $c = $mysql->getClient($dni);
print "Nombre: " . $c->getName() . ', ' . "Apellido: " . $c->getSurname() . ', ' . "Correo electrónico: " . $c->getEmail() .
       ', ' . "Dirección: " . $c->getAddress() . ', ' . "DNI: " . $c->getDni() . ', ' . "Número: " . $c->getNumber() . ', ' .
       "Antigüedad: " . $c->getAntiquity() . ', ' . "Modo de pago: " . $c->getPaymentmode();
    
}catch (BuildException $ex) {
print ($ex->getMessage()) ;

}catch (ServiceException $ex){
    print ($ex->getMessage());
}
print "<p><a href=\"../view/SelectClient.html\">Return to the previous page</a></p>\n";

?>

