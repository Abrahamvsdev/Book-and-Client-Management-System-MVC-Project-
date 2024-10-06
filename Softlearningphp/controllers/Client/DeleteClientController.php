<?php



include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Marketable.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Person.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Client.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/persistence/MysqlClientAdapter.php');








$dni = trim(filter_input(INPUT_POST, "Dni")); // DNI

$mysql = new MysqlClientAdapter();
try {
    if (!$mysql->exists($dni)) {
        print "<br><br>El cliente con el $dni no se encuentra en la base de datos.";
    } else {
        $d = $mysql->deleteClient($dni);
        print "<br><br>El cliente que has introducido con el $dni se ha boprrado de la DB";
    }
} catch (ServiceException $ex) {
    print "Service Error: " . $ex->getMessage();
}

print "<p><a href=\"../view/DeleteClient.html\">Return to the previous page</a></p>\n";

?>
