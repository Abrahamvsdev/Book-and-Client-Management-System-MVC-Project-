<?php

include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Storable.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/Products/Dimensions');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Books.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/persistence/MysqlBookAdapter.php');

$isbn = trim(filter_input(INPUT_POST, "Isbn"));

$mysql = new MysqlBookAdapter();

try {
    if (!$mysql->exists($isbn)) {
        print "<br><br>El libro con el $isbn no se encuentra en la base de datos.";
    } else {
        $d = $mysql->deleteBook($isbn);
        print "<br><br>El libro que has introducido con el $isbn se ha borrado de la DB";
    }
} catch (ServiceException $ex) {
    print "Service Error: " . $ex->getMessage();
}
print "  <p><a href=\"../../view/DeleteBook.html\">Tornar a la pàgina anterior</a></p>\n";
