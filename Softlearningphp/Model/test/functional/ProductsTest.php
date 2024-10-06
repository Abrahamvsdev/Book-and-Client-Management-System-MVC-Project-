<?php

//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/operations/Check.php');
//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/Products/Books.php');
//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/stakeholders/Employee.php');

//include_once '../../Exceptions/BuildExceptions.php';
//include_once '../../Products/Books.php';
//include_once '../../Products/Courses.php';
//include_once '../../Stakeholders/Person.php';
include_once '../../Products/Product.php';
//include_once '../../Products/Storable.php';
//include_once '../../Stakeholders/Employee.php';
include_once '../../Products/Software.php';





print "Software bueno";




print "<br>";
$errors="";


try{
  
     $nuevosoftware = new Software("asd jose", 17.90, "02-03-1990", "V.123_final");
     print $nuevosoftware->getDetails();
     
     
   print $errors.=$nuevosoftware->setReleaseDate("1990-03-02");
   print $errors.=$nuevosoftware->setIdent("");
   print $errors.=$nuevosoftware->setReleaseDate(".");
   //print $nuevosoftware->getDetails();
if (!empty($errors)) {
    
            print("<br> No es posible crear el objeto (software): <br>" . Check::getErrorMessage((int)$errors) . "<br>");
        }

}catch (BuildException $ex) {
    print $ex->getErrorMessage();
    
}
/*
print "<br><br>testeando";

print "<br>";
$errors2="";
try{
   
     $nuevosoftware1 = new Software("as", 17.90, "03-02-1990", "asdasd");
     print $nuevosoftware1->getDetails();
   //$errors.=$software1->setReleaseDate("1990-02-03");
   //$errors.=$Book1->setIsbn("987111111");
   //$errors.=$Book1->setCover(".");
   //print $nuevosoftware->getDetails();
if (!empty($errors2)) {
    
            print("<br> No es posible crear el objeto (software): <br>" . Check::getErrorMessage((int)$errors2) . "<br>");
        }

}catch (BuildException $ex) {
    print $ex->getErrorMessage();
    
}

*/






/*
print "First Book:";
print "<br>";
$errors="";
try{
    $Book1 =new Books("ident", 12.00, "2010-10-10", "mengano", "9871111111111", "tapa regulera", " paginas 1000", "fantasia", "Editorial: planeta ", 10.00, 70.20, 20.00, 70.00);
     

   $errors.=$Book1->setIdent("a");
   $errors.=$Book1->setIsbn("987111111");
   $errors.=$Book1->setCover(".");
   print $Book1->getDetails();
if (!empty($errors)) {
            print("<br> No es posible crear el objeto (Books): <br>" . Check::getErrorMessage((int)$errors) . "<br>");
        }

}catch (BuildException $ex) {
    print $ex->getErrorMessage();
    
}

print "<br><br>";
//print "First: Course";
print "<br>";
*/
/*
try{
  $Employee1= new Employee("perico", "apellido burlao", "email@gmail.com", "avenida calle falsa", "12312312G", "123123123", "50", "2010-10-10", "AAA_1234");

$Employee1->setDni("99999999G");
$Employee1->setName("a");
print $Employee1->getDetails();
}catch (BuildException $ex) {
    print $ex->getMessage();
}
print "<br><br>";
*/
/*
try{
    
  $Employee2= new Employee("perico", "apellido burlao", "email@gmail.com", "avenida calle falsa", "12312312G", "123123123", "50", "2010-10-10", "AAA_1234");

  print $Employee2->getDetails();  
  
  $Employee2->setDni("98123123G");
  $error=$Employee2->setDni("98123123G");
  if ($error != 0) {
        print "<br>Error! Bad Data: " . Check::getErrorMessage($error);
        }
  
}catch (BuildException $ex) {
    
    print $ex->getMessage();

}
*/
/*
print "<br><br>";
print "2nd Book:";
print "<br>";

try{
   $Book2= new Books("Nombre: Mauricio ", "Apellido: Feliz " , "email.com ", "001", 17.90 , "Mike Tyson ", "123456789isbn ", "Tapa: Dura ", "Páginas: 1000", "Género: Scy-fy", "Editorial: inventada ", 800.00, 20.00, 15.00, 70.00);
    print $Book2->getDetails(); 
}catch (BuildException $ex) {
    print $ex->getMessage();
}
print "<br><br>";

*/

