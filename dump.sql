CREATE DATABASE eco

CREATE TABLE usuario (
    id serial primary key unique ,
	nome text,
  sobrenome text,
	email text unique,
	eco_saldo numeric,
  cpf numeric unique,
  cep integer,
  rua text,
  bairro text,
  numero text
);

CREATE TABLE tipo_residuo (
	id serial primary key unique ,
	name text
);

CREATE TABLE material (
	id serial primary key unique ,
	name text,
  unidade_medida text,
	eco_valor numeric,
	tipo_residuo_id integer references tipo_residuo(id)
);

CREATE TABLE entrega_material_usuario (
	id serial primary key unique,
  usuario_id integer references usuario(id),
  material_id integer references material(id),
  quantidade numeric,
  eco_valor numeric
);

CREATE TABLE produto (
	id serial primary key unique,
  nome text,
  eco_valor numeric,
  quantidade integer
);

CREATE TABLE produto_entrada (
	id serial primary key unique,
  quantidade integer,
  real_valor numeric,
  produto_id integer references produto(id)
);

CREATE TABLE produto_saida (
	id serial primary key unique,
  quantidade integer,
  usuario_id integer references usuario(id),
  produto_id integer references produto(id),
  eco_valor numeric
);

CREATE TABLE extrato (
	entrega_material_usuario_id integer references entrega_material_usuario(id),
	produto_saida_id integer references produto_saida(id),
    usuario_id integer references usuario(id)
);




