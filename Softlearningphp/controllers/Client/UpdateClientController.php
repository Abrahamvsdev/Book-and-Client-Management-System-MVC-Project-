<?php



include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Marketable.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Person.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/stakeholders/Client.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/persistence/MysqlClientAdapter.php');







$name = trim(filter_input(INPUT_POST, "Name"));
$surname = trim(filter_input(INPUT_POST, "Surname"));
$email = trim(filter_input(INPUT_POST, "Email"));
$address = trim(filter_input(INPUT_POST, "Address"));
$dni = trim(filter_input(INPUT_POST, "Dni")); // DNI
$number = trim(filter_input(INPUT_POST, "Number"));
$antiquity = trim(filter_input(INPUT_POST, "Antiquity"));
$paymentmode = trim(filter_input(INPUT_POST, "PaymentMode"));
$mysql = new MysqlClientAdapter();

try {
    if ($mysql->exists($dni)) {
        $client = new Client($name, $surname, $email, $address, $dni, $number, $antiquity, $paymentmode);
        
        if ($mysql->updateClient($client)) {
            print "<br><br>El cliente con DNI $dni ha sido actualizado correctamente.";
        } else {
            print "<br><br>No se pudo actualizar el cliente.";
        }
    } else {
        print "<br><br>El cliente con el DNI " . $dni . " que has introducido no existe.";
    }
} catch (BuildException $ex) {
    print $ex->getMessage();
} catch (ServiceException $ex) {
    print $ex->getMessage();
}

print "<p><a href=\"../view/UpdateClient.html\">Return to the previous page</a></p>\n";

?>
