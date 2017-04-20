DROP DATABASE IF EXISTS nexvf4wcb2h7psvd;
CREATE DATABASE nexvf4wcb2h7psvd;
USE nexvf4wcb2h7psvd;

CREATE TABLE instituicoes(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	cep CHAR(9) NOT NULL,
	endereco VARCHAR(255) NOT NULL,
	telefone VARCHAR(20) NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE cargos(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE funcionarios(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	sexo ENUM('M', 'F') NOT NULL,
	cpf CHAR(11) NOT NULL UNIQUE,
	rg CHAR(9) NOT NULL,
	data_nascimento DATE NOT NULL,
	endereco VARCHAR(255) NOT NULL,
	foto VARCHAR(255) NOT NULL,
	prontuario VARCHAR(255) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	remember_token CHAR(100),	
	deleted_at TIMESTAMP NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE telefones(
	id INT NOT NULL AUTO_INCREMENT,
	numero VARCHAR(16) NOT NULL,
	funcionario_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(id),
	CONSTRAINT FOREIGN KEY(funcionario_id)
	REFERENCES funcionarios(id)
	ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE cargos_funcionarios(
	cargo_id INT NOT NULL,
	funcionario_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(cargo_id, funcionario_id),
	CONSTRAINT FOREIGN KEY(cargo_id)
	REFERENCES cargos(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(funcionario_id)
	REFERENCES funcionarios(id)
	ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE turnos(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE horarios(
	id INT NOT NULL AUTO_INCREMENT,
	inicio TIME NOT NULL,
	fim TIME NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE turnos_horarios(
	turno_id INT NOT NULL,
	horario_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(turno_id, horario_id),
	CONSTRAINT FOREIGN KEY(turno_id)
	REFERENCES turnos(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(horario_id)
	REFERENCES horarios(id)
	ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE cursos(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	sigla CHAR(5) NOT NULL UNIQUE,
	turno_id INT NOT NULL,
	funcionario_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(id),
	CONSTRAINT FOREIGN KEY(turno_id)
	REFERENCES turnos(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(funcionario_id)
	REFERENCES funcionarios(id)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE disciplinas(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	sigla CHAR(5) NOT NULL UNIQUE,
	aulasSemanais INT NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE tiposSala(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	descricao VARCHAR(255) NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE disciplinas_tiposSala(
	disciplina_id INT NOT NULL,
	tipoSala_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(disciplina_id, tipoSala_id),
	CONSTRAINT FOREIGN KEY(disciplina_id)
	REFERENCES disciplinas(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(tipoSala_id)
	REFERENCES tiposSala(id)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE semestres(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	inicio DATE NOT NULL,
	fim DATE NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE cursos_disciplinas(
	curso_id INT NOT NULL,
	disciplina_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(curso_id, disciplina_id),
	CONSTRAINT FOREIGN KEY(curso_id)
	REFERENCES cursos(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(disciplina_id)
	REFERENCES disciplinas(id)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE disciplinas_semestres(
	semestre_id INT NOT NULL,
	disciplina_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(semestre_id, disciplina_id),
	CONSTRAINT FOREIGN KEY(semestre_id)
	REFERENCES semestres(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(disciplina_id)
	REFERENCES disciplinas(id)
	ON DELETE RESTRICT ON UPDATE CASCADE
);
CREATE TABLE fpas(
	horario_id INT NOT NULL,
	semestre_id INT NOT NULL,
	disciplina_id INT NOT NULL,
	funcionario_id INT NOT NULL, 
	diaSemana ENUM ('SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB'),
	CONSTRAINT PRIMARY KEY (horario_id, semestre_id, disciplina_id, funcionario_id),
	CONSTRAINT FOREIGN KEY (horario_id)
	REFERENCES horarios(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(semestre_id)
	REFERENCES semestres(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(disciplina_id)
	REFERENCES disciplinas(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(funcionario_id)
	REFERENCES funcionarios(id)
	ON DELETE RESTRICT ON UPDATE CASCADE

);

INSERT INTO `funcionarios` (`id`, `nome`, `sexo`, `cpf`, `data_nascimento`, `endereco`, `foto`, `prontuario`, `email`, `password`, `rg`) VALUES ('1', 'Fulano', 'M', '11111111111', '1990-09-12', 'Em casa', 'null.jpg', '1501111', 'fulano@webhorario.com', '$2y$10$8bhPBEPB4mwGOvE.GLC7cOj8xKC7VgTBM43JgcfcF9oYJzX8lUQuS', '111111111');
INSERT INTO `funcionarios` (`id`, `nome`, `sexo`, `cpf`, `data_nascimento`, `endereco`, `foto`, `prontuario`, `email`, `password`, `rg`) VALUES ('2', 'Ciclano', 'M', '22222222222', '1990-09-12', 'Em casa', 'null.jpg', '1502222', 'ciclano@webhorario.com', '$2y$10$8bhPBEPB4mwGOvE.GLC7cOj8xKC7VgTBM43JgcfcF9oYJzX8lUQuS', '222222222');
INSERT INTO `funcionarios` (`id`, `nome`, `sexo`, `cpf`, `data_nascimento`, `endereco`, `foto`, `prontuario`, `email`, `password`, `rg`) VALUES ('3', 'Beltrano', 'M', '33333333333', '1990-09-12', 'Em casa', 'null.jpg', '1503333', 'beltrano@webhorario.com', '$2y$10$8bhPBEPB4mwGOvE.GLC7cOj8xKC7VgTBM43JgcfcF9oYJzX8lUQuS', '333333333');

INSERT INTO `cargos` (`id`, `nome`) VALUES ('1', 'Professor');
INSERT INTO `cargos` (`id`, `nome`) VALUES ('2', 'Diretor');
INSERT INTO `cargos` (`id`, `nome`) VALUES ('3', 'Manim da Cantina');

INSERT INTO `cargos_funcionarios` (`funcionario_id`, `cargo_id`) VALUES ('1', '1');
INSERT INTO `cargos_funcionarios` (`funcionario_id`, `cargo_id`) VALUES ('1', '2');
INSERT INTO `cargos_funcionarios` (`funcionario_id`, `cargo_id`) VALUES ('1', '3');
INSERT INTO `cargos_funcionarios` (`funcionario_id`, `cargo_id`) VALUES ('2', '2');
INSERT INTO `cargos_funcionarios` (`funcionario_id`, `cargo_id`) VALUES ('2', '3');
INSERT INTO `cargos_funcionarios` (`funcionario_id`, `cargo_id`) VALUES ('3', '3');