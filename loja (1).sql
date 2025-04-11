-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 11/04/2025 às 22h21min
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`codigo`, `nome`) VALUES
(1, 'Adidas'),
(2, 'Nike'),
(3, 'Mikasa'),
(4, 'Penalty'),
(5, 'Puma'),
(6, 'Asics'),
(7, 'Reebok'),
(8, 'Vans'),
(9, 'GenÃ©rico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamanho` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` float(10,2) NOT NULL,
  `codmarca` int(5) NOT NULL,
  `codcategoria` int(5) NOT NULL,
  `codtipo` int(5) NOT NULL,
  `foto1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codmarca` (`codmarca`),
  KEY `codcategoria` (`codcategoria`),
  KEY `codtipo` (`codtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigo`, `nome`, `descricao`, `cor`, `tamanho`, `preco`, `codmarca`, `codcategoria`, `codtipo`, `foto1`, `foto2`) VALUES
(1, 'Camiseta Adidas', 'Camiseta de poliéster projetada para treinos.', 'Branco', 'M', 200.00, 1, 5, 1, '957f7a2ceecaf86c396aa3af3bde1d36', '0775b07586ce47a073f1d61824afca85'),
(3, 'Regata Adidas', 'Regata projetada para treinos.', 'Vermelho', 'G', 150.00, 1, 1, 1, '0bb7a129631e6bcf2d13c648eed39d75', '6ae522f9d97d3e790fe9388e8290bcc8'),
(4, 'Camiseta Manga Longa Adidas', 'Camiseta de manga longa de poliéster projetada para treinos.', 'Preto', 'P', 250.00, 1, 1, 1, 'aa15c73740690d0a971e80b56fdfd1ef', '651f162714cd2b391bad4c9155975dbe'),
(5, 'Tênis SK8-HI Vans', 'Tênis de cano alto, fechamento com cadarço e solado emborrachado.', 'Preto', '39', 399.90, 8, 5, 2, '4c43e298246538eaf83cd372a966ec68', 'c3b1b4b5ea09a5b98d8d09b7eb35b9d0'),
(6, 'Tênis Old School Vans', 'Tênis de cano baixo, fechamento com cadarço e solado emborrachado.', 'Azul e Preto', '36', 379.90, 8, 5, 2, 'a5d3cc2e8d7121a436580abc0485c36b', 'db34ec851771c7d5be4dad94e9a950a5'),
(7, 'Bola de Vôlei V200W Mikasa', 'Circunferência de 65-67cm, peso de 260-280g.', 'Amarelo e Azul', 'Único', 1.10, 3, 5, 5, '71aaced8d3342981cd7f2a4eb2a1741a', 'cb2f8e044854581b65f6f7a36b3e059f'),
(8, 'Kit de Proteção Infantil', '1 Capacete + 1 Par Joelheiras + 1 Par Cotoveleiras.', 'Rosa', 'Único', 129.99, 9, 3, 4, '672fc547932bf9cc57e5345cb5640c90', 'f67d5d1894c6efa0bcd6ceeacd993580'),
(9, 'Shorts Nike Go Feminino', 'Shorts de lycra confeccionado para treinos.', 'Verde', 'PP', 379.99, 2, 2, 1, 'c76b66f03ddddfadd84de376f34e7b46', '1639d9120f8144705eb9c0e7c3d17206'),
(10, 'Blusão Nike Infantil', 'Fleece super leve possui toque super macio e felpudo por dentro.', 'Roxo', '14', 219.99, 2, 3, 1, 'ec370ba10e6c7ef1d3bf76710e0f5be0', '8ebe6dd517ea5d48305a6d5c4abfc48e'),
(11, 'Viseira Nike Dri-FIT', 'Tecnologia Nike Dri-FIT absorve o suor da sua pele para evaporação mais rápida.', 'Rosa', 'Único', 149.99, 2, 2, 4, 'c94c8b87ef219f3e580bfddec7978b81', 'bab855691326301d09088c4daae671cc');

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codigo`, `login`, `senha`) VALUES
(1, 'sabs', '123');

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
