-- =============================================
-- Banco de Dados: cadastro_amigos
-- Projeto: Cadastro de Amigos da Gabi
-- =============================================
 
CREATE DATABASE IF NOT EXISTS cadastro_amigos
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
 
USE cadastro_amigos;
 
-- ---------------------------------------------
-- Tabela: usuarios
-- ---------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
-- ---------------------------------------------
-- Tabela: amigos
-- ---------------------------------------------
CREATE TABLE IF NOT EXISTS amigos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  sobrenome VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  telefone VARCHAR(20),
  data_nascimento DATE,
  cidade VARCHAR(100),
  observacoes TEXT,
  data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
-- ---------------------------------------------
-- Usuário de teste
-- Senha original: 123456
-- ---------------------------------------------
INSERT INTO usuarios (nome, email, senha) VALUES
('Gabi Admin', 'admin@gabi.com', '$2y$12$hV8zCPMjrGIos10sLWOHGOrdtWMlU8wTsz7BUmZsdcvLYFnXY6mX2');
 
-- ---------------------------------------------
-- Amigos de exemplo (opcional para demonstração)
-- ---------------------------------------------
INSERT INTO amigos (nome, sobrenome, email, telefone, data_nascimento, cidade, observacoes) VALUES
('Ana', 'Silva', 'ana.silva@email.com', '(11) 99999-1111', '1998-04-12', 'São Paulo', 'Amiga da faculdade'),
('Bruno', 'Costa', 'bruno.costa@email.com', '(21) 98888-2222', '1995-09-30', 'Rio de Janeiro', 'Colega de trabalho'),
('Carla', 'Mendes', 'carla.mendes@email.com', '(31) 97777-3333', '2000-01-22', 'Belo Horizonte', 'Prima');
 