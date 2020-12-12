-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 12/12/2020 às 12:01
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_image` (IN `piduser` INT(11), IN `ppicture` VARCHAR(64))  BEGIN
 
    UPDATE tb_users
    SET
        picture = ppicture
      
	WHERE iduser = piduser;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_save` (IN `pperson` VARCHAR(64), IN `plogin` VARCHAR(64), IN `pdespassword` VARCHAR(256), IN `pemail` VARCHAR(128), IN `pphone` BIGINT, IN `pinadmin` TINYINT, IN `ppicture` VARCHAR(64), IN `pborn_date` DATE, IN `pcity` VARCHAR(64), IN `paddress` VARCHAR(128))  BEGIN
   
    INSERT INTO tb_users (person,login,despassword,email, phone,inadmin,picture,born_date,city,address)
    
    VALUES(pperson,plogin,pdespassword,pemail, pphone,pinadmin,ppicture,pborn_date,pcity,paddress);
    
    
  SELECT * FROM tb_users  WHERE iduser = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_update` (IN `piduser` INT(11), IN `pperson` VARCHAR(64), IN `pphone` BIGINT(20), IN `pborn_date` DATE, IN `pcity` VARCHAR(64), IN `paddress` VARCHAR(128))  BEGIN
 
    UPDATE tb_users
    SET
        person = pperson,
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
  `login` varchar(64) NOT NULL,
  `despassword` varchar(256) NOT NULL,
  `inadmin` tinyint(4) NOT NULL DEFAULT '0',
  `picture` varchar(64) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_users`
--

INSERT INTO `tb_users` (`iduser`, `person`, `email`, `phone`, `born_date`, `city`, `address`, `login`, `despassword`, `inadmin`, `picture`, `dtregister`) VALUES
(1, '', '', 0, NULL, '', '', 'admin', '$2y$12$hKaYkmysAUxuw4gYLdTL3eyB7eVzwt4.mK4gGCQUYMD0X/YNzINrG', 1, '0', '2020-12-08 18:55:47'),
(2, 'Rafael Oliveira', 'rafaxvi@hotmail.com', 6191441738, '1989-03-28', 'Santa Maria- DF', 'Quadra 516 conjunto c casa 10', 'rafaxvi@hotmail.com', '$2y$12$vueXMfw.bEJtC3qZCFFhNOfZHLFmUUK50Xog6i7dpLOgb/GGrkJuu', 0, '20201212111221', '2020-12-08 19:10:10');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
