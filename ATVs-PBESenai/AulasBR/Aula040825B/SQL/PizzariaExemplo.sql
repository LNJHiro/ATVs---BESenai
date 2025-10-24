create database Pizzaria;

use Pizzaria;

create table Funcionario (
id_Funcionario int primary key,
Data_Nascimento int(4),
Nome_Funcionario varchar(255),
Salario int,
Funcao varchar(30)
);

create table Produto (
id_Produto int primary key,
Quantidade int(99),
Investimento_em_Despesas int,
Validade int
);

create table Clientes (
id_Clientes int primary key,
Numero_Celular int(11),
Nome_Cliente varchar(30),
Endereco varchar(255)
);

create table Administracao (
id_Admin int primary key,
Faturamento int,
Funcionarios varchar(255),
Despesas int
);
