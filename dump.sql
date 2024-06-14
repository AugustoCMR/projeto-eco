CREATE DATABASE eco;

CREATE TABLE usuario (
 	id_usuario serial UNIQUE,
	nm_usuario varchar(40) NOT NULL,
	nm_email varchar(40) UNIQUE NOT NULL,
	vl_ecosaldo numeric DEFAULT 0,
  nu_cpf char(11) UNIQUE NOT NULL,
  nm_pais varchar(20) NOT NULL,
  nm_estado varchar(25) NOT NULL,
  nm_cidade varchar(25) NOT NULL,
  nu_cep char(20) NOT NULL,
  nm_rua varchar(50) NOT NULL,
  nm_bairro varchar(50) NOT NULL,
  nm_numero varchar(20) NOT NULL,
  
  CONSTRAINT pk_usuario PRIMARY KEY(id_usuario)
);

CREATE TABLE residuo (
	id_residuo serial UNIQUE,
  nm_residuo varchar(40) NOT NULL,
  
  CONSTRAINT pk_residuo PRIMARY KEY(id_residuo)
);

CREATE TABLE material (
	id_material serial UNIQUE,
	nm_material varchar(25) NOT NULL,
  nm_unidademedida varchar(10) NOT NULL,
	vl_eco numeric NOT NULL,
  id_residuo integer NOT NULL,
  
  CONSTRAINT fk_material_residuo FOREIGN KEY(id_residuo) REFERENCES residuo(id_residuo),
  CONSTRAINT pk_material PRIMARY KEY(id_material)
);

CREATE TABLE material_entregue (
	id_materialentregue serial UNIQUE,
  id_usuario integer NOT NULL,
  id_material integer NOT NULL, 
  qt_materialentregue numeric NOT NULL,
  vl_eco numeric NOT NULL,
  vl_saldoatual numeric NOT NULL,
  dt_criadoem TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
  
  CONSTRAINT fk_materialentregue_usuario FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario),
  CONSTRAINT fk_materialentregue_material FOREIGN KEY(id_material) REFERENCES material(id_material),
  CONSTRAINT pk_materialentregue PRIMARY KEY(id_materialentregue)
);

CREATE TABLE produto (
	id_produto serial UNIQUE,
  nm_produto varchar(25) NOT NULL,
  vl_eco numeric NOT NULL,
  qt_produto integer DEFAULT 0,
  
  CONSTRAINT pk_produto PRIMARY KEY(id_produto)
);

CREATE TABLE produto_entregue (
	id_produtoentregue serial UNIQUE,
  qt_produtoentregue integer NOT NULL,
  vl_real numeric NOT NULL,
  id_produto integer NOT NULL,
  
  CONSTRAINT fk_produtoentregue_produto FOREIGN KEY(id_produto) REFERENCES produto(id_produto),
  CONSTRAINT pk_produtoentregue PRIMARY KEY(id_produtoentregue)
);

CREATE TABLE produto_retirado (
	id_produtoretirado serial UNIQUE,
  qt_produtoretirado integer NOT NULL,
  id_usuario integer NOT NULL,
  id_produto integer NOT NULL,
  vl_eco numeric NOT NULL,
  vl_saldoatual numeric NOT NULL,
  dt_criadoem TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
  
  CONSTRAINT fk_produtoretirado_usuario FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario),
  CONSTRAINT fk_produtoretirado_produto FOREIGN KEY(id_produto) REFERENCES produto(id_produto),
  CONSTRAINT pk_produtoretirado PRIMARY KEY(id_produtoretirado)
);