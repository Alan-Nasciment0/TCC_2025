/* Lógico_v2: */
 create database bd_tcc;
 use bd_tcc;
CREATE TABLE Usuario (
    usuario_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    usuario_nome VARCHAR(50),
    usuario_email VARCHAR(100),
    usuario_senha text,
    usuario_tempo_banimento VARCHAR(50),
    nivel_acesso INTEGER default 1,
    primeiro_acesso bool default 0,
    foto_perfil_usuario text,
    UNIQUE (usuario_email)
);

CREATE TABLE Autor (
    autor_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    autor_nome VARCHAR(50),
    autor_data_nascimento DATE,
    autor_data_falecimento DATE,
    autor_movimento_literario VARCHAR(30),
    autor_biografia VARCHAR(200),
    autor_link_foto text,
    autor_ativo bool default true
);

CREATE TABLE Categoria (
 categoria_cod integer primary key auto_increment,
    categoria_nome varchar (40)    
);

INSERT INTO Categoria (categoria_nome) VALUES
('Ficção'),
('Não Ficcão'),
('Poesia'),
('Infatil/Juvenil');

CREATE TABLE Genero (
    genero_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    genero_nome VARCHAR(50),
    categoria_cod integer,
    constraint fk_categoria_cod foreign key(categoria_cod) references Categoria (categoria_cod)
);
 
CREATE TABLE Livros (
    livro_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    livro_titulo VARCHAR(200),
    livro_ano DATE,
    livro_editora VARCHAR(50),
    livro_descricao TEXT,
    livro_capa_link TEXT,
    livro_ativo bool default TRUE
);

CREATE TABLE LivroGenero (
    livro_cod INTEGER,
    genero_cod INTEGER,
    PRIMARY KEY (livro_cod, genero_cod),
    CONSTRAINT fk_livro FOREIGN KEY (livro_cod) REFERENCES Livros (livro_cod),
    CONSTRAINT fk_genero_cod_2 FOREIGN KEY (genero_cod) REFERENCES Genero (genero_cod)
);

CREATE TABLE AutorLivro (
    livro_cod INTEGER,
    autor_cod INTEGER,
    PRIMARY KEY (livro_cod, autor_cod),
    CONSTRAINT fk_livro_7 FOREIGN KEY (livro_cod) REFERENCES Livros (livro_cod),
    CONSTRAINT fk_autor_cod_2 FOREIGN KEY (autor_cod) REFERENCES Autor (autor_cod)
);

CREATE TABLE Historico_Visualizacao (
    historico_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    historico_data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
    usuario_cod integer,
    livro_cod integer,
    constraint fk_usuario_cod foreign key(usuario_cod) references usuario (usuario_cod),
    constraint fk_livro_cod_3 foreign key(livro_cod) references livros (livro_cod)
);
 
CREATE TABLE Comentario (
    comentario_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    usuario_cod INTEGER,
    comentario_data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
    comentario_texto VARCHAR(200),
    constraint fk_usuario_cod_2 foreign key(usuario_cod) references usuario (usuario_cod)
);
 
CREATE TABLE Denuncia (
    denuncia_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    denuncia_data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
    denuncia_tipo VARCHAR(30),
    denuncia_descricao VARCHAR(200),
    comentario_cod integer,
    constraint fk_comentario_cod foreign key(comentario_cod) references comentario (comentario_cod)
);
 
CREATE TABLE Favoritos (
    favoritos_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    livro_cod integer, 
    usuario_cod integer,
    constraint fk_livro_cod_4 foreign key(livro_cod) references livros (livro_cod),
    constraint fk_usuario_cod_3 foreign key(usuario_cod) references usuario (usuario_cod),
    UNIQUE (livro_cod, usuario_cod)
);
 
CREATE TABLE Livros_Lidos (
 usuario_cod INTEGER,
    livro_cod INTEGER, 
    PRIMARY KEY (usuario_cod, livro_cod),
    constraint fk_livro_cod_5 foreign key(livro_cod) references livros (livro_cod),
    constraint fk_usuario_cod_4 foreign key(usuario_cod) references usuario (usuario_cod)
);


CREATE TABLE Genero_preferido_usuario (
 usuario_cod INTEGER,
    genero_cod INTEGER,
    PRIMARY KEY (usuario_cod, genero_cod),
 constraint fk_usuario_cod_5 foreign key(usuario_cod) references usuario (usuario_cod),
    constraint fk_genero_cod_3 foreign key(genero_cod) references genero (genero_cod)
);

CREATE TABLE Categoria_preferida_usuario (
 usuario_cod INTEGER,
    categoria_cod integer,
    PRIMARY KEY (usuario_cod, categoria_cod),
 constraint fk_usuario_cod_6 foreign key(usuario_cod) references usuario (usuario_cod),
    constraint fk_categoria_cod_1 foreign key(categoria_cod) references categoria (categoria_cod)
);

CREATE TABLE LivroCategoria (
    livro_cod INTEGER,
    categoria_cod INTEGER,
    PRIMARY KEY (livro_cod, categoria_cod),
    CONSTRAINT fk_livro_cod_7 FOREIGN KEY (livro_cod) REFERENCES Livros (livro_cod),
    CONSTRAINT fk_categoria_cod_2 FOREIGN KEY (categoria_cod) REFERENCES categoria (categoria_cod)
);

CREATE TABLE Avaliacoes (
 avaliacao_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    usuario_cod INTEGER,
    livro_cod INTEGER,
    nota INTEGER CHECK (nota >= 1 and nota <=5),
    constraint fk_usuario_cod_7 foreign key(usuario_cod) references usuario (usuario_cod),
    constraint fk_livro_cod_6 foreign key(livro_cod) references livros (livro_cod),
    CONSTRAINT unq_usuario_livro UNIQUE (usuario_cod, livro_cod)
);

CREATE TABLE Noticias (
 noticia_cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    titulo varchar (100),
    banner_imagem varchar(255),
    link text,
    status BOOLEAN DEFAULT TRUE        
);

delimiter $$
create procedure sp_adicionar_usuario (in $usu_nome varchar (50), in $usu_email varchar(100), $usu_senha varchar (50))
begin
 insert into usuario( usuario_nome, usuario_email, usuario_senha)
 values (usu_nome, usu_email, usu_senha);
 end $$
 
