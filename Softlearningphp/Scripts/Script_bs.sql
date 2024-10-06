

usuario $this->connection = new mysqli("127.0.0.1", "Abraham", "Temporal1", "softlearning", 3306);

CREATE table book( id int not null AUTO_INCREMENT, author varchar(255) not null, isbn varchar(255) not null, cover varchar(255) not null, 
page int(11) not null, genre varchar(255) not null, editorial varchar(255) not null, weight float not null, height float not null, length float not null, Width float not null,
 ident float not null, price float not null, fecha datetime not null, volume float not null, primary key(id) );

/*
Jose cree las dimensions con el nombre de "heiht" mal escrito lo tengo asi en todas las funciones, introducelo asi en el query de la DB.
*/