DROP TABLE IF EXISTS torcedores2.usuarios;
CREATE TABLE torcedores2.usuarios(

    idUsuario INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    dataNasc DATE,
    email VARCHAR(150) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    is_admin BOOLEAN NOT NULL


);

DROP TABLE IF EXISTS torcedores2.mensalidades;
CREATE TABLE torcedores2.mensalidades(
    idMensalidade INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dataVencimento DATE NOT NULL,
    dataPagamento DATE,
    idUsuario INTEGER NOT NULL,
    valor FLOAT NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
);

DROP TABLE IF EXISTS torcedores2.jogos;
CREATE TABLE torcedores2.jogos(

    idJogo INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    timeCasa VARCHAR(150) NOT NULL,
    timeAdv VARCHAR(150) NOT NULL,
    dataJogo DATE,
    descricao VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS torcedores2.caravanas;
CREATE TABLE torcedores2.caravanas(

    idCaravana INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    idJogo INTEGER NOT NULL,
    FOREIGN KEY (idJogo) REFERENCES jogos(idJogo)

);

DROP TABLE IF EXISTS torcedores2.torcedor_caravanas;
CREATE TABLE torcedores2.torcedor_caravanas(
    idTorcCar INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idUsuario INTEGER NOT NULL,
    idCaravana INTEGER NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario),
    FOREIGN KEY (idCaravana) REFERENCES caravanas(idCaravana)

);

DROP TABLE IF EXISTS torcedores2.postagens;
CREATE TABLE postagens(

    idPostagem INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL, 
    descricao TEXT NOT NULL,
    idUsuario INTEGER NOT NULL,
    FOREIGN KEY (idUsuario ) REFERENCES usuarios(idUsuario)

);

/*REVISAR*/

INSERT INTO usuarios (nome, dataNasc, email, senha, is_admin) VALUES ("wallstreet", NOW(), "str@gmail.com", "123456", 1);

/*
DROP TABLE IF EXISTS torcedores2.torcedor_caravanas;
DROP TABLE IF EXISTS torcedores2.mensalidades;
DROP TABLE IF EXISTS torcedores2.usuarios;
DROP TABLE IF EXISTS torcedores2.caravanas;
DROP TABLE IF EXISTS torcedores2.jogos;

*/