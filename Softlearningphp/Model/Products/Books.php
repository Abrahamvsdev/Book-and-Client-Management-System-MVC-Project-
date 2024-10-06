<?php

include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/Products/Product.php');
include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/Products/Dimensions.php');

include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/Products/Storable.php');
//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/Exceptions/CheckData/BuildException.php');

class Books extends Product implements Storable {

    protected DateTime $date;
    protected string $author;
    protected string $isbn;
    protected string $cover;
    protected string $page;
    protected string $genre;
    protected string $editorial;
    protected Dimensions $Dim;
    protected bool $fragile;
    protected bool $create = true;

    public function __construct(string $ident, float $price, string $date,
            string $author, string $isbn, string $cover, string $page, string $genre, string $editorial,
            float $weight, float $height, float $width, float $length) {
        try {
            parent::__construct($ident, $price);
        } catch (BuildException $ex) {
            $errors .= $ex->getMessage();
        }

        try {
            $this->Dim = new Dimensions($weight, $height, $width, $length);
        } catch (Exception $ex) {
            throw new BuildException($ex->getMessage());
        }

        $errors = '';

        if ($this->setDate($date) !== 0) {
            $errors .= Check::getErrorMessage(Check::checkDate($date)) . "\n";
        }

        if ($this->setAuthor($author) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($author)) . "\n";
        }

        if ($this->setIsbn($isbn) !== 0) {
            $errors .= Check::getErrorMessage(Check::checkISBN($isbn)) . "\n";
        }

        if ($this->setCover($cover) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($cover)) . "\n";
        }

        if ($this->setPage($page) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($page)) . "\n";
        }

        if ($this->setGenre($genre) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($genre)) . "\n";
        }

        if ($this->setEditorial($editorial) !== 0) {
            $errors .= Check::getErrorMessage(Check::validate($editorial)) . "\n";
        }

        if (!empty($errors)) {
            throw new BuildException("Not possible to create the book(libro): \n" . $errors);
        }
    }
    
    
    public function getAuthor(): string {
        return $this->author;
    }
    public function getIsbn(): string {
        return $this->isbn;
    }

    public function getCover(): string {
        return $this->cover;
    }

    public function getPage(): string {
        return $this->page;
    }

    public function getGenre(): string {
        return $this->genre;
    }

    public function getEditorial(): string {
        return $this->editorial;
    }

    public function getDate(): string {
        return $this->date->format('Y-m-d');
    }

    public function getDim(): Dimensions {
        return $this->Dim;
    }

    public function setAuthor(string $author): int {
        $errorAuthor = Check::validate($author);
        if ($errorAuthor == 0) {
            $this->author = $author;
        }
        return $errorAuthor;
    }

    public function setDate(string $date): int {
        $errorDate = Check::checkDate($date);
        if ($errorDate == 0) {
            $this->date = new DateTime($date);
        }
        return $errorDate;
    }

    public function setIsbn(string $isbn): int {
        $errorIsbn = Check::checkISBN($isbn);
        if ($errorIsbn == 0) {
            $this->isbn = $isbn;
        }
        return $errorIsbn;
    }

    public function setCover(string $cover): int {
        $errorCover = Check::validate($cover);
        if ($errorCover == 0) {
            $this->cover = $cover;
        }
        return $errorCover;
    }

    public function setPage(string $page): int {
        $errorPage = Check::validate($page);
        if ($errorPage == 0) {
            $this->page = $page;
        }
        return $errorPage;
    }

    public function setGenre(string $genre): int {
        $errorGenre = Check::validate($genre);
        if ($errorGenre == 0) {
            $this->genre = $genre;
        }
        return $errorGenre;
    }

    public function setEditorial(string $editorial): int {
        $errorEditorial = Check::validate($editorial);
        if ($errorEditorial == 0) {
            $this->editorial = $editorial;
        }
        return $errorEditorial;
    }

    public function setDim(Dimensions $Dim): void {
        $this->Dim = $Dim;
    }

    public function isFragile(): bool {
        return $this->fragile;
    }

    public function volume(): float {
        return $this->Dim->getVolume();
    }

    public function getDetails(): string {
        return "ID: " . $this->getIdent() . "\n" .
                "Price: $" . number_format($this->getPrice(), 2) . "\n" .
                "Author: " . $this->getAuthor() . "\n" .
                "ISBN: " . $this->getIsbn() . "\n" .
                "Cover: " . $this->getCover() . "\n" .
                "Pages: " . $this->getPage() . "\n" .
                "Genre: " . $this->getGenre() . "\n" .
                "Editorial: " . $this->getEditorial() . "\n" .
                "Date: " . $this->getDate() . "\n" .
                "Dimensions (WxHxL): " . $this->getDim()->getWidth() . "x" . $this->getDim()->getHeight() . "x" . $this->getDim()->getLength() . " cm\n" .
                "Weight: " . $this->getDim()->getWeight() . " kg\n";
    }

    public function isFlexible(): bool {
        return $this->isFlexible();
    }

    public function isHeavy(): bool {
        return $this->isHeavy();
    }
}
