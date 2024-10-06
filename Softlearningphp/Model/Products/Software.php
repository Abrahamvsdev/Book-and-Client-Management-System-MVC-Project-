<?php

include_once '../../Products/Product.php';

class Software extends Product {

    protected float $price;
    protected string $ident;
    protected DateTime $releaseDate;
    protected string $softwareVersion;

    public function __construct(string $ident, float $price, string $releaseDate, string $softwareVersion) {
$errors = '';
        try {
            parent::__construct($ident, $price);
        } catch (BuildException $ex) {
            $errors .= $ex->getMessage();
        }

        if ($this->setReleaseDate($releaseDate) !== 0) {
            $errors .= Check::getErrorMessage(Check::setReleasetDate($releaseDate)) . "<br>";
            
        }

        if ($this->setSoftwareVersion($softwareVersion) !== 0) {
            $errors .= Check::getErrorMessage(Check::checkSoftwareVersion($softwareVersion)) . "<br>";
        }

        if (!empty($errors)) {
            throw new BuildException("Not possible to create this object (Sofware): <br>" . $errors);
        }
        
        
    }
    
    public function getReleaseDate(): string {
        return $this->releaseDate->format('m-d-Y');
    }
    
    

    public function getSoftwareVersion(): string {
        return $this->softwareVersion;
    }

    public function setReleaseDate(string $releaseDate): int {
        $errorReleaseDate = Check::setReleasetDate($releaseDate);
        
        if ($errorReleaseDate == 0) {
            
            $this->releaseDate = new DateTime($releaseDate);
        }
        return $errorReleaseDate;
    }
   
    public function setSoftwareVersion(string $softwareVersion): int {
        $errorSoftwareVersion = Check::validate($softwareVersion);
        if ($errorSoftwareVersion == 0) {
            $this->softwareVersion =$softwareVersion;
        }
        return $errorSoftwareVersion;
    }
    
        public function getDetails(): string {
        return "ID: " . $this->getIdent() . "\n" .
                "Price: $" . number_format($this->getPrice(), 2) . "\n" .
                "Fecha de salida:: " . $this->getReleaseDate() . "\n" .
                "Software version: " . $this->getSoftwareVersion() . "\n" ;
              
    }

}
