<?php
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/persistence/MysqlAdapter.php');

class MysqlClientAdapter extends MysqlAdapter {

    public function getClient(string $dni): Client {
        $data = $this->readQuery("SELECT name, surname, email, address, dni, number, antiquity, paymentmode FROM clients WHERE dni ='" . $dni . "';");
        if (count($data) > 0) {
            return new Client($data[0]["name"], $data[0]["surname"], $data[0]["email"], $data[0]["address"],
                    $data[0]["dni"], $data[0]["number"], $data[0]["antiquity"], $data[0]["paymentmode"]);
        } else {
            throw new ServiceException("Not Client found with dni = " . $dni);
        }
    }

    public function deleteClient(string $dni): bool {
        try {
            return $this->writeQuery("DELETE FROM clients WHERE dni = '" . $dni . "';");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al borrar el cliente con dni " . $dni . "-->" . $ex->getMessage());
        }
    }

    public function addClient(Client $c): bool {
        try {
            return $this->writeQuery("INSERT INTO clients (name, surname, email, address, dni, number, antiquity, paymentmode)" .
                            " VALUES ('" . $c->getName() . "','" . $c->getSurname() . "','" . $c->getEmail() . "','" .
                            $c->getAddress() . "','" . $c->getDni() . "','" . $c->getNumber() . "','" .
                            $c->getAntiquity() . "','" . $c->getPaymentmode() . "');");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al insertar cliente -->" . $ex->getMessage());
        }
    }

    public function updateClient(Client $c): bool {
        try {
            return $this->writeQuery("UPDATE clients SET name = '" . $c->getName() . "'," .
                            "surname = '" . $c->getSurname() . "'," .
                            "email = '" . $c->getEmail() . "'," .
                            "address = '" . $c->getAddress() . "'," .
                            "number = '" . $c->getNumber() . "'," .
                            "antiquity = '" . $c->getAntiquity() . "'," .
                            "paymentmode = '" . $c->getPaymentmode() . "'" .
                            " WHERE dni = '" . $c->getDni() . "';");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al actualizar cliente -->" . $ex->getMessage());
        }
    }

    public function authentication(string $email, string $dni): Client {
        try {
            $result = $this->readQuery("SELECT dni FROM clients WHERE email='" . $email . "' AND password='" . $dni . "';");
            if (count($result) > 0) {
                return $this->getClient($result[0]["dni"]);
            } else {
                throw new ServiceException("Dni o Email incorrecto");
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al autenticar cliente -->" . $ex->getMessage());
        }
    }

    public function exists(string $dni): bool {
        try {
            $result = $this->readQuery("SELECT dni FROM clients WHERE dni='" . $dni . "';");
            return count($result) > 0;
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al verificar cliente -->" . $ex->getMessage());
        }
    }
}
