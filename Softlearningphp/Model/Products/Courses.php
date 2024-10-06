<?php

include_once 'Product.php';
//include_once '../../model/operations/Check.php';

class Courses extends Product {

    protected string $language;
    protected string $duration;
    protected string $platform;
    

    public function __construct(string $language, string $duration, string $platform, string $ident, string $code, float $price) {
        $message = "";

        try {
            parent::__construct($ident, $code, $price);
        } catch (BuildException $ex) {
            $ex->getMessage();
        }



        if (($error = $this->language($language)) != 0) {
            $message .= "BadLanguage;" . Check::getErrorMessage($error) . "<br>";
        }
        
        if (($error = $this->duration($duration)) != 0) {
            $message .= "BadDuration;" . Check::getErrorMessage($error) . "<br>";
        }
        
        if (($error = $this->platform($platform)) != 0) {
            $message .= "BadPlatform;" . Check::getErrorMessage($error) . "<br>";
        }

       
        if (strlen($message) > 0) {
            throw new BuildException("Not posible create the object: " . $message);
        }
    }

    public function getDuration(): string {
        return $this->duration;
    }

    public function getPlatform(): string {
        return $this->platform;
    }

    public function getType(): string {
        return $this->type;
    }

    public function setDuration(string $duration): string {
        if (Check::spaceAndTrim($duration) == false) {
            return -2;
        }
        $this->duration = $duration;
        return 0;
    }

    public function setPlatform(string $platform): string {
        if (Check::spaceAndTrim($platform) == false) {
            return -2;
        }
        $this->platform = $platform;
        return 0;
    }

    public function setType(string $type): string {
        if (Check::spaceAndTrim($type) == false) {
            return -2;
        }
        $this->type = $type;
        return 0;
    }

    public function delayPay() {
        return $this->delayPay;
    }

    public function discount() {
        return $this->discount;
    }

    public function payMethod() {
        return $this->payMethod;
    }

    public function getDetails(): mixed {
        return $this->getPlatform() . $this->getDuration() . $this->getType();
    }
}
