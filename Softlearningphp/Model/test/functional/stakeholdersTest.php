<?php
/*
include_once '../../model/Stakeholders/Client.php';
include_once '../../model/Stakeholders/Employee.php';
include_once '../../model/Stakeholders/Provider.php';
include_once '../../model/Stakeholders/CompanyData.php';
include_once '../../model/Stakeholders/ClientCompany.php';
        
$client1 = new Client("abraham","Varsil", "loquesea@email.com", "callefalsa123", "123123123", "687196729", "100","Targeta");
print $client1->getContactData() .  $client1->printMessageInterface();



$employee1= new Employee("abraham","Varsil", "loquesea@email.com", "callefalsa123", "123123123", "687196729", "100","de8a1430","programacion" , "cuentabancaria");
print $employee1->getContactData();




//--------------------------------


print "<br>";

$p =new Provider("Twards SA", "101", "jose@mail.com", "123456789", "carrer kalea12", "20-02-2024", "30", "php", "15", "education");
print $p->getName() . ": " . $p ->getWorkers(). "(" . $p->getCompanyType().")". $p->printMessageInterface();

//nuevo client company-------------

$compraAbraham= new ClientCompany("abrahanudo", "apellido", "email@gmail.com", "callefalsa123", "Batman", "123456789", "24-4-24-", "Targeton", 100, "educacion");
print $compraAbraham->getName() . ":" . $compraAbraham->getWorkers() . $compraAbraham->getCompanyType();

/*
//provider, cleitn y client company
function pintdataSH (Stakeholder $sh){
    
    
    print $compraAbraham->getName() . ":" . $compraAbraham->getWorkers() . $compraAbraham->getCompanyType();
}
  */
 