<?php



include_once 'client.php';
include_once 'CompanyData.php';

class ClientCompany extends Client{
    
    protected CompanyData $comp;
    
    public function __construct(string $name,string $surname, string $email, string $address, string $ident, string $number, string $antiquity, string $paymentcode,int $workers, string $socialreason) {
       try{
           parent::__construct($name, $surname, $email, $address, $ident, $number, $antiquity, $paymentcode);//heredad de cliente
       } catch (BuildException $ex) {
    print $ex->getMessage();
}
        
       try{
           $this->comp = new CompanyData($workers,$socialreason);//este es el compuesto
       }catch (BuildException $ex) {
    print $ex->getMessage();
}
        
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
    
    
    
    
    
    
}
