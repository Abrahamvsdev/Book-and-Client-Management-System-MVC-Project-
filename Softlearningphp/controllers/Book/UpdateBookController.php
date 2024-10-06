
<?php


include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Storable.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');

include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Books.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/persistence/MysqlBookAdapter.php');

//include_once '../model/Products/Books.php';
//include_once '../model/operations/Check.php';



$ident = trim(filter_input(INPUT_POST, "Ident"));
$price= trim(filter_input(INPUT_POST, "Price"));
$date = trim(filter_input(INPUT_POST, "Date"));
$author = trim(filter_input(INPUT_POST, "Author"));
$isbn = trim(filter_input(INPUT_POST, "Isbn"));
$cover = trim(filter_input(INPUT_POST, "Cover"));
$page = trim(filter_input(INPUT_POST, "Page"));
$genre = trim(filter_input(INPUT_POST, "Genre"));
$editorial = trim(filter_input(INPUT_POST, "Editorial"));
$weight = trim(filter_input(INPUT_POST, "Weight"));
$heigth = trim(filter_input(INPUT_POST, "Heigth"));
$width = trim(filter_input(INPUT_POST, "Width"));
$length = trim(filter_input(INPUT_POST, "Length"));


$mysql = new MysqlBookAdapter();

try {
    if ($mysql->exists($isbn)) {
        $book = new Books($ident, $price, $date, $author, $isbn, $cover, $page, $genre, $editorial, $weight, $heigth, $width, $length);
        
        if ($mysql->updateBook($book)) {
            print "<br><br>El libro ha sido actualizado correctamente.";
        } else {
            print "<br><br>No se pudo actualizar el libro.";
        }
    } else {
        print "<br><br>El libro con el ISBN " . $isbn . " que has introducido no existe.";
    }
} catch (BuildException $ex) {
    print $ex->getMessage();
} catch (ServiceException $ex) {
    print $ex->getMessage();
}






print "  <p><a href=\"../../view/UpdateBook.html\">Tornar a la pàgina anterior</a></p>\n";