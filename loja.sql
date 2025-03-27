-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 27/03/2025 às 21h13min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`codigo`, `nome`) VALUES
(1, 'Masculino'),
(2, 'Feminino'),
(3, 'Infantil'),
(5, 'Unissex');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`codigo`, `nome`) VALUES
(1, 'Adidas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `tamanho` varchar(5) NOT NULL,
  `preco` float(10,2) NOT NULL,
  `codmarca` int(5) NOT NULL,
  `codcategoria` int(5) NOT NULL,
  `codtipo` int(5) NOT NULL,
  `foto1` varchar(100) NOT NULL,
  `foto2` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codmarca` (`codmarca`),
  KEY `codcategoria` (`codcategoria`),
  KEY `codtipo` (`codtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigo`, `nome`, `descricao`, `cor`, `tamanho`, `preco`, `codmarca`, `codcategoria`, `codtipo`, `foto1`, `foto2`) VALUES
(1, 'Camiseta Adidas', 'Camiseta de poliÃ©ster projetada para treinos.', 'Branco', 'M', 200.00, 1, 5, 1, '957f7a2ceecaf86c396aa3af3bde1d36', '0775b07586ce47a073f1d61824afca85'),
(2, 'Camiseta Manga Longa Adidas', 'Camiseta de manga longa de poliÃ©ster projetada para corridas.', 'Preto', 'P', 150.00, 1, 1, 1, '29009b68ca4f58392684d06b3a2fbd57', '8cec91cefaf1241df8f5f70e5e8b32b3'),
(3, 'Regata Adidas', 'Regata projetada para treinos.', 'Vermelho', 'G', 150.00, 1, 1, 1, '0bb7a129631e6bcf2d13c648eed39d75', '6ae522f9d97d3e790fe9388e8290bcc8');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`codigo`, `nome`) VALUES
(1, 'Roupas'),
(2, 'Calçados'),
(4, 'Acessórios'),
(5, 'Itens');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`codmarca`) REFERENCES `marca` (`codigo`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`codcategoria`) REFERENCES `categoria` (`codigo`),
  ADD CONSTRAINT `produto_ibfk_3` FOREIGN KEY (`codtipo`) REFERENCES `tipo` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
