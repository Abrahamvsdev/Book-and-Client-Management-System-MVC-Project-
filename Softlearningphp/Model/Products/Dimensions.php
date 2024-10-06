<?php




class Dimensions {
    protected float $weight;
    protected float $height;
    protected float $width;
    protected float $length;
    protected float $volume;
    protected bool $create = true;

    public function __construct(float $weight, float $height, float $width, float $length) {
        $errors = '';

        if ($this->setWeight($weight) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($weight)) . "\n";
        }

        if ($this->setHeight($height) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($height)) . "\n";
        }

        if ($this->setWidth($width) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($width)) . "\n";
        }

        if ($this->setLength($length) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($length)) . "\n";
        }

        if (!empty($errors)) {
            throw new BuildException("Not possible to create the dimensions: \n" . $errors);
        }
    }

    public function getWeight(): float {
        return $this->weight;
    }

    public function getHeight(): float {
        return $this->height;
    }

    public function getWidth(): float {
        return $this->width;
    }

    public function getLength(): float {
        return $this->length;
    }

    public function setWeight(float $weight): int {
        $errorWeight = Check::validate($weight);
        if ($errorWeight == 0) {
            $this->weight = $weight;
        }
        return $errorWeight;
    }

    public function setHeight(float $height): int {
        $errorHeight = Check::validate($height);
        if ($errorHeight == 0) {
            $this->height = $height;
        }
        return $errorHeight;
    }

    public function setWidth(float $width): int {
        $errorWidth = Check::validate($width);
        if ($errorWidth == 0) {
            $this->width = $width;
        }
        return $errorWidth;
    }

    public function setLength(float $length): int {
        $errorLength = Check::validate($length);
        if ($errorLength == 0) {
            $this->length = $length;
        }
        return $errorLength;
    }

    public function getVolume(): float {
        return $this->width * $this->height * $this->length;
    }

    public function getDetails(): string {
        return "Height: " . $this->getHeight() . " cm\n" .
               "Weight: " . $this->getWeight() . " kg\n" .
               "Width: " . $this->getWidth() . " cm\n" .
               "Length: " . $this->getLength() . " cm\n" .
               "Volume: " . $this->getVolume() . " cubic cm";
    }
}











































/*
class Dimensions {
    protected float $weight;
    protected float $height;
    protected float $width;
    protected float $length;
    protected float $volume;
    protected bool $create = true;

    public function __construct(float $weight, float $height, float $width, float $length) {
        if ($this->setWeight($weight) !== 0) {
            $this->create = false;
        }

        if ($this->setHeigth($height) !== 0) {
            $this->create = false;
        }

        if ($this->setWidth($width) !== 0) {
            $this->create = false;
        }

        if ($this->setLength($length) !== 0) {
            $this->create = false;
        }

        if (!$this->create) {
            throw new BuildException("Not possible to create the dimensions.");
        }
    }

    public function getWeight(): float {
        return $this->weight;
    }

    public function getHeight(): float {
        return $this->heigth;
    }

    public function getWidth(): float {
        return $this->width;
    }

    public function getLength(): float {
        return $this->length;
    }

    public function setWeight(float $weight): int {
        $errorWeight = Check::validate($weight);
        if ($errorWeight != 0) {
            print Check::getErrorMessage($errorWeight);
        } else {
            $this->weight = $weight;
            print "<br> El peso de este libro es: " . $weight;
        }
        return $errorWeight;
    }

    public function setheight(float $heigth): int {
        $errorHeigth = Check::validate($heigth);
        if ($errorHeigth != 0) {
            print Check::getErrorMessage($errorHeigth);
        } else {
            $this->heigth = $heigth;
            ;
        }
        return $errorHeigth;
    }

    public function setWidth(float $width): int {
        $errorWidth = Check::validate($width);
        if ($errorWidth != 0) {
            print Check::getErrorMessage($errorWidth);
        } else {
            $this->width = $width;
            print "<br>El ancho de este libro es: " . $width;
        }
        return $errorWidth;
    }

   public function setLength(float $length): int {
        $errorLength = Check::validate($length);
        if ($errorLength != 0) {
            print Check::getErrorMessage($errorLength);
        } else {
            $this->length = $length;
            print "<br>El largo de este libro es: " . $length;
        }
        return $errorLength;
    }

    public function getVolume(): float {
        return $this->width * $this->heigth * $this->length;
    }

    public function getDetails(): string {
        return "Heigth: " . $this->getHeigth() . ", Weight: " . $this->getWeight() . ", Width: " . $this->getWidth() . ", Length: " . $this->getLength();
    }
}
*/


/*
class Dimensions {

    protected float $weight;
    protected float $heigth;
    protected float $width;
    protected float $length;
    protected float $volume;
    protected bool $create=true;

    public function __construct(float $weight, float $heigth, float $width, float $length) {

        $errorWeight = Check::validate($weight);
        if ($errorWeight != 0) {
            print Check::getErrorMessage($errorWeight);
            $this->create = false;
        } else {
            $this->setWeight($weight);
            print "<br> El peso de este libro es: " . $weight;
        }

        $errorHeigth = Check::validate($heigth);
        if ($errorHeigth == 0) {
            $this->setHeigth($heigth);
            print "<br>La altura de este libro es: " . $heigth;
        } else {
            print Check::getErrorMessage($errorHeigth);
            $this->create = false;
        }
        $errorWidth = Check::validate($width);
        if ($errorWidth == 0) {
            $this->setWidth($width);
            print "<br>El ancho de este libro es: " . $width;
        } else {
            print Check::getErrorMessage($errorWidth);
            $this->create = false;
        }

        $errorLength = Check::validate($length);
        if ($errorLength == 0) {

            print "<br>El largo de este libro es: " . $length;
        } else {
            $this->create = false;
            print Check::getErrorMessage($errorLength);
        }
    }

    public function getWeight(): string {
        return $this->weight;
    }

    public function getHeigth(): string {
        return $this->heigth;
    }

    public function getWidth(): string {
        return $this->width;
    }

    public function setWeight(float $weight): void {
        $this->weight = $weight;
    }

    public function setHeigth(float $heigth): void {
        $this->heigth = $heigth;
    }

    public function setWidth(float $width): void {
        $this->width = $width;
    }

    public function getVolume(): float {
        $volume = $this->width * $this->heigth * $this->weight;
        return $this->volume = $this->width * $this->heigth * $this->weight;
    }

    public function getDetails() {
        return $this->getHeigth() . $this->getWeight() . $this->getWidth();
    }
}
*/