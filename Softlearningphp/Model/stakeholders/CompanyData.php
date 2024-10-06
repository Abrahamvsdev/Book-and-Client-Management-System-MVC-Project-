<?php


class CompanyData {
    
    protected int $workers;
    protected string $socialreason;
    protected string $companyType;
    
    public function __construct(int $workers, string $socialreason) {
        $this->setWorkers($workers);
        $this->socialreason = $socialreason;
        
    }

    
    
    
    public function getWorkers(): int {
        return $this->workers;
    }

    public function getSocialreason(): string {
        return $this->socialreason;
    }

    public function getCompanyType(): string {
        return $this->companyType;
    }

    public function setWorkers(int $workers): int {
        $this->workers = $workers;
        
        if($workers>250){
            $this->companyType="Big Company";
        }else if($workers<=50){
            $this->companyType="Small Company";
        }else {
            $this->companyType="Medium Company";
        }
    }

    public function setSocialreason(string $socialreason): string {
        $this->socialreason = $socialreason;
    }

    public function setCompanyType(string $companyType): string {
        $this->companyType = $companyType;
    }

 
    
}
    
    
    

