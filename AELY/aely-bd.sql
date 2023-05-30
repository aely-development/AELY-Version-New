-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Maio-2023 às 03:40
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aely-bd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `cd_carrinho` int(11) NOT NULL,
  `cd_jogo` int(11) NOT NULL,
  `cd_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`cd_carrinho`, `cd_jogo`, `cd_usuario`) VALUES
(10, 112643, 13),
(16, 377320, 2),
(17, 112643, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chave`
--

CREATE TABLE `chave` (
  `cd_chave` int(11) NOT NULL,
  `id_chave` varchar(30) NOT NULL,
  `cd_jogo` int(11) NOT NULL,
  `cd_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE `jogo` (
  `cd_jogo` int(11) NOT NULL,
  `nm_jogo` varchar(50) NOT NULL,
  `nm_genero` varchar(50) NOT NULL,
  `ds_jogo` text NOT NULL,
  `dt_lancamento` date NOT NULL,
  `nm_desenvolvedora` varchar(50) NOT NULL,
  `vl_jogo` double NOT NULL,
  `valor_desconto` double DEFAULT NULL,
  `img_jogo` varchar(70) DEFAULT NULL,
  `status_jogo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `jogo`
--

INSERT INTO `jogo` (`cd_jogo`, `nm_jogo`, `nm_genero`, `ds_jogo`, `dt_lancamento`, `nm_desenvolvedora`, `vl_jogo`, `valor_desconto`, `img_jogo`, `status_jogo`) VALUES
(112643, 'Paladins', 'FPS', 'Paladins é um jogo eletrônico de tiro em primeira pessoa com multijogador online, baseado em equipes e gratuito para jogar, lançado como closed beta em 17 de novembro de 2015, e tendo seu beta aberto.', '2015-05-16', 'Hi Raz Studios', 125.9, NULL, 'img/64661f1e187f9.png', 1),
(128568, 'Far Cry 6', 'Tiro', 'Far Cry 6 é um jogo eletrônico de tiro em primeira pessoa desenvolvido pela Ubisoft Toronto e publicado pela Ubisoft. É o sexto título principal da série Far Cry', '2021-05-11', 'Ubisoft', 3599, NULL, 'img/64664b2e21efe.png', 1),
(164485, 'Tom Clancy\'s Rainbow Six Siege', 'Tiro', 'Tom Clancy\'s Rainbow Six Siege é um videojogo do género first person shooter produzido pela Ubisoft Montreal. Foi anunciado pela Ubisoft a 9 de Junho de 2014 na Electronic Entertainment Expo 2014 onde foi muito aplaudido pela crítica.', '2014-05-08', 'Ubisoft', 159.9, NULL, 'img/64661d5ce56e3.png', 1),
(178058, 'Gta V', 'Ação', 'Grand Theft Auto V é um jogo eletrônico de ação-aventura desenvolvido pela Rockstar North e publicado pela Rockstar Games.', '2014-05-03', 'Rockstar', 150, NULL, 'img/64661b5fb56ae.png', 1),
(377320, 'League of Legends', 'Moba', 'League of Legends é um jogo eletrônico do gênero multiplayer online battle arena desenvolvido e publicado pela Riot Games. Foi lançado em outubro de 2009 para Microsoft Windows e em março de 2013 para macOS.', '2013-05-10', 'Riot Games', 25, NULL, 'img/64661e9ff1fdc.png', 1),
(473279, 'Rocket League', 'Carros', 'Rocket League é um jogo eletrônico de futebol em veículos desenvolvido e publicado pela Psyonix. Foi lançado pela primeira vez para Microsoft Windows e PlayStation 4 em julho de 2015, com as portes para o Xbox One, MacOS, Linux e Nintendo Switch sendo lançados posteriormente.', '2015-05-04', 'Psyonix', 98.9, NULL, 'img/64661f8e3e31a.png', 1),
(635448, 'Fortnite', 'Battle Royale', 'Awdawdawdawdawdawdawd', '2018-05-25', 'Epic Games', 10, NULL, 'img/646646670558e.png', 1),
(657412, 'CS:GO', 'Tiro', 'Counter-Strike: Global Offensive é um jogo online desenvolvido pela Valve Corporation e pela Hidden Path Entertainment, sendo uma sequência de Counter-Strike: Source. É o quarto título principal da franquia', '2012-05-15', 'Valve Corporation', 50, NULL, 'img/64661d19cf632.png', 1),
(808512, 'Valorant', 'FPS', 'Valorant é um jogo eletrônico multijogador gratuito para jogar de tiro em primeira pessoa desenvolvido e publicado pela Riot Games', '2018-05-10', 'Riot Games', 64.3, NULL, 'img/64661df5ee9c9.png', 1),
(845045, 'PlayerUnknown\'s Battlegrounds', 'Battle Royale', 'PlayerUnknown\'s Battlegrounds é um jogo eletrônico multiplayer desenvolvido pela PUBG Corporation, subsidiária da produtora coreana Bluehole, utilizando o motor de jogo Unreal Engine 4.', '2016-05-11', 'PUBG Corporation', 200, NULL, 'img/64661e3569d12.png', 1),
(850527, 'Among Us', 'Sobrevivência', 'Among Us é um jogo eletrônico online, dos gêneros jogo em grupo e sobrevivência, desenvolvido e publicado pelo estúdio de jogos estadunidense InnerSloth.', '2018-05-01', 'InnerSloth', 36.5, NULL, 'img/64661d917687e.png', 1),
(852469, 'Overwatch 2', 'FPS', 'Overwatch 2 é um jogo eletrônico multijogador de tiro em primeira pessoa publicado e distribuído pela Blizzard Entertainment.', '2021-05-24', 'Blizzard Entertainment', 269.5, NULL, 'img/64661edfd48e7.png', 1),
(986416, 'Minecraft', 'Aventura', 'Minecraft é um jogo eletrônico lançado em 2009 que consiste em sobreviver em um mundo formado (majoritariamente) por blocos cúbicos.', '2009-05-05', 'Microsoft', 78.9, NULL, 'img/64661e77a1ea9.png', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `listadesejo`
--

CREATE TABLE `listadesejo` (
  `cd_listaDesejo` int(11) NOT NULL,
  `cd_jogo` int(11) NOT NULL,
  `cd_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `listadesejo`
--

INSERT INTO `listadesejo` (`cd_listaDesejo`, `cd_jogo`, `cd_usuario`) VALUES
(1, 635448, 2),
(3, 164485, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `cd_pedido` int(11) NOT NULL,
  `dt_pedido` date NOT NULL,
  `vl_pedido` float(10,2) NOT NULL,
  `cd_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`cd_pedido`, `dt_pedido`, `vl_pedido`, `cd_usuario`) VALUES
(106732, '2023-05-29', 159.90, 2),
(111631, '2023-05-29', 50.00, 2),
(394961, '2023-05-29', 50.00, 2),
(410728, '2023-05-29', 150.00, 2),
(814232, '2023-05-29', 159.90, 2),
(905742, '2023-05-29', 159.90, 2),
(959634, '2023-05-29', 125.90, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cd_usuario` int(11) NOT NULL,
  `nm_usuario` varchar(70) NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `senha_usuario` varchar(32) NOT NULL,
  `usuario_adm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cd_usuario`, `nm_usuario`, `email_usuario`, `senha_usuario`, `usuario_adm`) VALUES
(1, 'administrador', 'adm@gmail.com', '2facc38077ab12af73c2872bf41b7885', 1),
(2, 'yohan', 'yohan.aquino@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 0),
(6, 'Pedro Henrique Garcia Rocha', 'pedro@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0),
(7, 'Pedro', 'pedroo@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(8, 'Jorge', 'jorge@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(9, 'Luiz', 'luiz@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(13, 'y', 'y@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`cd_carrinho`),
  ADD KEY `cd_jogo` (`cd_jogo`);

--
-- Índices para tabela `chave`
--
ALTER TABLE `chave`
  ADD PRIMARY KEY (`cd_chave`),
  ADD KEY `fk_chave_jogo` (`cd_jogo`),
  ADD KEY `fk_chave_pedido` (`cd_pedido`);

--
-- Índices para tabela `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`cd_jogo`);

--
-- Índices para tabela `listadesejo`
--
ALTER TABLE `listadesejo`
  ADD PRIMARY KEY (`cd_listaDesejo`),
  ADD KEY `cd_jogo` (`cd_jogo`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`cd_pedido`),
  ADD KEY `fk_pedido_usuario` (`cd_usuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cd_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `cd_carrinho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `chave`
--
ALTER TABLE `chave`
  MODIFY `cd_chave` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `listadesejo`
--
ALTER TABLE `listadesejo`
  MODIFY `cd_listaDesejo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `cd_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=959635;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cd_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `chave`
--
ALTER TABLE `chave`
  ADD CONSTRAINT `fk_chave_jogo` FOREIGN KEY (`cd_jogo`) REFERENCES `chave` (`cd_chave`),
  ADD CONSTRAINT `fk_chave_pedido` FOREIGN KEY (`cd_pedido`) REFERENCES `pedido` (`cd_pedido`);

--
-- Limitadores para a tabela `listadesejo`
--
ALTER TABLE `listadesejo`
  ADD CONSTRAINT `listadesejo_ibfk_1` FOREIGN KEY (`cd_jogo`) REFERENCES `jogo` (`cd_jogo`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`cd_usuario`) REFERENCES `usuario` (`cd_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
