<?php

include_once 'Person.php';
include_once 'Storable.php';
include_once 'CompanyData.php';

class Provider extends Person implements Storable{
   
    protected string $sponsors;
    protected CompanyData $comp;//este el compuesto
   
    public function __construct(string $name, string $surname, string $email, string $number, string $address, string $antiquity, string $ident,
            string $sponsors,int $workers, string $socialreason) {
        parent::__construct($name, $surname, $email, $number, $address, $antiquity, $ident);//crida explícita al mètode constructor de Persona
        $this->sponsors = $sponsors;
        $this->comp = new CompanyData($workers,$socialreason);//este es el compuesto
        
    }
   
    //implementacion etodos publicos para companydata
    
    
    
    public function getWorkers():int {
        return $this->comp->getWorkers();
    }
    
    public function getSocialReason():string {
        return $this->comp->getSocialReason();
    }
    
    public function setSocialReason (string $socialreason):string{
        $this->comp->setSocialReason($socialreason);
    }
    
    public function setWorkers(int $workers): int{
        $this->comp->setWorkers($workers);
    }
    
    
    
    public function getCompanyType():string{
        return $this->comp->getCompanyType();
    }
    
    
    
    
    
    public function getSponsors(): string {
        return $this->sponsors;
    }

    public function setSponsors(string $sponsors): int {
    if(Check::contarVaciar($sponsors) == false){
        return -2;
    }
    $this->sponsors = $sponsors;
    return 0; 
}

    public function getContactData(): string {
        return $this->getName() . ', ' . $this->getSurname() . ', ' . $this->getEmail() . ', ' .$this->getNumber()  . ', ' . $this->getAddress()
        . ', ' . $this->getAntiquity() . ', ' . $this->getIdent() . ', '. $this->getSponsors();
    }

    public function flexible() {
        return $this->flexible;
    }

    public function fragile() {
        return $this->fragile;
    }

    public function heavy() {
        return $this->heavy;
    }

    public function volume() {
        return $this->volume;
    }
}
