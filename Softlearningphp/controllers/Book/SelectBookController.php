<?php

include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Storable.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/Products/Dimensions');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/Products/Books.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/persistence/MysqlBookAdapter.php');


$isbn = trim(filter_input(INPUT_POST, "Isbn"));

$mysql = new MysqlBookAdapter();


try { 
        $b = $mysql->getBook($isbn);
        print "Autor: " . $b->getAuthor() . ', ' . "Precio: " . $b->getPrice() . ', ' . "Descripción: " . $b->getCover() .
       ', ' . "Título: " . $b->getIdent() . ', ' . "Tapa: " . $b->getCover() . ', ' .
      "Páginas: " . $b->getPage() . ', ' . "Género: " . $b->getGenre() . ', ' . "Editorial: " . $b->getEditorial() . ', ' .
      "ISBN: " . $b->getISBN() . ', ' . "Altura: " . $b->Dim->getHeigth(). ', ' . "Ancho: " . $b->Dim->getWidth() . ', ' .
      "Longitud: " . $b->Dim->getLength() . ', ' . "Peso: " . $b->Dim->getWeight() ."Fecha:" . $b->getDate();
    
}catch (BuildException $ex) {
print ($ex->getMessage()) ;

}catch (ServiceException $ex){
    print ($ex->getMessage());
}










print "  <p><a href=\"../../view/SelectBook.html\">Tornar a la pàgina anterior</a></p>\n";

