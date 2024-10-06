<?php

declare(strict_types=1);

include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/Exceptions/ServiceException.php');

class MysqlAdapter {

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
    /*
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
}


