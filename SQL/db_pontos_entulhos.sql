-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 28/03/2021 às 10:05
-- Versão do servidor: 5.7.33-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.24-0ubuntu0.18.04.7

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_call_save` (IN `piduser` INT(11), IN `plocality` VARCHAR(128), IN `pobservation` TEXT, IN `ptype1` VARCHAR(60), IN `ptype2` VARCHAR(60), IN `ptype3` VARCHAR(60), IN `ptype4` VARCHAR(60))  NO SQL
BEGIN
   
    INSERT INTO tb_calls (iduser,locality,observation,type1,type2,type3,type4)
    
    VALUES(piduser,plocality,pobservation,ptype1,ptype2,ptype3,ptype4);
    
    
  SELECT * FROM tb_calls  WHERE idcall = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_image_call_add` (IN `pidcall` INT(11), IN `pnamephoto` VARCHAR(64))  NO SQL
BEGIN

INSERT INTO tb_callphotos (idcall,namephoto)
    VALUES(pidcall,pnamephoto);
   

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
  `namephoto` varchar(64) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_callphotos`
--

INSERT INTO `tb_callphotos` (`idphoto`, `idcall`, `namephoto`, `dtregister`) VALUES
(2, 2, 'Captura de tela de 2020-12-18 11-36-30.png', '2021-03-03 18:06:18'),
(3, 2, 'Captura de tela de 2020-12-18 11-36-49.png', '2021-03-03 18:06:18'),
(4, 2, 'Captura de tela de 2020-12-18 11-36-55.png', '2021-03-03 18:06:18'),
(5, 3, 'Captura de tela de 2020-12-18 11-36-44.png', '2021-03-03 18:08:26'),
(6, 3, 'Captura de tela de 2020-12-18 11-36-49.png', '2021-03-03 18:08:26'),
(7, 4, '', '2021-03-15 02:25:38'),
(8, 5, '', '2021-03-15 02:25:46'),
(9, 6, '', '2021-03-15 02:25:56'),
(10, 7, '', '2021-03-15 02:27:42'),
(12, 9, '', '2021-03-24 02:33:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_calls`
--

