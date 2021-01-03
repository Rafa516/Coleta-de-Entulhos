-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 03/01/2021 às 15:18
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_call_save` (IN `piduser` INT(11), IN `plocality` VARCHAR(128), IN `pobservation` TEXT, IN `ppriority` VARCHAR(64), IN `psituation` INT(11))  NO SQL
BEGIN
   
    INSERT INTO tb_calls (iduser,locality,observation,priority,situation)
    
    VALUES(piduser,plocality,pobservation,ppriority,psituation);
    
    
  SELECT * FROM tb_calls  WHERE idcall = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_image_call_add` (IN `pidcall` INT(11), IN `piduser` INT(11), IN `pnamephoto` VARCHAR(64))  NO SQL
BEGIN

INSERT INTO tb_callphotos (idcall,iduser,namephoto)
    VALUES(pidcall,piduser,pnamephoto);
   

 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_locations_call_add` (IN `pidcall` INT(11), IN `plng` FLOAT(25), IN `plat` FLOAT(25))  BEGIN
   
    INSERT INTO tb_locations (idcall,lng,lat)
    
    VALUES(pidcall,plng,plat); 
    
      SELECT * FROM tb_locations  WHERE idlocation = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_image` (IN `piduser` INT(11), IN `ppicture` VARCHAR(64))  BEGIN
 
    UPDATE tb_users
    SET
        picture = ppicture
      
	WHERE iduser = piduser;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_situation` (IN `pidcall` INT(11), IN `psituation` INT(11))  BEGIN
 
    UPDATE tb_calls
    SET
        situation = psituation
          
        WHERE idcall = pidcall;
        
      SELECT * FROM tb_calls WHERE idcall = pidcall;  
        
          
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_save` (IN `pperson` VARCHAR(64), IN `plogin` VARCHAR(64), IN `pdespassword` VARCHAR(256), IN `pemail` VARCHAR(128), IN `pphone` BIGINT, IN `pinadmin` TINYINT, IN `pgenre` INT(11), IN `ppicture` VARCHAR(64), IN `pborn_date` DATE, IN `pcity` VARCHAR(64), IN `paddress` VARCHAR(128))  BEGIN
   
    INSERT INTO tb_users (person,login,despassword,email, phone,inadmin,genre,picture,born_date,city,address)
    
    VALUES(pperson,plogin,pdespassword,pemail, pphone,pinadmin,pgenre,ppicture,pborn_date,pcity,paddress);
    
    
  SELECT * FROM tb_users  WHERE iduser = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_update` (IN `piduser` INT(11), IN `pperson` VARCHAR(64), IN `pgenre` INT(11), IN `pphone` BIGINT(20), IN `pborn_date` DATE, IN `pcity` VARCHAR(64), IN `paddress` VARCHAR(128))  BEGIN
 
    UPDATE tb_users
    SET
        person = pperson,
        genre = pgenre,
        phone = pphone,
        born_date = pborn_date,
        city = pcity,
        address = paddress
        
        WHERE iduser = piduser;
        
        
          SELECT * FROM tb_users  WHERE iduser = piduser;
        
      
    
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_callphotos`
--

CREATE TABLE `tb_callphotos` (
  `idphoto` int(11) NOT NULL,
  `idcall` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `namephoto` varchar(64) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_calls`
--

CREATE TABLE `tb_calls` (
  `idcall` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `locality` varchar(128) NOT NULL,
  `observation` text,
  `priority` varchar(64) NOT NULL,
  `situation` int(11) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_locations`
--

CREATE TABLE `tb_locations` (
  `idlocation` int(11) NOT NULL,
  `idcall` int(11) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `iduser` int(11) NOT NULL,
  `person` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `born_date` date DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `login` varchar(64) DEFAULT NULL,
  `despassword` varchar(256) NOT NULL,
  `inadmin` tinyint(4) DEFAULT '0',
  `genre` int(11) NOT NULL,
  `picture` varchar(64) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_users`
--

INSERT INTO `tb_users` (`iduser`, `person`, `email`, `phone`, `born_date`, `city`, `address`, `login`, `despassword`, `inadmin`, `genre`, `picture`, `dtregister`) VALUES
(1, 'Suporte', 'suporte@gmail.com', 6199999999999, '0001-01-01', 'Brasília - DF', 'Empresa S/A', 'admin', '$2y$12$hKaYkmysAUxuw4gYLdTL3eyB7eVzwt4.mK4gGCQUYMD0X/YNzINrG', 1, 1, '20201216121216', '2020-12-08 18:55:47'),
(16, 'Rafael Oliveira', 'rafaxvi@hotmail.com', 6191441738, '2020-12-22', 'Santa Maria- DF', 'Quadra 516 conjunto c casa 10', 'rafaxvi@hotmail.com', '$2y$12$ASdDwhq473Syx5F0U0cp2OfngHKgMiVOFrkw3gSAEA/rBbcSzEHKu', 0, 1, '20201222071227', '2020-12-18 13:03:43'),
(18, 'Adjair Nascimento', 'adjair@gmail.com', 6199633909, '2020-12-15', 'Sobradinho - DF', 'Quadra 518 conjunto c casa 22', 'adjair@gmail.com', '$2y$12$fi8aemKy9D0s.3b9.oh3muAWpIWwrqE7H2M2pqtQTHcnI2gfGCWmy', 0, 0, '20201218111250', '2020-12-18 14:21:36'),
(20, 'Sabrina ', 'sabrina.sa.sa@hotmail.com', 619941738, '1994-04-26', 'Santa Maria- DF', 'Quadra 516 conjunto c casa 22', 'sabrina.sa.sa@hotmail.com', '$2y$12$VfP2I51w3m.PBFnzPpiLiO97t/azO/pS2gmJzIP.DSmaHQvSjLDXS', 0, 2, '0', '2020-12-18 21:43:12');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_callphotos`
--
ALTER TABLE `tb_callphotos`
  ADD PRIMARY KEY (`idphoto`),
  ADD KEY `fk_callphotos_calls` (`idcall`),
  ADD KEY `fk_callphotos_users` (`iduser`);

--
-- Índices de tabela `tb_calls`
--
ALTER TABLE `tb_calls`
  ADD PRIMARY KEY (`idcall`),
  ADD KEY `fk_calls_users` (`iduser`);

--
-- Índices de tabela `tb_locations`
--
ALTER TABLE `tb_locations`
  ADD PRIMARY KEY (`idlocation`),
  ADD KEY `fk_locations_calls` (`idcall`);

--
-- Índices de tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `iduser` (`iduser`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_callphotos`
--
ALTER TABLE `tb_callphotos`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de tabela `tb_calls`
--
ALTER TABLE `tb_calls`
  MODIFY `idcall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `tb_locations`
--
ALTER TABLE `tb_locations`
  MODIFY `idlocation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_callphotos`
--
ALTER TABLE `tb_callphotos`
  ADD CONSTRAINT `fk_callphotos_calls` FOREIGN KEY (`idcall`) REFERENCES `tb_calls` (`idcall`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_callphotos_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_calls`
--
ALTER TABLE `tb_calls`
  ADD CONSTRAINT `fk_calls_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_locations`
--
ALTER TABLE `tb_locations`
  ADD CONSTRAINT `fk_locations_calls` FOREIGN KEY (`idcall`) REFERENCES `tb_calls` (`idcall`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
