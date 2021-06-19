-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 19-Jun-2021 às 11:39
-- Versão do servidor: 5.7.34-0ubuntu0.18.04.1
-- versão do PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_pontos_entulhos`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_collect_save` (IN `piduser` INT(11), IN `plocality` VARCHAR(128), IN `pphone` BIGINT(20), IN `pemail` VARCHAR(60), IN `pservice` VARCHAR(60), IN `pinformations` TEXT)  NO SQL
BEGIN
   
    INSERT INTO tb_collects
    (iduser,locality,phone,email,service,informations)
    
    VALUES(piduser,plocality,pphone,pemail,pservice,pinformations);
    
    
  SELECT * FROM tb_collects  WHERE idcollect = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_image_collect_add` (IN `pidcollect` INT(11), IN `pnamephoto` VARCHAR(64))  BEGIN

INSERT INTO tb_collectphotos (idcollect,namephoto)
    VALUES(pidcollect,pnamephoto);
   

 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_image_marker_add` (IN `pidmarker` INT(11), IN `pnamephoto` VARCHAR(64))  NO SQL
BEGIN

INSERT INTO tb_markerphotos (idmarker,namephoto)
    VALUES(pidmarker,pnamephoto);
   

 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_informations_save` (IN `pidinf` INT(11), IN `pperson` VARCHAR(64), IN `ptitle` VARCHAR(64), IN `pinformations` TEXT)  BEGIN
   
    INSERT INTO tb_informations (idinf,person,title,informations)
    
    VALUES(pidinf,pperson,ptitle,pinformations);
    
    
  SELECT * FROM tb_informations  WHERE idinf = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_informations_update` (IN `pidinf` INT(11), IN `ptitle` VARCHAR(64), IN `pinformations` TEXT)  BEGIN
 
    UPDATE tb_informations
    SET
        title = ptitle,
        informations = pinformations
      
	WHERE idinf = pidinf;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_locations_collect_add` (IN `pidcollect` INT(11), IN `plng` FLOAT(25), IN `plat` FLOAT(25))  BEGIN
   
    INSERT INTO tb_locations_collects (idcollect,lng,lat)
    
    VALUES(pidcollect,plng,plat); 
    
      SELECT * FROM tb_locations_collects  WHERE idlocation = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_locations_marker_add` (IN `pidmarker` INT(11), IN `plng` FLOAT(25), IN `plat` FLOAT(25))  BEGIN
   
    INSERT INTO tb_locations (idmarker,lng,lat)
    
    VALUES(pidmarker,plng,plat); 
    
      SELECT * FROM tb_locations  WHERE idlocation = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_marker_save` (IN `piduser` INT(11), IN `plocality` VARCHAR(128), IN `pobservation` TEXT, IN `ptype1` VARCHAR(60), IN `ptype2` VARCHAR(60), IN `ptype3` VARCHAR(60), IN `ptype4` VARCHAR(60))  NO SQL
BEGIN
   
    INSERT INTO tb_markers (iduser,locality,observation,type1,type2,type3,type4)
    
    VALUES(piduser,plocality,pobservation,ptype1,ptype2,ptype3,ptype4);
    
    
  SELECT * FROM tb_markers  WHERE idmarker = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_image` (IN `piduser` INT(11), IN `ppicture` VARCHAR(64))  BEGIN
 
    UPDATE tb_users
    SET
        picture = ppicture
      
	WHERE iduser = piduser;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_situation` (IN `pidmarker` INT(11), IN `psituation` INT(11))  BEGIN
 
    UPDATE tb_markers
    SET
        situation = psituation
          
        WHERE idcall = pidmarker;
        
      SELECT * FROM tb_markers WHERE idmarker = pidmarkers;  
        
          
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_userspasswordsrecoveries_create` (`piduser` INT, `pdesip` VARCHAR(45))  BEGIN
	
	INSERT INTO tb_userspasswordsrecoveries (iduser, desip)
    VALUES(piduser, pdesip);
    
    SELECT * FROM tb_userspasswordsrecoveries
    WHERE idrecovery = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_save` (IN `pperson` VARCHAR(64), IN `plogin` VARCHAR(64), IN `pdespassword` VARCHAR(256), IN `pemail` VARCHAR(128), IN `pphone` BIGINT, IN `pinadmin` TINYINT, IN `pgenre` INT(11), IN `ppicture` VARCHAR(64), IN `pborn_date` DATE, IN `pcity` VARCHAR(64), IN `paddress` VARCHAR(128))  BEGIN
   
    INSERT INTO tb_users (person,login,despassword,email, phone,inadmin,genre,picture,born_date,city,address)
    
    VALUES(pperson,plogin,pdespassword,pemail, pphone,pinadmin,pgenre,ppicture,pborn_date,pcity,paddress);
    
    
  SELECT * FROM tb_users  WHERE iduser = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_update` (IN `piduser` INT(11), IN `pperson` VARCHAR(64), IN `pinadmin` TINYINT(4), IN `pgenre` INT(11), IN `pphone` BIGINT(20), IN `pborn_date` DATE, IN `pcity` VARCHAR(64), IN `paddress` VARCHAR(128))  BEGIN
 
    UPDATE tb_users
    SET
        person = pperson,
        inadmin = pinadmin,
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
-- Estrutura da tabela `tb_collectphotos`
--

