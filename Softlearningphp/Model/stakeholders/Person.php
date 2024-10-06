<?php

//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/operations/Check.php');

abstract class Person {
    protected string $name;
    protected string $surname;
    protected string $email;
    protected string $address;
    protected string $dni;
    protected string $number;
    protected string $antiquity;
    protected bool $create = true;

    public function __construct(string $name, string $surname, string $email, string $address, string $dni, string $number, string $antiquity) {
        $errors = '';

        if ($this->setName($name) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($name)) . "<br>";
        }

        if ($this->setSurname($surname) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($surname)) . "<br>";
        }

        if ($this->setEmail($email) !== 0) {
            $errors .= Check::getErrorMessage(Check::checkEmail($email)) . "<br>";
        }

        if ($this->setAddress($address) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($address)) . "<br>";
        }

        if ($this->setDni($dni) !== 0) {
            $errors .= Check::getErrorMessage(Check::checkDNI($dni)) . "<br>";
        }

        if ($this->setNumber($number) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($number)) . "<br>";
        }

        if ($this->setAntiquity($antiquity) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($antiquity)) . "<br>";
        }

        if (!empty($errors)) {
            throw new BuildException("Not possible to create this object (Person): <br>" . $errors);
        }
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getDni(): string {
        return $this->dni;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function getAntiquity(): string {
        return $this->antiquity;
    }

    public function setName(string $name): int {
        $errorName = Check::validate($name);
        if ($errorName != 0) {
            return $errorName;
        } else {
            $this->name = $name;
        }
        return $errorName;
    }

    public function setSurname(string $surname): int {
        $errorSurname = Check::validate($surname);
        if ($errorSurname != 0) {
            return $errorSurname;
        } else {
            $this->surname = $surname;
        }
        return $errorSurname;
    }

    public function setEmail(string $email): int {
        $errorEmail = Check::checkEmail($email);
        if ($errorEmail != 0) {
            return $errorEmail;
            
        } else {
            $this->email = $email;
        }
        return $errorEmail;
    }

    public function setAddress(string $address): int {
        $errorAddress = Check::validate($address);
        if ($errorAddress != 0) {
            return $errorAddress;
        } else {
            $this->address = $address;
        }
        return $errorAddress;
    }

    public function setDni(string $dni): int {
        $errorDni = Check::checkDNI($dni);
        if ($errorDni != 0) {
            return $errorDni;
        } else {
            $this->dni = $dni;
        }
        return $errorDni;
    }

    public function setNumber(string $number): int {
        $errorNumber = Check::validate($number);
        if ($errorNumber != 0) {
            return $errorNumber;
        } else {
            $this->number = $number;
        }
        return $errorNumber;
    }

    public function setAntiquity(string $antiquity): int {
        $errorAntiquity = Check::validate($antiquity);
        if ($errorAntiquity != 0) {
            return $errorAntiquity;
        } else {
            $this->antiquity = $antiquity;
        }
        return $errorAntiquity;
    }

    public abstract function getContactData(): string;

    public function getDetails(): string {
        
    }
}