CREATE TABLE `tb_calls` (
  `idcall` int(11) NOT NULL,
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
-- Despejando dados para a tabela `tb_calls`
--

INSERT INTO `tb_calls` (`idcall`, `iduser`, `locality`, `observation`, `type1`, `type2`, `type3`, `type4`, `dtregister`) VALUES
(2, 16, 'Quadra 516 conjunto c casa 20', '<p>Perto da Igreja</p>', 'Classe A', 'Classe B', NULL, NULL, '2021-03-03 18:06:18'),
(3, 16, 'Quadra 516 conjunto c casa 15', '<p>Perto do bar</p>', 'Classe A', 'Classe B', NULL, NULL, '2021-03-03 18:08:26'),
(4, 16, 'Quadra 516 conjunto c casa 20', '', NULL, 'Classe B', NULL, NULL, '2021-03-15 02:25:38'),
(5, 16, 'Quadra 517', '', NULL, 'Classe B', 'Classe C', NULL, '2021-03-15 02:25:46'),
(6, 16, 'Setor Leste quadra 8 Gama', '', 'Classe A', 'Classe B', 'Classe C', 'Classe D', '2021-03-15 02:25:56'),
(7, 16, 'Quadra 516 conjunto c casa 20', '', NULL, 'Classe B', 'Classe C', NULL, '2021-03-15 02:27:42'),
(9, 1, 'Quadra 516 conjunto c casa 20', '', NULL, NULL, 'Classe C', NULL, '2021-03-24 02:33:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_informations`
--

CREATE TABLE `tb_informations` (
  `idinf` int(11) NOT NULL,
  `person` varchar(64) NOT NULL,
  `title` varchar(64) NOT NULL,
  `informations` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_informations`
--

INSERT INTO `tb_informations` (`idinf`, `person`, `title`, `informations`, `dtregister`) VALUES
(18, 'Suporte', 'O que é considerado entulho e como descartar corretamente?', '<p style=\"text-align:center\"><img alt=\"\" src=\"https://www.vgresiduos.com.br/uploads/2019/02/entulho1.jpg\" style=\"height:600px; width:800px\" /></p>\r\n\r\n<p style=\"text-align:justify\">Entulho s&atilde;o os res&iacute;duos provenientes da constru&ccedil;&atilde;o civil ou de demoli&ccedil;&otilde;es. S&atilde;o formados por um conjunto de fragmentos ou restos de tijolo, concreto, argamassa, a&ccedil;o, madeira e etc...</p>\r\n\r\n<p style=\"text-align:justify\">A&nbsp;<a href=\"https://abrecon.org.br/\" target=\"_blank\">ABRECON (Associa&ccedil;&atilde;o Brasileira para Reciclagem de Res&iacute;duos da Constru&ccedil;&atilde;o Civil e Demoli&ccedil;&atilde;o)</a>&nbsp;classifica os res&iacute;duos da constru&ccedil;&atilde;o civil como&nbsp;<a href=\"https://abrecon.org.br/entulho/o-que-e-entulho/\" target=\"_blank\">entulho de constru&ccedil;&atilde;o e entulho de demoli&ccedil;&atilde;o</a>. O entulho de constru&ccedil;&atilde;o &eacute; formado por restos e fragmentos de materiais. Enquanto o de demoli&ccedil;&atilde;o &eacute; formado apenas por fragmentos.</p>\r\n\r\n<h2><strong>Entulho</strong></h2>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><strong><img alt=\"\" src=\"https://www.vgresiduos.com.br/uploads/2019/02/entulho2.jpg\" style=\"height:600px; width:800px\" /></strong></p>\r\n\r\n<p>Entulho &eacute; comumente conhecido como cali&ccedil;a ou metralha. &Eacute; formado por um conjunto de fragmentos ou restos de tijolos, concreto, pedregulhos, areia, argamassa, e materiais in&uacute;teis resultantes da reforma e/ou demoli&ccedil;&atilde;o de estruturas, como pr&eacute;dios, resid&ecirc;ncias e pontes.</p>\r\n\r\n<p>Tecnicamente, &eacute;&nbsp;<a href=\"https://www.vgresiduos.com.br/blog/nova-instrucao-normativa-estabelece-procedimento-para-disposicao-de-residuos-da-construcao-civil/\" target=\"_blank\">res&iacute;duo de constru&ccedil;&atilde;o civil</a>, demoli&ccedil;&atilde;o ou todo res&iacute;duo gerado no processo construtivo, de reforma, escava&ccedil;&atilde;o ou demoli&ccedil;&atilde;o.</p>\r\n\r\n<p>Esse res&iacute;duo tem sido muito reaproveitado para aterrar, nivelar depress&atilde;o de terreno, vala e etc.. Por&eacute;m, h&aacute; outras formas de descarte correto, contribuindo assim para minimizar ou eliminar os&nbsp;<a href=\"https://www.vgresiduos.com.br/blog/impactos-da-ma-gestao-dos-residuos-solidos/\" target=\"_blank\">impactos ambientais provocados pela incorreta destina&ccedil;&atilde;o</a>.</p>\r\n\r\n<p>Contudo, h&aacute; outras empresas que n&atilde;o se preocupam com esses impactos e quase sempre os restos v&atilde;o parar em ruas ou terrenos. Ou ent&atilde;o, simplesmente, depositam em ca&ccedil;ambas sem garantia que o material ser&aacute; descartado de maneira ecologicamente correta.</p>\r\n\r\n<p>No entulho s&atilde;o encontrados diversos materiais, muitos deles podem ser reciclados para a produ&ccedil;&atilde;o de agregados.</p>\r\n\r\n<h2><strong>Classifica&ccedil;&atilde;o do entulho</strong></h2>\r\n\r\n<p>Os procedimentos necess&aacute;rios para gest&atilde;o de res&iacute;duos da constru&ccedil;&atilde;o civil foram estabelecidos pela&nbsp;<a href=\"http://www2.mma.gov.br/port/conama/legiabre.cfm?codlegi=307\" target=\"_blank\">Resolu&ccedil;&atilde;o CONAMA n&ordm; 307/2002</a>.</p>\r\n\r\n<p>De acordo com a resolu&ccedil;&atilde;o existem quatro diferentes classes poss&iacute;veis de classifica&ccedil;&atilde;o do entulho. S&atilde;o elas:</p>\r\n\r\n<ul>\r\n	<li>Classe A: res&iacute;duos recicl&aacute;veis e pass&iacute;veis de reutiliza&ccedil;&atilde;o tais como: tijolos, blocos, telhas, placas de revestimento, argamassa e concreto;</li>\r\n	<li>Classe B: res&iacute;duos recicl&aacute;veis formados por pl&aacute;sticos, pap&eacute;is, metais, vidros e madeiras em geral, incluindo gesso;</li>\r\n	<li>Classe C: res&iacute;duos que n&atilde;o s&atilde;o passiveis de reciclagem ou recupera&ccedil;&atilde;o por n&atilde;o possuir tecnologia desenvolvida para isso;</li>\r\n	<li>Classe D: res&iacute;duos perigosos, tais como: tintas, solventes, &oacute;leos, amianto, produtos de demoli&ccedil;&otilde;es, reformas e reparos em cl&iacute;nicas radiol&oacute;gicas, instala&ccedil;&otilde;es industriais e outras.</li>\r\n</ul>\r\n', '2021-03-28 12:59:57'),
(19, 'Suporte', 'Descarte correto do entulho', '<p style=\"text-align:center\"><img alt=\"\" src=\"https://www.vgresiduos.com.br/uploads/2019/02/entulho5.jpg\" style=\"height:466px; width:700px\" /></p>\r\n\r\n<p>O entulho deve ser reciclado ou reutilizado. A reutiliza&ccedil;&atilde;o e reciclagem de entulhos s&atilde;o consideradas uma pratica sustent&aacute;vel das empresas, pois al&eacute;m de&nbsp;<a href=\"https://www.vgresiduos.com.br/blog/diminuir-impactos-ambientais-na-construcao-civil/\" target=\"_blank\">diminuir o impacto ambiental</a>&nbsp;e reduz custos.</p>\r\n\r\n<p>As empresas geradoras de entulho devem implantar planos para gerenciamento de res&iacute;duos em suas obras, reduzir a&nbsp;gera&ccedil;&atilde;o e o desperd&iacute;cio de materiais. E ainda reutilizar, reciclar, e quando necess&aacute;rio, descartar os restos de forma adequada.</p>\r\n\r\n<p>Para o descarte correto do entulho &eacute; necess&aacute;rio consultar a prefeitura e verificar quais s&atilde;o os locais adequados para recolhimento do res&iacute;duo. As prefeituras que s&atilde;o respons&aacute;veis por estabelecer &aacute;reas adequadas para o descarte de entulho.</p>\r\n\r\n<p>Importante que a geradora&nbsp;<a href=\"https://www.vgresiduos.com.br/blog/como-rastrear-seu-residuo-e-garantir-que-ele-chegue-ao-destino/\" target=\"_blank\">certifique-se que a empresa contratada para recolher os entulhos &eacute; regularizada e que ir&aacute; destinar os restos de materiais em locais adequados</a>.</p>\r\n\r\n<p>Algumas geradoras viram que instalarem usinas m&oacute;veis no pr&oacute;prio canteiro de obra s&atilde;o interessantes financeiramente, pois n&atilde;o precisaram pagar pela disposi&ccedil;&atilde;o do entulho.</p>\r\n\r\n<p>Assim sendo, as empresas deve ter a consci&ecirc;ncia que buscar pelo descarte correto do entulho n&atilde;o &eacute; uma despesa extra, mas sim uma forma de investimento. Isso pode ser comprovado com algumas vantagens que a reciclagem e reutiliza&ccedil;&atilde;o de entulho tr&aacute;s as empresas, como: a simpatia dos clientes; melhor reputa&ccedil;&atilde;o no mercado; gera&ccedil;&atilde;o de receitas; e diminui&ccedil;&atilde;o da polui&ccedil;&atilde;o.</p>\r\n', '2021-03-28 13:04:45');

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

--
-- Despejando dados para a tabela `tb_locations`
--

INSERT INTO `tb_locations` (`idlocation`, `idcall`, `lng`, `lat`, `dtregister`) VALUES
(2, 2, -48.12835693359374, -15.865581076914056, '2021-03-03 18:06:18'),
(3, 3, -48.08372497558594, -15.919733829588507, '2021-03-03 18:08:26'),
(4, 4, -48.06587219238281, -15.80150355021274, '2021-03-15 02:25:38'),
(5, 5, -47.75138854980469, -15.612456127149047, '2021-03-15 02:25:46'),
(6, 6, -48.05488586425781, -15.926336826256039, '2021-03-15 02:25:56'),
(7, 7, -48.065185546875, -15.85303140995983, '2021-03-15 02:27:42'),
(9, 9, -48.043212890625, -15.743353808409257, '2021-03-24 02:33:46');

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
(16, 'Rafael Oliveira', 'rafaxvi@hotmail.com', 6191441738, '2020-12-22', 'Planaltina - DF', 'Quadra 516 conjunto c casa 10', 'rafaxvi@hotmail.com', '$2y$12$ASdDwhq473Syx5F0U0cp2OfngHKgMiVOFrkw3gSAEA/rBbcSzEHKu', 0, 1, '20201222071227', '2020-12-18 13:03:43'),
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
  ADD KEY `fk_callphotos_calls` (`idcall`);

--
-- Índices de tabela `tb_calls`
--
ALTER TABLE `tb_calls`
  ADD PRIMARY KEY (`idcall`),
  ADD KEY `fk_calls_users` (`iduser`);

--
-- Índices de tabela `tb_informations`
--
ALTER TABLE `tb_informations`
  ADD PRIMARY KEY (`idinf`);

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
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_callphotos`
--
ALTER TABLE `tb_callphotos`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_calls`
--
ALTER TABLE `tb_calls`
  MODIFY `idcall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tb_informations`
--
ALTER TABLE `tb_informations`
  MODIFY `idinf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_locations`
--
ALTER TABLE `tb_locations`
  MODIFY `idlocation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `fk_callphotos_calls` FOREIGN KEY (`idcall`) REFERENCES `tb_calls` (`idcall`) ON DELETE CASCADE ON UPDATE CASCADE;

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
