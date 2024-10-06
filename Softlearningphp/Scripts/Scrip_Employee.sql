

CREATE TABLE employee (
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    dni CHAR(9) NOT NULL,
    number VARCHAR(255) NOT NULL,
    antiquity VARCHAR(255) NOT NULL,
    contractday DATETIME(6) NOT NULL,
    idemployee varchar(255) not null,
    PRIMARY KEY (dni));