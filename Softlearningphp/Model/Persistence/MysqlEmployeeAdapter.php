<?php

include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/persistence/MysqlAdapter.php');

class MysqlEmployeeAdapter extends MysqlAdapter {

    public function getEmployee(string $dni): Employee {
        $data = $this->readQuery("SELECT name, surname, email, address, dni, number, antiquity,contractday, idemployee  FROM employee WHERE dni ='" . $dni . "';");
        if (count($data) > 0) {
            return new Employee($data[0]["name"], $data[0]["surname"], $data[0]["email"], $data[0]["address"],
                    $data[0]["dni"], $data[0]["number"], $data[0]["antiquity"], $data[0]["contractday"], $data[0]["idemployee"]);
        } else {
            throw new ServiceException("Not Employee found with dni = " . $dni);
        }
    }

    public function deleteEmployee(string $dni): bool {
        try {
            return $this->writeQuery("DELETE FROM employee WHERE dni = '" . $dni . "';");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al borrar el cliente con dni " . $dni . "-->" . $ex->getMessage());
        }
    }

    public function addEmployee(Employee $c): bool {
        try {
            return $this->writeQuery("INSERT INTO employee (name, surname, email, address, dni, number, antiquity, contractday, idemployee)" .
                            " VALUES ('" . $c->getName() . "','" . $c->getSurname() . "','" . $c->getEmail() . "','" .
                            $c->getAddress() . "','" . $c->getDni() . "','" . $c->getNumber() . "','" .
                            $c->getAntiquity() . "','" . $c->getContractday() ."','". $c->getIdemployee() . "');");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al insertar Employee -->" . $ex->getMessage());
        }
    }

    public function updateEmployee(Employee $c): bool {
        try {
            return $this->writeQuery("UPDATE employee SET name = '" . $c->getName() . "'," .
                            "surname = '" . $c->getSurname() . "'," .
                            "email = '" . $c->getEmail() . "'," .
                            "address = '" . $c->getAddress() . "'," .
                            "number = '" . $c->getNumber() . "'," .
                            "antiquity = '" . $c->getAntiquity() . "'," .
                            "contractday = '" . $c->getContractday() . "'," .
                            "idemployee = '" . $c->getIdemployee() . "'" .
                            " WHERE dni = '" . $c->getDni() . "';");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al actualizar Employee -->" . $ex->getMessage());
        }
    }

    public function authentication(string $email, string $dni): Employee {
        try {
            $result = $this->readQuery("SELECT dni FROM employee WHERE email='" . $email . "' AND password='" . $dni . "';");
            if (count($result) > 0) {
                return $this->getClient($result[0]["dni"]);
            } else {
                throw new ServiceException("Dni o Email incorrecto");
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al autenticar Employee -->" . $ex->getMessage());
        }
    }

    public function exists(string $dni): bool {
        try {
            $result = $this->readQuery("SELECT dni FROM employee WHERE dni='" . $dni . "';");
            return count($result) > 0;
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al verificar cliente -->" . $ex->getMessage());
        }
    }

}
