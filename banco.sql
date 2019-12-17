CREATE TABLE acesso (
  id_view INTEGER UNSIGNED NOT NULL,
  id_perfil BIGINT(19) NOT NULL,
  visualizar INTEGER UNSIGNED NULL,
  cadastrar INTEGER UNSIGNED NULL,
  alterar INTEGER UNSIGNED NULL,
  excluir INTEGER UNSIGNED NULL,
  PRIMARY KEY(id_view)
);

CREATE TABLE modulo (
  id_modulo BIGINT(19) NOT NULL AUTO_INCREMENT,
  str_modulo VARCHAR(100) NOT NULL,
  PRIMARY KEY(id_modulo)
);

CREATE TABLE perfil (
  id_perfil BIGINT(19) NOT NULL AUTO_INCREMENT,
  str_perfil VARCHAR(100) NULL,
  PRIMARY KEY(id_perfil)
);

CREATE TABLE usuario (
  id_usuario BIGINT(19) NOT NULL AUTO_INCREMENT,
  id_perfil BIGINT(19) NULL,
  str_nome VARCHAR(50) NOT NULL,
  str_login BIGINT(19) NOT NULL,
  str_senha BIGINT(100) NOT NULL,
  dt_criacao DATETIME NULL,
  str_situacao CHAR(1) NOT NULL,
  PRIMARY KEY(id_usuario)
);

CREATE TABLE view (
  id_view INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_modulo BIGINT(19) NOT NULL,
  str_view VARCHAR(200) NOT NULL,
  PRIMARY KEY(id_view)
);


