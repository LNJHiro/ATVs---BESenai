-- ======================= -- 
--   BANCO DE DADOS --
-- ======================= --

create database	REMOTERC;
 use REMOTERC;
 select database();
 
 create table produto (
 codigo int not null auto_increment,
 unidade char(3) not null, 
 descricao varchar(30) not null,
 valor_unit decimal (7,2) not null,
 primary key (codigo)
 );
 
 
 INSERT INTO produto
values 
(1,'UN',  'Teclado', 35.00),
(2,'UN', 'Mouse', 25.00),
(3,'UN', 'HD', 350.00);

select * from produto;

-- ATUALIZAR O PRODUTO 
update produto
set valor_unit = 28.00,
descricao = 'Mouse Branco'
where codigo = 2;

-- REGISTRO MULTIPLO
update	produtos set valor_unit = valor_unit + (valor_unit * 0.10);


create table vendedor (
codigo int not null,
nome varchar(20) not null,
salario decimal(7,2) not null,
fsalarial char(1) not null,
primary key (codigo)
);

select * from vendedor;

 INSERT INTO vendedor
values 
(1,'Thiago', 1800.00, 1),
(2,'Eduardo', 2800.00, 2),
(3,'Brenda', 3800.00, 3);

update vendedor set salario = 3150.00
where fsalarial = 1;

update vendedor set salario = salario + (salario * 0.10)
where fsalarial = 2;

delete FROM	vendedor 
where salario < 3100.00;


delete from produto;
 -- registro unico
 delete from  produto
 where pcod = '01';
 
 delete from vendedor
 where fsalarial =2;
 
 -- intervalo (operador and)
 delete from vendedor
 where fsalarial >= 1 
 and codigo <=2;