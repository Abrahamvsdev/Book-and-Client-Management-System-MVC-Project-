<?php

include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/Exceptions/BuildException.php');
include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/model/operations/Check.php');
include_once 'Marketable.php';

abstract class Product implements Marketable {

    protected string $ident;
    protected float $price;
    protected bool $create = true;

    public function __construct(string $ident, float $price) {
        $errors = '';

        if ($this->setIdent($ident) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($ident)) . "\n";
        }

        if ($this->setPrice($price) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($price)) . "\n";
        }

        if (!empty($errors)) {
            throw new BuildException("Not possible to create the product: \n" . $errors);
        }
    }

    public function getIdent(): string {
        return $this->ident;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function hasDelayPay() {
        return $this->delayPay;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function getType() {
        return $this->type;
    }

    public function getPayMethod() {
        return $this->payMethod;
    }

    public function setIdent(string $ident): int {
        $errorIdent = Check::validate($ident);
        if ($errorIdent == 0) {
            $this->ident = $ident;
        }
        return $errorIdent;
    }

    public function setPrice(float $price): int {
        $errorPrice = Check::validate($price);
        if ($errorPrice == 0) {
            $this->price = $price;
        }
        return $errorPrice;
    }

    public abstract function getDetails(): mixed;
}




/*

abstract class Product implements Marketable {

    protected string $ident;
    protected float $price;
    protected bool $create=true;

    public function __construct(string $ident, float $price) {
        

        if ($this->setIdent($ident) !== 0) {
            $this->create = false;
        }

        
        if ($this->setPrice($price) !== 0) {
            $this->create = false;
        }


        if (!$this->create) {
            throw new BuildException("Not posible create the product(fail in product)");
        }
    }

    public function getIdent(): string {
        return $this->ident;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function hasDelayPay() {
        return $this->delayPay;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function getType() {
        return $this->getType;
    }

    public function getPayMethod() {
        return $this->payMethod;
    }

    public function setIdent(string $ident): int {
        $errorIdent = Check::validate($ident);
        if ($errorIdent != 0) {
            print Check::getErrorMessage($errorIdent);
        } else {
            $this->ident = $ident;
        }

        return $errorIdent;
    }

    public function setPrice(float $price): int {
        $errorPrice = Check::validate($price);
        if ($errorPrice != 0) {
            print Check::getErrorMessage($errorPrice);
        } else {
            $this->price = $price;
        }

        return $errorPrice;
    }

    public abstract function getDetails(): mixed;
}
*/