-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 08/12/2020 às 17:42
-- Versão do servidor: 5.7.32-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_coleta_entulhos`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_save` (IN `pperson` VARCHAR(64), IN `plogin` VARCHAR(64), IN `pdespassword` VARCHAR(256), IN `pemail` VARCHAR(128), IN `pphone` BIGINT, IN `pinadmin` TINYINT, IN `ppicture` VARCHAR(64))  BEGIN
	
    DECLARE vidperson INT;
    
	INSERT INTO tb_persons (person, email, phone)
    VALUES(pperson, pemail, pphone);
    
    SET vidperson = LAST_INSERT_ID();
    
    INSERT INTO tb_users (idperson,login,despassword,inadmin,picture)
    VALUES(vidperson,plogin,pdespassword, pinadmin,ppicture);
    
    SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a.iduser = LAST_INSERT_ID();
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_persons`
--

CREATE TABLE `tb_persons` (
  `idperson` int(11) NOT NULL,
  `person` varchar(64) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_persons`
--

INSERT INTO `tb_persons` (`idperson`, `person`, `email`, `phone`, `dtregister`) VALUES
(1, 'Suporte', 'suporte@hotmail.com', 6191441738, '2020-12-08 18:55:47'),
(2, 'Rafael Oliveira', 'rafaxvi@hotmail.com', 6191441738, '2020-12-08 19:10:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `iduser` int(11) NOT NULL,
  `idperson` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `despassword` varchar(256) NOT NULL,
  `inadmin` tinyint(4) NOT NULL DEFAULT '0',
  `picture` varchar(64) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_users`
--

INSERT INTO `tb_users` (`iduser`, `idperson`, `login`, `despassword`, `inadmin`, `picture`, `dtregister`) VALUES
(1, 1, 'admin', '$2y$12$hKaYkmysAUxuw4gYLdTL3eyB7eVzwt4.mK4gGCQUYMD0X/YNzINrG', 1, '0', '2020-12-08 18:55:47'),
(2, 2, 'rafaxvi@hotmail.com', '$2y$12$vueXMfw.bEJtC3qZCFFhNOfZHLFmUUK50Xog6i7dpLOgb/GGrkJuu', 0, '0', '2020-12-08 19:10:10');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_persons`
--
ALTER TABLE `tb_persons`
  ADD PRIMARY KEY (`idperson`),
  ADD KEY `idperson` (`idperson`);

--
-- Índices de tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `FK_users_persons_idx` (`idperson`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_persons`
--
ALTER TABLE `tb_persons`
  MODIFY `idperson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `fk_users_persons` FOREIGN KEY (`idperson`) REFERENCES `tb_persons` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
