<?php

include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/stakeholders/Person.php');
//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/operations/Check.php');
//include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/Exceptions/BuildException.php');


class Employee extends Person {
    protected DateTime $contractDay;
    protected string $idEmployee;
    protected bool $create = true;

    public function __construct(string $name, string $surname, string $email, string $address, string $dni, string $number, string $antiquity, string $contractDay, string $idEmployee) {
        $message="";
        try {
            parent::__construct($name, $surname, $email, $address,$dni,$number,$antiquity,);
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }
        
        $errors = '';

        if ($this->setContractDay($contractDay) !== 0) {
            $errors .= Check::getErrorMessage(Check::checkDate($contractDay)) . "<br>";
        }

        if ($this->setIdEmployee($idEmployee) !== 0) {
            $errors .= Check::getErrorMessage(Check::checkIdemployee($idEmployee)) . "<br>";
        }

        if (!empty($errors)) {
            throw new BuildException("Not possible to create this object (Employee): <br>" . $errors);
        }
    }

    public function getContractDay(): string {
        return $this->contractDay->format('Y-m-d');
    }

    public function getIdEmployee(): string {
        return $this->idEmployee;
    }

    public function setContractDay(string $contractDay): int {
        $errorContractDay = Check::checkDate($contractDay);
        if ($errorContractDay == 0) {
            $this->contractDay = new DateTime($contractDay);
        }
        return $errorContractDay;
    }

    public function setIdEmployee(string $idEmployee): int {
        $errorIdEmployee = Check::checkIdemployee($idEmployee);
        if ($errorIdEmployee == 0) {
            $this->idEmployee = $idEmployee;
        }
        return $errorIdEmployee;
    }

    public function getContactData(): string {
        return "Name: " . $this->getName() . "<br>" .
               "Surname: " . $this->getSurname() . "<br>" .
               "Email: " . $this->getEmail() . "<br>" .
               "Schedule: " . $this->getSchedule() . "<br>" .
               "Department: " . $this->getDepartment() . "<br>" .
               "Bank Account: " . $this->getBankAccount();
    }

    public function getDetails(): string {
        return "Name: " . $this->getName() . "<br>" .
               "Surname: " . $this->getSurname() . "<br>" .
               "Email: " . $this->getEmail() . "<br>" .
               "Address: " . $this->getAddress() . "<br>" .
               "DNI: " . $this->getDni() . "<br>" .
               "Phone Number: " . $this->getNumber() . "<br>" .
               "Antiquity: " . $this->getAntiquity() . "<br>" .
               "Contract Day: " . $this->getContractDay() . "<br>" .
               "ID Employee: " . $this->getIdEmployee() . "<br>" ;
    }
}

















/*
class Employee extends Person {
    protected DateTime $contractday;
    protected string $idemployee;
    protected bool $create = true;

    public function __construct(string $name, string $surname, string $email, string $address, string $dni, string $number, string $antiquity, string $contractday, string $idemployee) {
        parent::__construct($name, $surname, $email, $address, $dni, $number, $antiquity);

        if ($this->setContractday($contractday) !== 0) {
            $this->create = false;
        }

        if ($this->setIdemployee($idemployee) !== 0) {
            $this->create = false;
        }


        if (!$this->create) {
            throw new BuildException("Not possible to create this object (Employee).");
        }
    }

    public function getContractday(): string {
        return $this->contractday->format('Y-m-d');
    }

    public function getIdemployee(): string {
        return $this->idemployee;
    }

    
   
    protected function setContractday(string $contractday):int {
        $errorContractday = Check::checkDate($contractday);
        if ($errorContractday != 0) {
            print Check::getErrorMessage($errorContractday);
        } else {
            $this->contractday = new DateTime($contractday);
           
            
            
        }
        return $errorContractday;
    }

    
    protected function setIdemployee(string $idemployee) {
        $errorIdemployee = Check::checkIdemployee($idemployee);
        if ($errorIdemployee != 0) {
            print Check::getErrorMessage($errorIdemployee);
        } else {
            $this->idemployee = $idemployee;
           
        }
        return $errorIdemployee;
    }

    

    public function getContactData(): string {
        return "<br>" . $this->getName() . $this->getSurname() . $this->getEmail() . $this->getSchedule() . $this->getDepartment() . $this->getBankaccount();
    }
}

*/

/*
class Employee extends Person{
    
    protected string $schedule;
    protected string $department;
    protected string $bankaccount;
    
    
    public function __construct(string $name, string $surname, string $email, string $address, string $ident, string $number, string $antiquity,string $schedule, string $department, string $bankaccount) {
        parent::__construct($name, $surname, $email, $address, $ident, $number, $antiquity);
        
        $this->schedule= $schedule;
        $this->department= $department;
        $this->bankaccount=$bankaccount;
    }
    
    
    public function getSchedule(): string {
        return $this->schedule;
    }

    public function getDepartment(): string {
        return $this->department;
    }

    public function getBankaccount(): string {
        return $this->bankaccount;
    }

    public function setSchedule(string $schedule): void {
        $this->schedule = $schedule;
    }

    public function setDepartment(string $department): void {
        $this->department = $department;
    }

    public function setBankaccount(string $bankaccount): void {
        $this->bankaccount = $bankaccount;
    }

        
    
    
    public function getContactData():string {
        return "<br>" .$this->getName() . $this->getSurname() . $this->getEmail() . $this->getSchedule(). $this->getDepartment() .$this->getBankaccount();
    }
}
 * 
 */