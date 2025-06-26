-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26/06/2025 às 16:57
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pelosepatas_v3_1`
--
CREATE DATABASE IF NOT EXISTS `pelosepatas_v3_1` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `pelosepatas_v3_1`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `castracao`
--

DROP TABLE IF EXISTS `castracao`;
CREATE TABLE IF NOT EXISTS `castracao` (
  `id_castracao` int NOT NULL AUTO_INCREMENT,
  `dia_castracao` date NOT NULL,
  `hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `observacao` varchar(50) NOT NULL,
  `id_clinica` int NOT NULL,
  `id_pet` int NOT NULL,
  `estado` varchar(20) NOT NULL,
  PRIMARY KEY (`id_castracao`),
  KEY `fk_castracao_clinica1_idx` (`id_clinica`),
  KEY `fk_castracao_pet1_idx` (`id_pet`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `castracao`
--

INSERT INTO `castracao` (`id_castracao`, `dia_castracao`, `hora`, `observacao`, `id_clinica`, `id_pet`, `estado`) VALUES
(1, '2025-06-26', '2025-06-25 21:47:03', 'gato arisco, precisa de fucinheira', 1, 1, 'confirmado'),
(2, '2025-06-26', '2025-06-26 10:36:21', 'tem muito pelo', 1, 2, 'cancelado'),
(3, '2025-06-26', '2025-06-26 10:38:13', 'a dona mandou cortar as unhas também', 1, 3, 'confirmado'),
(4, '2025-06-26', '2025-06-26 10:39:46', 'Raspar o pelo onde será a cirurgia', 1, 4, 'confirmado'),
(5, '2025-06-26', '2025-06-26 10:42:02', 'Arisco, precisa raspar o pelo', 1, 5, 'confirmado'),
(6, '2025-06-20', '2025-06-26 10:45:30', 'Ele é manso', 1, 6, ''),
(7, '2025-06-28', '2025-06-26 10:53:11', 'Focinho curto, precisa de anestesia local', 1, 7, ''),
(8, '2025-06-29', '2025-06-26 12:15:07', 'É arisco', 1, 8, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `sexo` tinyint NOT NULL,
  `cep` varchar(10) NOT NULL,
  `num_endereco` varchar(45) NOT NULL,
  `idade` int NOT NULL,
  `estado_civil` varchar(15) NOT NULL,
  `complemento` varchar(45) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf`, `sexo`, `cep`, `num_endereco`, `idade`, `estado_civil`, `complemento`) VALUES
(1, 'Laysa Bittencourt Assunção', '062.149.931-54', 1, '72587-255', '12', 20, 'Solteiro', 'Casa cinza na rua do eu amo vnavi'),
(2, 'Kennedy Leandro Amaral Marques', '062.149.931-54', 2, '72587-255', '3', 20, 'Solteiro', 'sobrado'),
(3, 'Kennedy Leandro Amaral Marques', '089.123.321-54', 2, '72587-255', '3', 20, 'Solteiro', 'casa vermelha'),
(4, 'Luis Gustavo', '123.456.789-00', 2, '72587-255', '12', 20, 'Solteiro', 'casa cinza');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clinica`
--

DROP TABLE IF EXISTS `clinica`;
CREATE TABLE IF NOT EXISTS `clinica` (
  `id_clinica` int NOT NULL AUTO_INCREMENT,
  `nomeclinica` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `emailclinica` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senhaclinica` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_clinica`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `clinica`
--

INSERT INTO `clinica` (`id_clinica`, `nomeclinica`, `emailclinica`, `senhaclinica`) VALUES
(1, 'Pelos&Patas', 'pelos&patas@gmail.com', '$2y$10$sJGggQ.WsAH8djhy5ykHk.uFXIvbiKWQKbq2UETKxPiCkWLUCgJDe');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato`
--

DROP TABLE IF EXISTS `contato`;
CREATE TABLE IF NOT EXISTS `contato` (
  `id_contato` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `id_clinica` int NOT NULL,
  PRIMARY KEY (`id_contato`),
  KEY `fk_contato_clinica1_idx` (`id_clinica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato_cliente`
--

DROP TABLE IF EXISTS `contato_cliente`;
CREATE TABLE IF NOT EXISTS `contato_cliente` (
  `id_contato` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `telefone_fixo` varchar(45) NOT NULL,
  `id_cliente` int NOT NULL,
  PRIMARY KEY (`id_contato`),
  KEY `fk_contato_cliente_cliente1_idx` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `contato_cliente`
--

INSERT INTO `contato_cliente` (`id_contato`, `email`, `telefone`, `telefone_fixo`, `id_cliente`) VALUES
(1, 'laysa@gmail.com', '(61) 99604-3203', '(61) 9604-3203', 1),
(2, 'kennedy@gmail.com', '(61) 98765-4321', '(61) 9876-5432', 2),
(3, 'kennedy@gmail.com', '(61) 98765-4321', '(61) 9874-6532', 3),
(4, 'luis@gmail.com', '(61) 12345-6789', '(61) 1234-5667', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco_clinica`
--

DROP TABLE IF EXISTS `endereco_clinica`;
CREATE TABLE IF NOT EXISTS `endereco_clinica` (
  `id_endereco` int NOT NULL AUTO_INCREMENT,
  `cep` int NOT NULL,
  `num_endereco` varchar(45) NOT NULL,
  `id_clinica` int NOT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `fk_endereco_clinica_clinica_idx` (`id_clinica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `especie`
--

DROP TABLE IF EXISTS `especie`;
CREATE TABLE IF NOT EXISTS `especie` (
  `id_especie` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id_especie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `especie`
--

INSERT INTO `especie` (`id_especie`, `nome`) VALUES
(1, 'felino'),
(2, 'canino');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE IF NOT EXISTS `pet` (
  `id_pet` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `idade` int NOT NULL,
  `sexo` tinyint DEFAULT NULL,
  `porte` varchar(20) NOT NULL,
  `id_especie` int NOT NULL,
  `id_cliente` int NOT NULL,
  PRIMARY KEY (`id_pet`),
  KEY `fk_pet_especie1_idx` (`id_especie`),
  KEY `fk_pet_cliente1_idx` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `pet`
--

INSERT INTO `pet` (`id_pet`, `nome`, `idade`, `sexo`, `porte`, `id_especie`, `id_cliente`) VALUES
(1, 'Floquinho', 5, 2, 'Pequeno', 1, 1),
(2, 'Safira', 2, 1, 'Pequeno', 1, 2),
(3, 'Luna', 2, 1, 'Pequeno', 1, 1),
(4, 'Mel', 3, 1, 'Grande', 2, 2),
(5, 'Zeus', 2, 2, 'Grande', 2, 1),
(6, 'Salem', 5, 2, 'Pequeno', 1, 2),
(7, 'Spike', 3, 2, 'Pequeno', 2, 2),
(8, 'Safira', 1, 1, 'Pequeno', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `raca`
--

DROP TABLE IF EXISTS `raca`;
CREATE TABLE IF NOT EXISTS `raca` (
  `id_raca` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `id_especie` int NOT NULL,
  PRIMARY KEY (`id_raca`),
  KEY `fk_raca_especie1_idx` (`id_especie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `raca`
--

INSERT INTO `raca` (`id_raca`, `nome`, `id_especie`) VALUES
(1, 'siamês', 1),
(2, 'Angorá', 1),
(3, 'srd', 1),
(4, 'Golden', 2),
(5, 'Husky', 2),
(6, 'Shitzu', 2);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `castracao`
--
ALTER TABLE `castracao`
  ADD CONSTRAINT `fk_castracao_clinica1` FOREIGN KEY (`id_clinica`) REFERENCES `clinica` (`id_clinica`),
  ADD CONSTRAINT `fk_castracao_pet1` FOREIGN KEY (`id_pet`) REFERENCES `pet` (`id_pet`);

--
-- Restrições para tabelas `contato`
--
ALTER TABLE `contato`
  ADD CONSTRAINT `fk_contato_clinica1` FOREIGN KEY (`id_clinica`) REFERENCES `clinica` (`id_clinica`);

--
-- Restrições para tabelas `contato_cliente`
--
ALTER TABLE `contato_cliente`
  ADD CONSTRAINT `fk_contato_cliente_cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Restrições para tabelas `endereco_clinica`
--
ALTER TABLE `endereco_clinica`
  ADD CONSTRAINT `fk_endereco_clinica_clinica` FOREIGN KEY (`id_clinica`) REFERENCES `clinica` (`id_clinica`);

--
-- Restrições para tabelas `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `fk_pet_cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `fk_pet_especie1` FOREIGN KEY (`id_especie`) REFERENCES `especie` (`id_especie`);

--
-- Restrições para tabelas `raca`
--
ALTER TABLE `raca`
  ADD CONSTRAINT `fk_raca_especie1` FOREIGN KEY (`id_especie`) REFERENCES `especie` (`id_especie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
