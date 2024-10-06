<?php

//include 'Person.php';
include_once '../../model/operations/Check.php';
include_once 'Stakeholder.php';

class Client extends Person implements Marketable{

    protected string $paymentmode;
     protected bool $create = true;

    public function __construct(string $name,string $surname, string $email, string $address, string $dni, string $number, string $antiquity, string $paymentmode) {
        try{
           parent::__construct($name,$surname,$email,$address, $dni, $number,$antiquity); //crida explícita al mètode constructor de Persona, se entiende ident en este caso como DNI
        
           
        }catch(BuildException $ex) {
    
            print $ex->getMessage();
}           
        
        if (($error=$this->setPaymentcode($paymentmode))!=0){
             $this->create = false;
        }
        
        if (!$this->create) {
            throw new BuildException("Not possible to create the client.");
        }
        
    } 
    
    public function getPaymentmode(): string {
        return $this->paymentmode;
    }

    public function setPaymentcode(string $paymentmode):int {
        
        $errorPaymentmode = Check::validate($paymentmode);
        if ($errorPaymentmode != 0) {
            print Check::getErrorMessage($errorWeight);
        } else {
            $this->paymentmode = $paymentmode;
            print "<br> El peso de este libro es: " . $paymentmode;
        }
        return $errorPaymentmode;
    }

    
    public function getContactData(): string {
        return $this->getName() . ',<br>' . $this->getSurname() . ',<br>' . $this->getEmail() . ',<br>' . $this->getAddress() . ',<br>' . $this->getNumber() . ',<br>' . $this->getPaymentcode();
    }

    public function getDelayPay() {
        return $this->delayPay;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function getType() {
        return $this->getType;
    }

    public function getPayMethod() {
        return $this->paymethod;
    }

    public function getVendor() {
        return $this->vendor;
    }


    public function hasDelayPay() {
        
    }
}
