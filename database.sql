drop database if exists segver;
create database segver;

use segver;

drop table if exists usuario;

create table usuario (
  usuario varchar(20) DEFAULT NULL,
  senha varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into usuario VALUES ('admin','admin@123');