/*
abstract class Person {
    protected string $name;
    protected string $surname;
    protected string $email;
    protected string $address;
    protected string $dni;
    protected string $number;
    protected string $antiquity;
    protected bool $create = true;

    protected function __construct(string $name, string $surname, string $email, string $address, string $dni, string $number, string $antiquity) {
        if ($this->setName($name) !== 0) {
            $this->create = false;
        }

        if ($this->setSurname($surname) !== 0) {
            $this->create = false;
        }

        if ($this->setEmail($email) !== 0) {
            $this->create = false;
        }

        if ($this->setAddress($address) !== 0) {
            $this->create = false;
        }

        if ($this->setDni($dni) !== 0) {
            $this->create = false;
        }

        if ($this->setNumber($number) !== 0) {
            $this->create = false;
        }

        if ($this->setAntiquity($antiquity) !== 0) {
            $this->create = false;
        }

        if (!$this->create) {
            throw new BuildException("Not possible to create this object (Person).");
        }
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getDni(): string {
        return $this->dni;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function getAntiquity(): string {
        return $this->antiquity;
    }

    protected function setName(string $name): int {
        $errorName = Check::validate($name);
        if ($errorName != 0) {
            print Check::getErrorMessage($errorName);
        } else {
            $this->name = $name;
            print "<br>El nombre es: " . $name;
        }
        return $errorName;
    }

    protected function setSurname(string $surname): int {
        $errorSurname = Check::validate($surname);
        if ($errorSurname != 0) {
            print Check::getErrorMessage($errorSurname);
        } else {
            $this->surname = $surname;
            print "<br>El apellido es: " . $surname;
        }
        return $errorSurname;
    }

    protected function setEmail(string $email): int {
        $errorEmail = Check::checkEmail($email);
        var_dump($errorEmail);
        if ($errorEmail != 0) {
            print Check::getErrorMessage($errorEmail);
        } else {
            $this->email = $email;
            print "<br>El email es: " . $email;
        }
        return $errorEmail;
    }

    protected function setAddress(string $address): int {
        $errorAddress = Check::validate($address);
        if ($errorAddress != 0) {
            print Check::getErrorMessage($errorAddress);
        } else {
            $this->address = $address;
            print "<br>La dirección es: " . $address;
        }
        return $errorAddress;
    }

    protected function setDni(string $dni): int {
        $errorDni = Check::checkDNI($dni);
        if ($errorDni != 0) {
            print Check::getErrorMessage($errorDni);
        } else {
            $this->dni = $dni;
            print "<br>El DNI es: " . $dni;
        }
        return $errorDni;
    }

    protected function setNumber(string $number): int {
        $errorNumber = Check::validate($number);
        if ($errorNumber != 0) {
            print Check::getErrorMessage($errorNumber);
        } else {
            $this->number = $number;
            print "<br>El número es: " . $number;
        }
        return $errorNumber;
    }

    protected function setAntiquity(string $antiquity): int {
        $errorAntiquity = Check::validate($antiquity);
        if ($errorAntiquity != 0) {
            print Check::getErrorMessage($errorAntiquity);
        } else {
            $this->antiquity = $antiquity;
            print "<br>La antigüedad es: " . $antiquity;
        }
        return $errorAntiquity;
    }

    public abstract function getContactData(): string;
}
*/
/* GUARDAR ESTO POR SI JOSE ME DICE QUE REFACTORIZE POR 5 VEZ
abstract class Person {
    protected string $name;
    protected string $surname;
    protected string $email;
    protected string $address;
    protected string $dni;
    protected string $number;
    protected string $antiquity;
    protected bool $create=true;
    
    
    public function __construct(string $name,string $surname, string $email, string $address, string $dni, string $number, string $antiquity) {
        
        
        $errorName = Check::validate($name);
        if ($errorName == 0) {
            $this->name($name);
            print "<br>El nombre es: " . $name;
        } else {
            $this->create = false;
            print Check::getErrorMessage($errorName);
        }
        
        $errorSurname= Check::validate($surname);
        if ($errorSurname == 0) {
            $this->name($surname);
            print "<br>El apellido es: " . $surname;
        } else {
            $this->create = false;
            print Check::getErrorMessage($errorSurname);
        }
        
        $errorEmail= Check::checkEmail($email);
        if ($errorEmail == 0) {
            $this->name($email);
            print "<br>El email es: " . $email;
        } else {
            $this->create = false;
            print Check::getErrorMessage($errorEmail);
        }
        
        $errorAddress= Check::validate($address);
        if ($errorAddress == 0) {
            $this->name($address);
            print "<br>La dirección  es: " . $address;
        } else {
            $this->create = false;
            print Check::getErrorMessage($errorAddress);
        }
        
        $errorDni= Check::checkDNI($dni);
        if ($errorDni == 0) {
            $this->name($dni);
            print "<br>El DNI es: " . $dni;
        } else {
            $this->create = false;
            print Check::getErrorMessage($errorDni);
        }
        
        $errorNumber= Check::validate($number);
        if ($errorNumber == 0) {
            $this->name($number);
            print "<br>El numero es: " . $number;
        } else {
            $this->create = false;
            print Check::getErrorMessage($errorNumber);
        
        }
        
        $errorAntiquity= Check::validate($antiquity);
        if ($errorAntiquity == 0) {
            $this->name($antiquity);
            print "<br>La antiguedad es: " . $errorAntiquity;
        } else {
            $this->create = false;
            print Check::getErrorMessage($errorAntiquity);
        
        }
        
        if (!$this->create) {
            throw new BuildException("Not posible create this object(Person): ");
        }
       
    }
    
    public function getName(): string {
        return $this->name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getDni(): string {
        return $this->dni;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function getAntiquity(): string {
        return $this->antiquity;
    }

    public function setName(string $name): void {
    
    $this->name = $name;
    
}

    public function setSurname(string $surname): void {
    $this->surname = $surname;
}

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function setDni(string $dni): void {
        $this->dni = $dni;
    }

    public function setNumber(string $number): void {
        $this->number = $number;
     }

    public function setAntiquity(string $antiquity): void{
          $this->antiquity = $antiquity;
    }

        
    public abstract function getContactData():string;
}
*/