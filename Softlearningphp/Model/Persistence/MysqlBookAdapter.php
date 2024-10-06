<?php

include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/persistence/MysqlAdapter.php');

class MysqlBookAdapter extends MysqlAdapter {

    public function getBook(int $isbn): Books {
        $data = $this->readQuery("SELECT author, isbn, cover, page, genre, editorial, weight, height, width, 
                                  length, ident, price, fecha, volume FROM book WHERE isbn = " . $isbn . ";");
        if (count($data) > 0) {
            return new Books($data[0]["ident"], (float) $data[0]["price"], $data[0]["fecha"],
                    $data[0]["author"], $data[0]["isbn"], $data[0]["cover"], $data[0]["page"],
                    $data[0]["genre"], $data[0]["editorial"], (float) $data[0]["weight"],
                    (float) $data[0]["height"], (float) $data[0]["width"], (float) $data[0]["length"]);
        } else {
            throw new ServiceException("No book found with ISBN = " . $isbn);
        }
    }

    public function deleteBook(int $isbn): bool {
        try {
            return $this->writeQuery("DELETE FROM book WHERE isbn = " . $isbn . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al borrar el libro con isbn " . $isbn . "-->" .
                            $ex->getMessage());
        }
    }

    public function addBook(Books $u): bool {
        try {
            $query = "INSERT INTO book (author, isbn, cover, page, genre, editorial, weight, heigth, width, lenght, ident, price, fecha, volume) VALUES (" .
                    "'" . $u->getAuthor() . "', " .
                    "'" . $u->getIsbn() . "', " .
                    "'" . $u->getCover() . "', " .
                    "'" . $u->getPage() . "', " .
                    "'" . $u->getGenre() . "', " .
                    "'" . $u->getEditorial() . "', " .
                    $u->getDim()->getWeight() . ", " .
                    $u->getDim()->getHeight() . ", " .
                    $u->getDim()->getWidth() . ", " .
                    $u->getDim()->getLength() . ", " .
                    "'" . $u->getIdent() . "', " .
                    $u->getPrice() . ", " .
                    "'" . $u->getDate() . "', " .
                    $u->volume() .
                    ");";

            return $this->writeQuery($query);
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al insertar libro --> " . $ex->getMessage());
        }
    }

    public function updateBook(Books $u): bool {
        try {
            $query = "UPDATE book SET " .
                    "author = '" . $u->getAuthor() . "', " .
                    "cover = '" . $u->getCover() . "', " .
                    "page = '" . $u->getPage() . "', " .
                    "genre = '" . $u->getGenre() . "', " .
                    "editorial = '" . $u->getEditorial() . "', " .
                    "weight = " . $u->getDim()->getWeight() . ", " .
                    "height = " . $u->getDim()->getHeigth() . ", " .
                    "width = " . $u->getDim()->getWidth() . ", " .
                    "length = " . $u->getDim()->getLength() . ", " .
                    "ident = '" . $u->getIdent() . "', " .
                    "price = " . $u->getPrice() . ", " .
                    "fecha = '" . $u->getDate() . "', " .
                    "volume = " . $u->volume() .
                    " WHERE isbn = '" . $u->getIsbn() . "';";

            return $this->writeQuery($query);
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al actualizar libro --> " . $ex->getMessage());
        }
    }

    public function authentication(string $isbn): Books {
        try {
            $result = $this->readQuery("SELECT isbn FROM book WHERE isbn='" . $isbn . ";");
            if (count($result) > 0) {
                return $this->getBook((int) $result[0]["isbn"]);
            } else {
                throw new ServiceException(" ISBN incorrect --> " . json_encode($result));
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error reading books --> " . $ex->getMessage());
        }
    }

    public function exists(string $isbn): bool {
        try {
            $isbn = $this->readQuery("SELECT isbn FROM book WHERE isbn='" . $isbn . "';");
            if (count($isbn) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir llibre -->" . $ex->getMessage());
        }
    }
}

/*

protected mysqli $connection;
    protected bool $connected = false;

    //Aprofitem el constructor per establir la connexió per defecte a la nostra BD
    public function __construct() {
        try {
             $this->connection = new mysqli("127.0.0.1", "Abraham", "Temporal1", "softlearning", 3306);
             $this->connected = true;
        } catch (mysqli_sql_exception $ex) {
             throw new ServiceException("<br>DB Connection Failure: " . $ex->getMessage());
        }
    }

    public function __destruct() {
        $this->closeConnection();
    }

    public function isConnected(): bool {
        return $this->connected;
    }

    //sempre podrem reconectar-nos a altres BD's aprofitant el mateix objecte
    public function connect(string $host, string $user, string $password, string $db, int $port){
        if ($this->connected == true) {
            $this->closeConnection();
        }
        try {
            $this->connection = new mysqli($host, $user, $password, $db, $port);
            $this->connected = true;
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("DB Connection Failure: " . $ex->getMessage());
        }
    }

    public function closeConnection() {
        if ($this->connected == true) {
            $this->connection->close();
            $this->connected = false;
        }
    }

    public function readQuery(string $query): array {
        $dataset = [];
        $result = $this->connection->query($query);
        if ($result != false) {
            while ($row = $result->fetch_assoc()) {
                $dataset[] = $row;
            }
        }
        return $dataset;
    }

    public function writeQuery(string $query): bool {
        $result = $this->connection->query($query);
        return $result;
    }
    
    public function executeQuery(string $query, array $params = []): bool{
        $stmt = $this->connection->prepare($query);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->connection->error);
        }
        
        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        
        $success = $stmt->execute();
        
        if (!$success) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }
        
        $stmt->close();
        
        return $success;
    }
    
    public function printData(string $query){
        $result = $this->readQuery($query);
        
        print "<br><br>";
        
        print "<table style=\"border: 1px solid black;\"><tbody>";
        
        foreach ($result as $book) {
            print "<tr style=\"border: 1px solid black;\">";
            
            foreach ($book as $key => $value) {
                print "<td style=\"border: 1px solid black;\">" . $value . "</td>";
            }
            
            print "</tr>";
        }
        
        print "</tbody></table>";
    }
   */ 
    
    