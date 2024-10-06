

CREATE TABLE clients (
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    dni CHAR(9) NOT NULL,
    number VARCHAR(255) NOT NULL,
    antiquity VARCHAR(255) NOT NULL,
    paymentmode VARCHAR(255) NOT NULL,
    PRIMARY KEY (dni)
);