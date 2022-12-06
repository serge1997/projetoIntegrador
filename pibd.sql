-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Dez-2022 às 01:04
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pibd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `id_cidade` int(11) NOT NULL,
  `nome_cidade` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`id_cidade`, `nome_cidade`) VALUES
(1, 'Curitiba'),
(2, 'Londrina'),
(3, 'Itapema');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `conteudo_comentario` varchar(255) DEFAULT NULL,
  `data_comentario` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_usuario`, `id_post`, `conteudo_comentario`, `data_comentario`) VALUES
(19, 2, 5, 'comentario', '2022-12-04 05:06:09'),
(20, 1, 5, 'autres commentaire', '2022-12-04 05:12:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curriculo`
--

CREATE TABLE `curriculo` (
  `id_curriculo_usuario` int(11) NOT NULL,
  `url_curriculo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `curriculo`
--

INSERT INTO `curriculo` (`id_curriculo_usuario`, `url_curriculo`) VALUES
(1, 'arquivospdf/196eca7209fc3dd5907986f55bfe794d.pdf'),
(2, 'arquivospdf/4b72cf2f245d629778456d50f0c521da.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco_usuario`
--

CREATE TABLE `endereco_usuario` (
  `id_usuarioend` int(11) NOT NULL,
  `id_pais_usuario` int(11) DEFAULT NULL,
  `id_estado_usuario` varchar(2) DEFAULT NULL,
  `id_cidade_usuario` int(11) DEFAULT NULL,
  `bairro_usuario` varchar(80) DEFAULT NULL,
  `rua_usuario` varchar(100) DEFAULT NULL,
  `numero_casa` varchar(6) DEFAULT NULL,
  `complemente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `endereco_usuario`
--

INSERT INTO `endereco_usuario` (`id_usuarioend`, `id_pais_usuario`, `id_estado_usuario`, `id_cidade_usuario`, `bairro_usuario`, `rua_usuario`, `numero_casa`, `complemente`) VALUES
(1, 1, 'PR', 1, 'uberaba', 'antonio carlos suplicy de lacerda', '229', 'appartamento 3'),
(2, 1, 'PR', 2, 'Santa quitiera', 'vicente perreira', '2055', 'casa 2055');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE `estados` (
  `id_estado` varchar(2) NOT NULL,
  `nome_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`id_estado`, `nome_estado`) VALUES
('PR', 'Parana'),
('RJ', 'Rio Janeiro'),
('SP', 'Sao Paulo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_adicionais_usuario`
--

CREATE TABLE `info_adicionais_usuario` (
  `id_info_usuario` int(11) NOT NULL,
  `celular_1` varchar(18) DEFAULT NULL,
  `whatzap_usuario` varchar(18) DEFAULT NULL,
  `texto_sobre_usuario` varchar(255) DEFAULT NULL,
  `titulo_perfil` varchar(80) DEFAULT NULL,
  `nome_faculdade` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `info_adicionais_usuario`
--

INSERT INTO `info_adicionais_usuario` (`id_info_usuario`, `celular_1`, `whatzap_usuario`, `texto_sobre_usuario`, `titulo_perfil`, `nome_faculdade`) VALUES
(1, '4199718-2410', NULL, 'eu sou', 'Estudante', 'TUITI'),
(2, '4199718-2410', NULL, 'teste apresentação', 'Dev. SOFTWARE WEB | PHP', 'UNIOPET');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nome_pais` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id_pais`, `nome_pais`) VALUES
(1, 'Brasil'),
(2, 'Cuba');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `url_arquivo` varchar(60) DEFAULT NULL,
  `conteudo_post` varchar(255) DEFAULT NULL,
  `data_post` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`id_post`, `id_usuario`, `url_arquivo`, `conteudo_post`, `data_post`) VALUES
(5, 2, 'arquivoimg/fbeff0d8257f54147962151818602ed8.png', 'Meu post-', '2022-12-04 05:05:49'),
(6, 1, 'arquivoimg/f3adb5d799fc808b68a31b357b99c606.png', 'Outro post para testar', '2022-12-04 05:13:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_img`
--

CREATE TABLE `usuario_img` (
  `id_img_usuario` int(11) NOT NULL,
  `url_arquivo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario_img`
--

INSERT INTO `usuario_img` (`id_img_usuario`, `url_arquivo`) VALUES
(1, 'arquivoimg/8ff3032c6b50424de65a46e18013b11c.png'),
(2, 'arquivoimg/9d350c5cae64adcaf08b57d8db10a1dd.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_rs`
--

CREATE TABLE `usuario_rs` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(60) DEFAULT NULL,
  `sobre_nome` varchar(100) DEFAULT NULL,
  `cpf_usuario` varchar(16) DEFAULT NULL,
  `mail_usuario` varchar(80) DEFAULT NULL,
  `senha_usuario` varchar(50) DEFAULT NULL,
  `confirm_usuario` varchar(50) DEFAULT NULL,
  `datanascimento_usuario` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario_rs`
--

INSERT INTO `usuario_rs` (`id_usuario`, `nome_usuario`, `sobre_nome`, `cpf_usuario`, `mail_usuario`, `senha_usuario`, `confirm_usuario`, `datanascimento_usuario`) VALUES
(1, 'Locthi Serge', 'Gogo', '11262445116', 'gogo@gmail.com', '1c88f916a3d6462b9d7cd46cebed0800', '1c88f916a3d6462b9d7cd46cebed0800', '1997-04-12'),
(2, 'Pablo', 'Perreira', '12934245112', 'pablo@gmail.com', '29c9a4dc6291a3d0d88752d72d989a72', '29c9a4dc6291a3d0d88752d72d989a72', '1990-08-14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagapublicado`
--

CREATE TABLE `vagapublicado` (
  `id_vagapublicado` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `titulo_vaga` varchar(50) DEFAULT NULL,
  `local_vaga` varchar(20) DEFAULT NULL,
  `dethale_vaga` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vagapublicado`
--

INSERT INTO `vagapublicado` (`id_vagapublicado`, `id_usuario`, `titulo_vaga`, `local_vaga`, `dethale_vaga`) VALUES
(19, 2, 'Desenvolvedor Front-end', 'São Paulo', 'Uma empresa em rápido crescimento, que está construindo uma plataforma inovadora que fornece inteligência de identidade e soluções de analytics, está procurando contratar um Desenvolvedor Front-end. O desenvolvedor será responsável por construir stacks es'),
(20, 2, 'Data science', 'Rio de janeiro', 'O colaborador será responsável pelo banco de dados e por todas as ações aplicadas neste banco assim como o gerenciamento de qualquer outro membro da equipe que por razões específicas venha a aplicar algum tipo de implementação na base de dados. ATRIBUIÇÕE'),
(21, 2, 'Dev PHP Junior', 'Curitiba, Batel', 'Este desafio é para atender a ECONET Editora, que tem 20 anos de mercado, continua em crescimento e expansão, e que tem na Tecnologia um pilar de extrema importância para alavancar os negócios da corporação, sustentado em pessoas e no seu desenvolvimento '),
(22, 2, 'Dev Java Senior', 'Londrina, PR', 'A Via opera as marcas ícones do varejo brasileiro que há mais de 60 anos estão presentes na mente, no coração e na casa dos brasileiros, como: Casas Bahia, Ponto, Extra.com.br, Fábrica de móveis Bartira, ASAPLog, I9XP e o BanQi. Com mais de 1200 lojas fís'),
(23, 2, 'Dev Python', 'Curitiba, paraná', 'saber mexer com python'),
(24, 2, 'dev react', 'canada', 'mexer no react');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga_candidata`
--

CREATE TABLE `vaga_candidata` (
  `id_vagacandidata` int(11) NOT NULL,
  `id_vagapublicado` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data_candidata` datetime DEFAULT NULL,
  `curiculo_usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vaga_candidata`
--

INSERT INTO `vaga_candidata` (`id_vagacandidata`, `id_vagapublicado`, `id_usuario`, `data_candidata`, `curiculo_usuario`) VALUES
(1, 20, 1, '0000-00-00 00:00:00', 'arquivospdf/9c652d548a372fc873ca469fea72b03c.pdf'),
(2, 21, 1, '0000-00-00 00:00:00', 'arquivospdf/9c652d548a372fc873ca469fea72b03c.pdf'),
(3, 21, 1, '0000-00-00 00:00:00', 'arquivospdf/9c652d548a372fc873ca469fea72b03c.pdf'),
(4, 22, 1, '2022-12-02 15:30:35', 'arquivospdf/9c652d548a372fc873ca469fea72b03c.pdf'),
(5, 20, 1, '2022-12-02 15:34:25', 'arquivospdf/9c652d548a372fc873ca469fea72b03c.pdf'),
(6, 22, 1, '2022-12-02 15:34:30', 'arquivospdf/9c652d548a372fc873ca469fea72b03c.pdf'),
(7, 21, 2, '2022-12-02 15:42:24', 'arquivospdf/a76ae979214a9203998c8d2226b9af36.pdf'),
(8, 20, 2, '2022-12-05 08:41:54', 'arquivospdf/a76ae979214a9203998c8d2226b9af36.pdf'),
(9, 20, 2, '2022-12-05 08:43:07', 'arquivospdf/a76ae979214a9203998c8d2226b9af36.pdf'),
(10, 20, 2, '2022-12-05 08:43:11', 'arquivospdf/a76ae979214a9203998c8d2226b9af36.pdf'),
(11, 20, 2, '2022-12-05 09:28:46', 'arquivospdf/4b72cf2f245d629778456d50f0c521da.pdf'),
(12, 20, 2, '2022-12-05 09:29:32', 'arquivospdf/4b72cf2f245d629778456d50f0c521da.pdf'),
(13, 24, 2, '2022-12-05 09:29:48', 'arquivospdf/4b72cf2f245d629778456d50f0c521da.pdf');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id_cidade`);

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `curriculo`
--
ALTER TABLE `curriculo`
  ADD PRIMARY KEY (`id_curriculo_usuario`);

--
-- Índices para tabela `endereco_usuario`
--
ALTER TABLE `endereco_usuario`
  ADD PRIMARY KEY (`id_usuarioend`),
  ADD KEY `id_pais_usuario` (`id_pais_usuario`),
  ADD KEY `id_estado_usuario` (`id_estado_usuario`),
  ADD KEY `id_cidade_usuario` (`id_cidade_usuario`);

--
-- Índices para tabela `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Índices para tabela `info_adicionais_usuario`
--
ALTER TABLE `info_adicionais_usuario`
  ADD PRIMARY KEY (`id_info_usuario`);

--
-- Índices para tabela `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Índices para tabela `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `usuario_img`
--
ALTER TABLE `usuario_img`
  ADD PRIMARY KEY (`id_img_usuario`);

--
-- Índices para tabela `usuario_rs`
--
ALTER TABLE `usuario_rs`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices para tabela `vagapublicado`
--
ALTER TABLE `vagapublicado`
  ADD PRIMARY KEY (`id_vagapublicado`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `vaga_candidata`
--
ALTER TABLE `vaga_candidata`
  ADD PRIMARY KEY (`id_vagacandidata`),
  ADD KEY `id_vagapublicado` (`id_vagapublicado`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `curriculo`
--
ALTER TABLE `curriculo`
  MODIFY `id_curriculo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `endereco_usuario`
--
ALTER TABLE `endereco_usuario`
  MODIFY `id_usuarioend` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `info_adicionais_usuario`
--
ALTER TABLE `info_adicionais_usuario`
  MODIFY `id_info_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario_img`
--
ALTER TABLE `usuario_img`
  MODIFY `id_img_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario_rs`
--
ALTER TABLE `usuario_rs`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vagapublicado`
--
ALTER TABLE `vagapublicado`
  MODIFY `id_vagapublicado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `vaga_candidata`
--
ALTER TABLE `vaga_candidata`
  MODIFY `id_vagacandidata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_rs` (`id_usuario`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

--
-- Limitadores para a tabela `endereco_usuario`
--
ALTER TABLE `endereco_usuario`
  ADD CONSTRAINT `endereco_usuario_ibfk_1` FOREIGN KEY (`id_pais_usuario`) REFERENCES `pais` (`id_pais`),
  ADD CONSTRAINT `endereco_usuario_ibfk_2` FOREIGN KEY (`id_estado_usuario`) REFERENCES `estados` (`id_estado`),
  ADD CONSTRAINT `endereco_usuario_ibfk_3` FOREIGN KEY (`id_cidade_usuario`) REFERENCES `cidades` (`id_cidade`);

--
-- Limitadores para a tabela `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_rs` (`id_usuario`);

--
-- Limitadores para a tabela `vagapublicado`
--
ALTER TABLE `vagapublicado`
  ADD CONSTRAINT `vagapublicado_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_rs` (`id_usuario`);

--
-- Limitadores para a tabela `vaga_candidata`
--
ALTER TABLE `vaga_candidata`
  ADD CONSTRAINT `vaga_candidata_ibfk_1` FOREIGN KEY (`id_vagapublicado`) REFERENCES `vagapublicado` (`id_vagapublicado`),
  ADD CONSTRAINT `vaga_candidata_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_rs` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