CREATE TABLE `tb_collectphotos` (
  `idphoto` int(11) NOT NULL,
  `idcollect` int(11) NOT NULL,
  `namephoto` varchar(64) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_collectphotos`
--

INSERT INTO `tb_collectphotos` (`idphoto`, `idcollect`, `namephoto`, `dtregister`) VALUES
(18, 18, '', '2021-04-16 23:38:13'),
(19, 19, 'Captura de tela de 2021-04-13 10-07-35.png', '2021-04-16 23:57:18'),
(20, 20, '', '2021-04-17 00:21:56'),
(24, 24, '', '2021-04-30 11:32:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_collects`
--

CREATE TABLE `tb_collects` (
  `idcollect` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `locality` varchar(128) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `service` varchar(60) NOT NULL,
  `informations` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_collects`
--

INSERT INTO `tb_collects` (`idcollect`, `iduser`, `locality`, `phone`, `email`, `service`, `informations`, `dtregister`) VALUES
(18, 1, 'SGAN Quadra 610 Módulos D, E, F, G - Asa Norte, Brasília - DF, 70830-450', 6191441738, 'maria@gmail.com', 'Coleta de Vidros', '', '2021-04-16 23:38:13'),
(19, 1, 'Quadra 516 conjunto c casa 10', 6191441738, 'roliveirarso516@gmail.com', 'Coleta de Eletrônicos', '', '2021-04-16 23:57:18'),
(20, 1, 'Quadra 516 conjunto c casa 10', 6191441738, 'maria@gmail.com', 'Coleta de Materiais Recicláveis', '', '2021-04-17 00:21:56'),
(24, 1, '1ª Avenida Sul Centro Urbano, QD 104 – SAMA', 1121750050, 'contato@greeneletron.org.br', 'Papa Entulho (GDF)', '<p>Empresa respons&aacute;vel: Grenn Eletron&nbsp;</p><p><a href=\"http://contato@greeneletron.org.br\">http://contato@greeneletron.org.br</a></p><p><strong>Metr&ocirc; Distrito Federal &ndash; Samambaia</strong></p>', '2021-04-30 11:32:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_informations`
--

CREATE TABLE `tb_informations` (
  `idinf` int(11) NOT NULL,
  `person` varchar(64) NOT NULL,
  `title` varchar(64) NOT NULL,
  `informations` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_informations`
--

INSERT INTO `tb_informations` (`idinf`, `person`, `title`, `informations`, `dtregister`) VALUES
(18, 'Suporte', 'O que é considerado entulho e como descartar corretamente?', '<p style=\"text-align:center\"><img alt=\"\" src=\"https://www.vgresiduos.com.br/uploads/2019/02/entulho1.jpg\" style=\"height:600px; width:800px\" /></p>\r\n\r\n<p style=\"text-align:justify\">Entulho s&atilde;o os res&iacute;duos provenientes da constru&ccedil;&atilde;o civil ou de demoli&ccedil;&otilde;es. S&atilde;o formados por um conjunto de fragmentos ou restos de tijolo, concreto, argamassa, a&ccedil;o, madeira e etc...</p>\r\n\r\n<p style=\"text-align:justify\">A&nbsp;<a href=\"https://abrecon.org.br/\" target=\"_blank\">ABRECON (Associa&ccedil;&atilde;o Brasileira para Reciclagem de Res&iacute;duos da Constru&ccedil;&atilde;o Civil e Demoli&ccedil;&atilde;o)</a>&nbsp;classifica os res&iacute;duos da constru&ccedil;&atilde;o civil como&nbsp;<a href=\"https://abrecon.org.br/entulho/o-que-e-entulho/\" target=\"_blank\">entulho de constru&ccedil;&atilde;o e entulho de demoli&ccedil;&atilde;o</a>. O entulho de constru&ccedil;&atilde;o &eacute; formado por restos e fragmentos de materiais. Enquanto o de demoli&ccedil;&atilde;o &eacute; formado apenas por fragmentos.</p>\r\n\r\n<p>Entulho &eacute; comumente conhecido como cali&ccedil;a ou metralha. &Eacute; formado por um conjunto de fragmentos ou restos de tijolos, concreto, pedregulhos, areia, argamassa, e materiais in&uacute;teis resultantes da reforma e/ou demoli&ccedil;&atilde;o de estruturas, como pr&eacute;dios, resid&ecirc;ncias e pontes.</p>\r\n\r\n<p>Tecnicamente, &eacute;&nbsp;<a href=\"https://www.vgresiduos.com.br/blog/nova-instrucao-normativa-estabelece-procedimento-para-disposicao-de-residuos-da-construcao-civil/\" target=\"_blank\">res&iacute;duo de constru&ccedil;&atilde;o civil</a>, demoli&ccedil;&atilde;o ou todo res&iacute;duo gerado no processo construtivo, de reforma, escava&ccedil;&atilde;o ou demoli&ccedil;&atilde;o.</p>\r\n\r\n<p>Esse res&iacute;duo tem sido muito reaproveitado para aterrar, nivelar depress&atilde;o de terreno, vala e etc.. Por&eacute;m, h&aacute; outras formas de descarte correto, contribuindo assim para minimizar ou eliminar os&nbsp;<a href=\"https://www.vgresiduos.com.br/blog/impactos-da-ma-gestao-dos-residuos-solidos/\" target=\"_blank\">impactos ambientais provocados pela incorreta destina&ccedil;&atilde;o</a>.</p>\r\n\r\n<p>Contudo, h&aacute; outras empresas que n&atilde;o se preocupam com esses impactos e quase sempre os restos v&atilde;o parar em ruas ou terrenos. Ou ent&atilde;o, simplesmente, depositam em ca&ccedil;ambas sem garantia que o material ser&aacute; descartado de maneira ecologicamente correta.</p>\r\n\r\n<p>No entulho s&atilde;o encontrados diversos materiais, muitos deles podem ser reciclados para a produ&ccedil;&atilde;o de agregados.</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2021-03-29 14:52:47'),
(19, 'Suporte', 'Descarte correto do entulho', '<p style=\"text-align:center\"><img alt=\"\" src=\"https://www.vgresiduos.com.br/uploads/2019/02/entulho5.jpg\" style=\"height:466px; width:700px\" /></p>\r\n\r\n<p>O entulho deve ser reciclado ou reutilizado. A reutiliza&ccedil;&atilde;o e reciclagem de entulhos s&atilde;o consideradas uma pratica sustent&aacute;vel das empresas, pois al&eacute;m de&nbsp;<a href=\"https://www.vgresiduos.com.br/blog/diminuir-impactos-ambientais-na-construcao-civil/\" target=\"_blank\">diminuir o impacto ambiental</a>&nbsp;e reduz custos.</p>\r\n\r\n<p>As empresas geradoras de entulho devem implantar planos para gerenciamento de res&iacute;duos em suas obras, reduzir a&nbsp;gera&ccedil;&atilde;o e o desperd&iacute;cio de materiais. E ainda reutilizar, reciclar, e quando necess&aacute;rio, descartar os restos de forma adequada.</p>\r\n\r\n<p>Para o descarte correto do entulho &eacute; necess&aacute;rio consultar a prefeitura e verificar quais s&atilde;o os locais adequados para recolhimento do res&iacute;duo. As prefeituras que s&atilde;o respons&aacute;veis por estabelecer &aacute;reas adequadas para o descarte de entulho.</p>\r\n\r\n<p>Importante que a geradora&nbsp;<a href=\"https://www.vgresiduos.com.br/blog/como-rastrear-seu-residuo-e-garantir-que-ele-chegue-ao-destino/\" target=\"_blank\">certifique-se que a empresa contratada para recolher os entulhos &eacute; regularizada e que ir&aacute; destinar os restos de materiais em locais adequados</a>.</p>\r\n\r\n<p>Algumas geradoras viram que instalarem usinas m&oacute;veis no pr&oacute;prio canteiro de obra s&atilde;o interessantes financeiramente, pois n&atilde;o precisaram pagar pela disposi&ccedil;&atilde;o do entulho.</p>\r\n\r\n<p>Assim sendo, as empresas deve ter a consci&ecirc;ncia que buscar pelo descarte correto do entulho n&atilde;o &eacute; uma despesa extra, mas sim uma forma de investimento. Isso pode ser comprovado com algumas vantagens que a reciclagem e reutiliza&ccedil;&atilde;o de entulho tr&aacute;s as empresas, como: a simpatia dos clientes; melhor reputa&ccedil;&atilde;o no mercado; gera&ccedil;&atilde;o de receitas; e diminui&ccedil;&atilde;o da polui&ccedil;&atilde;o.</p>\r\n', '2021-03-28 13:04:45'),
(20, 'Suporte', 'Classificação do entulho', '<p style=\"text-align:center\"><img alt=\"\" src=\"https://www.vgresiduos.com.br/uploads/2019/02/entulho3.jpg\" style=\"height:466px; width:700px\" /></p>\r\n\r\n<p>Os procedimentos necess&aacute;rios para gest&atilde;o de res&iacute;duos da constru&ccedil;&atilde;o civil foram estabelecidos pela&nbsp;<a href=\"http://www2.mma.gov.br/port/conama/legiabre.cfm?codlegi=307\" target=\"_blank\">Resolu&ccedil;&atilde;o CONAMA n&ordm; 307/2002</a>.</p>\r\n\r\n<p>De acordo com a resolu&ccedil;&atilde;o existem quatro diferentes classes poss&iacute;veis de classifica&ccedil;&atilde;o do entulho. S&atilde;o elas:</p>\r\n\r\n<ul>\r\n	<li>Classe A: res&iacute;duos recicl&aacute;veis e pass&iacute;veis de reutiliza&ccedil;&atilde;o tais como: tijolos, blocos, telhas, placas de revestimento, argamassa e concreto;</li>\r\n	<li>Classe B: res&iacute;duos recicl&aacute;veis formados por pl&aacute;sticos, pap&eacute;is, metais, vidros e madeiras em geral, incluindo gesso;</li>\r\n	<li>Classe C: res&iacute;duos que n&atilde;o s&atilde;o passiveis de reciclagem ou recupera&ccedil;&atilde;o por n&atilde;o possuir tecnologia desenvolvida para isso;</li>\r\n	<li>Classe D: res&iacute;duos perigosos, tais como: tintas, solventes, &oacute;leos, amianto, produtos de demoli&ccedil;&otilde;es, reformas e reparos em cl&iacute;nicas radiol&oacute;gicas, instala&ccedil;&otilde;es industriais e outras.</li>\r\n</ul>\r\n', '2021-03-29 14:53:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_locations`
--

CREATE TABLE `tb_locations` (
  `idlocation` int(11) NOT NULL,
  `idmarker` int(11) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_locations`
--

INSERT INTO `tb_locations` (`idlocation`, `idmarker`, `lng`, `lat`, `dtregister`) VALUES
(15, 15, -48.00750732421875, -15.842462663871935, '2021-04-14 01:07:19'),
(16, 16, -47.66066551208496, -15.60865355312066, '2021-04-14 01:18:39'),
(17, 17, -47.882537841796875, -15.790932110184853, '2021-04-15 00:08:36'),
(22, 22, -47.66298294067383, -15.633369023346386, '2021-04-30 11:35:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_locations_collects`
--

CREATE TABLE `tb_locations_collects` (
  `idlocation` int(11) NOT NULL,
  `idcollect` int(11) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_locations_collects`
--

INSERT INTO `tb_locations_collects` (`idlocation`, `idcollect`, `lng`, `lat`, `dtregister`) VALUES
(13, 18, -47.99154281616211, -16.00452453080834, '2021-04-16 23:38:14'),
(14, 19, -48.046646118164055, -16.008030915129922, '2021-04-16 23:57:18'),
(15, 20, -48.00819396972656, -15.93227933760862, '2021-04-17 00:21:56'),
(19, 24, -48.014373779296875, -15.883413470228103, '2021-04-30 11:32:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_markerphotos`
--

CREATE TABLE `tb_markerphotos` (
  `idphoto` int(11) NOT NULL,
  `idmarker` int(11) NOT NULL,
  `namephoto` varchar(64) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_markerphotos`
--

INSERT INTO `tb_markerphotos` (`idphoto`, `idmarker`, `namephoto`, `dtregister`) VALUES
(13, 15, 'Captura de tela de 2020-12-18 11-36-06.png', '2021-04-14 01:07:19'),
(14, 15, 'Captura de tela de 2020-12-18 11-34-30.png', '2021-04-14 01:07:19'),
(15, 16, '', '2021-04-14 01:18:39'),
(16, 17, '', '2021-04-15 00:08:36'),
(21, 22, '', '2021-04-30 11:35:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_markers`
--

CREATE TABLE `tb_markers` (
  `idmarker` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `locality` varchar(128) NOT NULL,
  `observation` text,
  `type1` varchar(60) DEFAULT NULL,
  `type2` varchar(60) DEFAULT NULL,
  `type3` varchar(60) DEFAULT NULL,
  `type4` varchar(60) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_markers`
--

INSERT INTO `tb_markers` (`idmarker`, `iduser`, `locality`, `observation`, `type1`, `type2`, `type3`, `type4`, `dtregister`) VALUES
(15, 1, 'Quadra 516 conjunto c casa 20', '<p>Perto da igreja</p>', 'Classe A', 'Classe B', NULL, NULL, '2021-04-14 01:07:19'),
(16, 16, 'ss', '<p>ssss</p>', NULL, NULL, NULL, 'Classe D', '2021-04-14 01:18:39'),
(17, 1, 'Quadra 516 conjunto c casa 10', NULL, NULL, NULL, NULL, NULL, '2021-04-15 00:08:36'),
(22, 16, 'Quadra 516 conjunto c casa 20', '<p><strong>dasdasdsadsadsadsad</strong></p><p>adasdasdsadsadsadsa</p>', NULL, 'Classe B', NULL, NULL, '2021-04-30 11:35:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_users`
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
-- Extraindo dados da tabela `tb_users`
--

INSERT INTO `tb_users` (`iduser`, `person`, `email`, `phone`, `born_date`, `city`, `address`, `login`, `despassword`, `inadmin`, `genre`, `picture`, `dtregister`) VALUES
(1, 'Suporte', 'suporte@gmail.com', 6199999999999, '0001-01-01', 'São Sebastião - DF', 'Empresa S/A', 'admin', '$2y$12$hKaYkmysAUxuw4gYLdTL3eyB7eVzwt4.mK4gGCQUYMD0X/YNzINrG', 1, 1, '20201216121216', '2020-12-08 18:55:47'),
(16, 'Rafael Oliveira', 'rafaxvi@hotmail.com', 6191441738, '2020-12-22', 'Santa Maria- DF', 'Quadra 516 conjunto c casa 10', 'rafaxvi@hotmail.com', '$2y$12$AUcNWwtbjI7dvbVbWCwFA.RD87imXLpGy7hGJmSbd8jfY1CRuehf6', 0, 1, '20201222071227', '2020-12-18 13:03:43'),
(18, 'Adjair ', 'adjair@gmail.com', 6199633909, '2020-12-15', 'Sobradinho - DF', 'Quadra 518 conjunto c casa 22', 'suporte', '$2y$12$fi8aemKy9D0s.3b9.oh3muAWpIWwrqE7H2M2pqtQTHcnI2gfGCWmy', 1, 3, '20201218111250', '2020-12-18 14:21:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_userspasswordsrecoveries`
--

CREATE TABLE `tb_userspasswordsrecoveries` (
  `idrecovery` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `desip` varchar(45) NOT NULL,
  `dtrecovery` datetime DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_userspasswordsrecoveries`
--

INSERT INTO `tb_userspasswordsrecoveries` (`idrecovery`, `iduser`, `desip`, `dtrecovery`, `dtregister`) VALUES
(63, 16, '127.0.0.1', NULL, '2021-05-21 01:51:34'),
(64, 16, '127.0.0.1', '2021-05-20 23:24:28', '2021-05-21 02:22:39'),
(65, 16, '127.0.0.1', '2021-05-20 23:25:54', '2021-05-21 02:25:40'),
(66, 16, '127.0.0.1', '2021-05-20 23:32:31', '2021-05-21 02:32:15'),
(67, 16, '127.0.0.1', '2021-05-20 23:38:47', '2021-05-21 02:38:26'),
(68, 16, '127.0.0.1', '2021-05-20 23:59:33', '2021-05-21 02:59:07'),
(69, 16, '127.0.0.1', '2021-05-21 09:17:41', '2021-05-21 12:17:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_collectphotos`
--
ALTER TABLE `tb_collectphotos`
  ADD PRIMARY KEY (`idphoto`),
  ADD KEY `idcollect` (`idcollect`);

--
-- Índices para tabela `tb_collects`
--
ALTER TABLE `tb_collects`
  ADD PRIMARY KEY (`idcollect`),
  ADD KEY `iduser` (`iduser`);

--
-- Índices para tabela `tb_informations`
--
ALTER TABLE `tb_informations`
  ADD PRIMARY KEY (`idinf`);

--
-- Índices para tabela `tb_locations`
--
ALTER TABLE `tb_locations`
  ADD PRIMARY KEY (`idlocation`),
  ADD KEY `fk_locations_calls` (`idmarker`);

--
-- Índices para tabela `tb_locations_collects`
--
ALTER TABLE `tb_locations_collects`
  ADD PRIMARY KEY (`idlocation`),
  ADD KEY `idcollect` (`idcollect`);

--
-- Índices para tabela `tb_markerphotos`
--
ALTER TABLE `tb_markerphotos`
  ADD PRIMARY KEY (`idphoto`),
  ADD KEY `fk_callphotos_calls` (`idmarker`);

--
-- Índices para tabela `tb_markers`
--
ALTER TABLE `tb_markers`
  ADD PRIMARY KEY (`idmarker`),
  ADD KEY `fk_calls_users` (`iduser`);

--
-- Índices para tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`iduser`);

--
-- Índices para tabela `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  ADD PRIMARY KEY (`idrecovery`),
  ADD KEY `iduser` (`iduser`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_collectphotos`
--
ALTER TABLE `tb_collectphotos`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `tb_collects`
--
ALTER TABLE `tb_collects`
  MODIFY `idcollect` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `tb_informations`
--
ALTER TABLE `tb_informations`
  MODIFY `idinf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_locations`
--
ALTER TABLE `tb_locations`
  MODIFY `idlocation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tb_locations_collects`
--
ALTER TABLE `tb_locations_collects`
  MODIFY `idlocation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_markerphotos`
--
ALTER TABLE `tb_markerphotos`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tb_markers`
--
ALTER TABLE `tb_markers`
  MODIFY `idmarker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  MODIFY `idrecovery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_collectphotos`
--
ALTER TABLE `tb_collectphotos`
  ADD CONSTRAINT `fk_collectphotos_collects` FOREIGN KEY (`idcollect`) REFERENCES `tb_collects` (`idcollect`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_collects`
--
ALTER TABLE `tb_collects`
  ADD CONSTRAINT `fk_collects_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_locations`
--
ALTER TABLE `tb_locations`
  ADD CONSTRAINT `fk_locations_marker` FOREIGN KEY (`idmarker`) REFERENCES `tb_markers` (`idmarker`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_locations_collects`
--
ALTER TABLE `tb_locations_collects`
  ADD CONSTRAINT `fk_locations_collects_collects` FOREIGN KEY (`idcollect`) REFERENCES `tb_collects` (`idcollect`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_markerphotos`
--
ALTER TABLE `tb_markerphotos`
  ADD CONSTRAINT `fk_markerphotos_markers` FOREIGN KEY (`idmarker`) REFERENCES `tb_markers` (`idmarker`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_markers`
--
ALTER TABLE `tb_markers`
  ADD CONSTRAINT `fk_markers_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  ADD CONSTRAINT `fk_userspasswordsrecoveries_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
