-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Mar-2018 às 02:29
-- Versão do servidor: 5.7.18-log
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alterar`
--

CREATE TABLE `alterar` (
  `id` int(11) NOT NULL,
  `alteracao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alterar`
--

INSERT INTO `alterar` (`id`, `alteracao`) VALUES
(1, 'f429391e858a3c038d93ba75ecd3bb4f');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `idSala` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `turno` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `horario`
--

INSERT INTO `horario` (`id`, `idTurma`, `idProfessor`, `idSala`, `idTipo`, `turno`) VALUES
(1, 67, 72, 47, 2, 'Matutino'),
(2, 89, 15, 12, 2, 'Vespertino'),
(3, 30, 2, 34, 2, 'Noturno'),
(4, 30, 2, 1, 2, 'Noturno'),
(5, 21, 3, 10, 1, 'Noturno'),
(6, 30, 72, 47, 2, 'Noturno'),
(7, 20, 72, 47, 2, 'Noturno'),
(8, 30, 4, 47, 2, 'Noturno'),
(9, 30, 79, 47, 2, 'Noturno'),
(10, 30, 72, 47, 3, 'Noturno'),
(11, 89, 66, 13, 3, 'Vespertino'),
(12, 84, 72, 47, 2, 'Vespertino'),
(13, 84, 72, 47, 2, 'Vespertino'),
(14, 67, 72, 47, 2, 'Matutino'),
(15, 86, 72, 47, 2, 'Vespertino'),
(16, 86, 72, 1, 2, 'Vespertino'),
(17, 10, 8, 8, 1, 'Noturno'),
(18, 4, 87, 3, 1, 'Noturno'),
(19, 101, 57, 26, 1, 'Noturno'),
(20, 5, 27, 47, 1, 'Noturno'),
(21, 6, 17, 7, 1, 'Noturno'),
(22, 9, 78, 24, 1, 'Noturno'),
(23, 8, 20, 1, 1, 'Noturno'),
(24, 7, 3, 28, 1, 'Noturno'),
(25, 11, 1, 12, 1, 'Noturno'),
(26, 13, 64, 9, 1, 'Noturno'),
(27, 12, 13, 22, 1, 'Noturno'),
(28, 125, 35, 6, 3, 'Noturno'),
(29, 128, 90, 2, 3, 'Noturno'),
(30, 126, 52, 43, 3, 'Noturno'),
(32, 8, 79, 10, 1, 'Noturno'),
(33, 16, 6, 11, 1, 'Noturno'),
(34, 10, 6, 14, 1, 'Noturno'),
(35, 21, 72, 4, 1, 'Noturno'),
(36, 27, 4, 47, 1, 'Noturno'),
(37, 101, 72, 47, 1, 'Noturno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id`, `nome`) VALUES
(72, '------'),
(2, 'Alcione Miguel Franz'),
(3, 'Aldair Silva'),
(4, 'Alexandre Heinz'),
(79, 'Ana Paula'),
(5, 'Andrei Rodrigues'),
(6, 'Atanael Louren'),
(7, 'Augusto Rodrigues de Lisboa'),
(8, 'Breno Thales'),
(9, 'Camila Felipe Tonn'),
(10, 'Carlos Penna'),
(11, 'Cheila Soares'),
(12, 'Cláudia Finardi'),
(13, 'Cleiton Edacir'),
(80, 'Coffe Break'),
(14, 'Danilo Vieira'),
(15, 'Darcy Ribeiro'),
(17, 'Douglas Moreira'),
(18, 'Douglas Siegel'),
(19, 'Edmar Delilo'),
(20, 'Edson Carvalho'),
(21, 'Edson Cruz'),
(22, 'Eugenio Pazini'),
(23, 'Everton Lisboa'),
(24, 'Fabiana Dallmann'),
(25, 'Fabio Hermann'),
(26, 'Fabio Lima'),
(27, 'Fábio Rosa  '),
(28, 'Fabrício Lohn'),
(84, 'Fernanda Flor'),
(78, 'Geysson'),
(29, 'Gilson Luis Rufino'),
(30, 'Gilson Rufino'),
(31, 'Giselle Barcelos'),
(87, 'Helton Espezim'),
(32, 'Ibanez Guterres'),
(33, 'Jackson Pinheiro'),
(81, 'Janaína Cardoso'),
(34, 'Jeferson Koslovoski'),
(86, 'Jimena Kirchner'),
(35, 'João Bucciano  '),
(36, 'João Silveira'),
(37, 'Jorge Souza'),
(90, 'José Júnior'),
(38, 'José Silva'),
(83, 'Karla Cristina'),
(39, 'Leandro Luis'),
(40, 'Lessandra Michel'),
(41, 'Luidy Mateus'),
(42, 'Magda Ramos'),
(43, 'Maicon Pereira'),
(76, 'Mariana Chaves'),
(44, 'Mario Nascimento'),
(45, 'Marlon D Avila'),
(46, 'Mateus Gonçalves'),
(47, 'Max Andrade  '),
(48, 'Mery Cristina'),
(49, 'Mônica Kremer'),
(50, 'Não Haverá'),
(51, 'Nivaldo Assis '),
(52, 'Pedro Rachadel'),
(82, 'Priscila Clézia'),
(77, 'Rafael Duarte'),
(89, 'Rafael Lindemann'),
(53, 'Rafael Silveira'),
(75, 'Renan Luis'),
(73, 'Roberto Dusik'),
(54, 'Roberto Machado'),
(55, 'Rodrigo Dias'),
(56, 'Rodrigo Luis'),
(57, 'Rodrigo Pacheco'),
(58, 'Rodrigo Santos'),
(59, 'Roger Pardim'),
(60, 'Rogerio Mendonça'),
(61, 'Sheila Travessa'),
(62, 'Sônia Moreira'),
(63, 'Sônia Pinto'),
(64, 'Susan Thiessen'),
(65, 'Tatiana Lee Marques'),
(66, 'Tatiana Marques'),
(67, 'Teófilo Junior'),
(88, 'Thiago Carrano'),
(68, 'Tiago Medeiros'),
(69, 'Tiago Moreira'),
(85, 'Urânia Rickes'),
(70, 'Vanusa Feijo'),
(1, 'Vinicius Silva'),
(71, 'Vinicius Silveira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro`
--

CREATE TABLE `registro` (
  `id` bigint(20) NOT NULL,
  `idHorario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `registro`
--

INSERT INTO `registro` (`id`, `idHorario`, `data`) VALUES
(2, 2, '2018-03-23'),
(4, 4, '2018-03-23'),
(5, 5, '2018-03-23'),
(6, 6, '2018-03-23'),
(7, 8, '2018-03-23'),
(8, 10, '2018-03-23'),
(9, 11, '2018-03-01'),
(10, 11, '2018-03-02'),
(11, 11, '2018-03-05'),
(12, 11, '2018-03-06'),
(13, 11, '2018-03-07'),
(14, 11, '2018-03-08'),
(15, 11, '2018-03-09'),
(16, 11, '2018-03-12'),
(17, 11, '2018-03-13'),
(18, 11, '2018-03-14'),
(19, 11, '2018-03-15'),
(20, 11, '2018-03-16'),
(21, 11, '2018-03-19'),
(22, 11, '2018-03-20'),
(23, 11, '2018-03-21'),
(24, 11, '2018-03-22'),
(25, 11, '2018-03-23'),
(26, 11, '2018-03-26'),
(27, 11, '2018-03-27'),
(28, 11, '2018-03-28'),
(29, 11, '2018-03-29'),
(30, 11, '2018-03-30'),
(31, 12, '2018-03-27'),
(32, 14, '2018-03-01'),
(33, 14, '2018-03-31'),
(34, 15, '2018-03-01'),
(35, 15, '2018-03-31'),
(36, 16, '2018-03-27'),
(37, 1, '2018-03-01'),
(38, 1, '2018-03-02'),
(39, 1, '2018-03-05'),
(40, 1, '2018-03-06'),
(41, 1, '2018-03-07'),
(42, 1, '2018-03-08'),
(43, 1, '2018-03-09'),
(44, 1, '2018-03-12'),
(45, 1, '2018-03-13'),
(46, 1, '2018-03-14'),
(47, 1, '2018-03-15'),
(48, 1, '2018-03-16'),
(49, 1, '2018-03-19'),
(50, 1, '2018-03-20'),
(51, 1, '2018-03-21'),
(52, 1, '2018-03-22'),
(53, 1, '2018-03-23'),
(54, 1, '2018-03-26'),
(55, 1, '2018-03-27'),
(56, 1, '2018-03-28'),
(57, 1, '2018-03-29'),
(58, 1, '2018-03-30'),
(59, 17, '2018-03-27'),
(60, 18, '2018-03-27'),
(61, 19, '2018-03-27'),
(62, 20, '2018-03-27'),
(63, 21, '2018-03-27'),
(64, 22, '2018-03-27'),
(65, 23, '2018-03-27'),
(66, 24, '2018-03-27'),
(67, 25, '2018-03-27'),
(68, 26, '2018-03-27'),
(69, 27, '2018-03-27'),
(70, 28, '2018-03-27'),
(71, 29, '2018-03-27'),
(72, 30, '2018-03-27'),
(74, 32, '2018-03-27'),
(75, 33, '2018-03-27'),
(76, 34, '2018-03-27'),
(77, 35, '2018-03-27'),
(78, 36, '2018-03-27'),
(79, 37, '2018-03-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id`, `nome`) VALUES
(47, '101'),
(1, '102'),
(2, '201'),
(3, '202'),
(4, '203'),
(5, '204'),
(6, '205'),
(7, '206'),
(8, '303'),
(9, '304'),
(10, '305'),
(11, '306'),
(12, '307'),
(13, '401'),
(14, '402'),
(15, '403'),
(16, '501'),
(17, '502'),
(18, '503'),
(19, '504'),
(20, '505'),
(21, '506'),
(22, '511'),
(23, '512'),
(24, '513'),
(25, '514'),
(26, '515'),
(27, '516'),
(28, '517'),
(29, '521'),
(30, '522'),
(31, '523'),
(32, '524'),
(33, '525'),
(34, '526'),
(35, '527'),
(36, '603'),
(37, '701'),
(38, '702'),
(39, '703'),
(40, '704'),
(41, '705'),
(42, '706'),
(43, '707'),
(48, '708'),
(45, 'Auditório'),
(46, 'Não Haverá aula'),
(44, 'SEP Lab. Externo de SEP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id`, `nome`) VALUES
(2, 'APRENDIZAGEM'),
(4, 'ENSINO MÉDIO'),
(3, 'QUALIFICAÇÃO'),
(1, 'TÉCNICO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `turno` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id`, `nome`, `turno`) VALUES
(1, 'Artc. Eletrônica 18/1', 'Vespertino'),
(2, 'Artc. Eletrônica 17/1', 'Vespertino'),
(3, 'Artc. Informática 17/1', 'Vespertino'),
(4, 'Eletrônica 18/1', 'Noturno'),
(5, 'Eletrônica 17/1', 'Noturno'),
(6, 'Eletrotécnica 18/1', 'Noturno'),
(7, 'Eletrotécnica 17/2', 'Noturno'),
(8, 'Eletrotécnica 17/1', 'Noturno'),
(9, 'Eletrotécnica 16/2', 'Noturno'),
(10, 'Desenvolvimento de Sistemas 18/1', 'Noturno'),
(11, 'Informática 17/1', 'Noturno'),
(12, 'Refrigeração e Climatização 18/1', 'Noturno'),
(13, 'Refrigeração e Climatização 17/1', 'Noturno'),
(14, 'Telecomunicações 18/1', 'Noturno'),
(15, 'EaD - Automação Industrial 17/2', 'Noturno'),
(16, 'EaD - Segurança do Trabalho 18/1', 'Noturno'),
(17, 'CT INF 17/1 V1', 'Verpertino'),
(18, 'CT INF 16/1 V1', 'Verpertino'),
(19, 'CT INF 17/1 N1', 'Noturno'),
(20, 'CT INF 16/1 N1', 'Noturno'),
(21, 'CT TELO 16/1 N1', 'Noturno'),
(22, 'CT TELO 17/1 V1', 'Verpertino'),
(23, 'CT TELO 17/1 N1', 'Noturno'),
(24, 'CT TELT 17/2 N1', 'Noturno'),
(25, 'CT TELT 17/1 N1', 'Noturno'),
(26, 'CT TELT 16/2 N1', 'Noturno'),
(27, 'CT TELT 16/1 N1', 'Noturno'),
(28, 'CT TRCL 17/1 N1', 'Noturno'),
(29, 'CT TRCL 16/1 N1', 'Noturno'),
(30, 'CT AUT IND EaD 17/2 N1', 'Noturno'),
(31, 'Eletrônico 17/2 V1', 'Verpertino'),
(32, 'Suporte e Manutenção 17/1 V1', 'Verpertino'),
(33, 'PRET 17/1 V1', 'Verpertino'),
(34, 'AEMI 17/2 V1', 'Verpertino'),
(35, 'ASSISTENTE ADM. 17/2 M5', 'Matutino'),
(36, 'ASSISTENTE ADM. 17/2 V1', 'Verpertino'),
(37, 'ASSISTENTE ADM. 17/1 V2', 'Verpertino'),
(38, 'ASSISTENTE ADM. 17/1 V4', 'Verpertino'),
(39, 'SMMR 17/1 M1', 'Matutino'),
(40, 'Redes Locais 17/1 M1', 'Matutino'),
(41, 'Logística 17/1 V2', 'Verpertino'),
(42, 'ELETRECISTA PREDIAL 17/2 V1', 'Verpertino'),
(43, 'ELETRECISTA PREDIAL 2017/2 N1', 'Noturno'),
(44, 'DEPENDÊCIA CT-REDES', 'Noturno'),
(45, 'DEPENDÊCIA CT-EDIFICAÇÕES', 'Noturno'),
(46, 'DEPENDÊCIA CT-REFRIGERAÇÃO', 'Noturno'),
(47, 'MARCENEIRO 17/2 V1', 'Verpertino'),
(48, 'ELETRECISTA PREDIAL 17/2 V1', 'Verpertino'),
(49, 'ELETRECISTA PREDIAL 17/2 N1', 'Noturno'),
(50, 'DESENHISTA MECÂNCO 17/1 N1', 'Noturno'),
(51, 'DESENHISTA MECÂNICO QP-DEME 2017/2 N1', 'Noturno'),
(52, 'MECÂNICO REFRIGERAÇÃO QP-MRCR 2017/1 N1', 'Noturno'),
(53, 'MECÂNICO REFRIGERAÇÃO QP-MERE 2017/2 N1', 'Noturno'),
(54, 'MARCENEIRO QP-MARC 2017/2 N1', 'Noturno'),
(55, 'MARCENEIRO QP-MARC 2018/1 N1', 'Noturno'),
(56, 'NR10 17/2 M1', 'Matutino'),
(57, 'COSTURA 17/2 V1', 'Verpertino'),
(58, 'Eletricista de Manutenção 17/2 V1', 'Verpertino'),
(59, 'Eletricista de Instalações Industriais 17/1 M1', 'Matutino'),
(60, 'Telecomunicações 17/1 V1', 'Verpertino'),
(62, 'ENCONTRO INTERATIVO', 'Verpertino'),
(63, 'CONSELHO DE CLASSE', 'Verpertino'),
(64, 'ASSISTENTE ADM. 18/1 V1', 'Verpertino'),
(65, 'TELECOM 18/1 V1', 'Verpertino'),
(66, 'LOGÍSTICA 18/1 V1', 'Verpertino'),
(67, 'ASSISTENTE ADM. 17/2 M1', 'Matutino'),
(68, 'ASSISTENTE ADM. 17/2 M5', 'Matutino'),
(69, 'SUPORTE E MANUTENÇÃO 18/1 M1', 'Matutino'),
(77, 'EM - 1º ANO A', 'Matutino'),
(78, 'EM - 1º ANO B', 'Matutino'),
(79, 'EM - 2º ANO', 'Matutino'),
(80, 'EM - 3º ANO A', 'Matutino'),
(81, 'EM - 3º ANO B', 'Matutino'),
(82, 'QA- DESENHISTA CONSTRUÇÃO CIVIL 2017/2 M1', 'Matutino'),
(84, 'AI LOGÍSTICA 2017/1 V2', 'Vespertino'),
(85, 'EVENTOS', ''),
(86, 'QA-MARCENEIRO 2017/V1', 'Vespertino'),
(87, 'VENDA DE LIVROS - EM', ''),
(89, 'COSTURA 17/2', 'Vespertino'),
(95, 'AI-SMM 2018/V1', 'Vespertino'),
(96, 'T-TELO-2017/V1', 'Vespertino'),
(97, 'Clube EM', 'Verpertino'),
(98, 'Mini Empresa', ''),
(99, 'Vida e Carreira', ''),
(100, 'Nivelamento Inglês', ''),
(101, 'AUTOMAÇÃO EAD', 'Noturno'),
(102, 'AI SMMRL 2018/M1', ''),
(103, 'LOGÍSTICA 18/1 M1', ''),
(104, 'ASSISTENTE ADM. 18/1 M1', ''),
(105, 'EM', ''),
(106, 'Dependência MSI', ''),
(107, 'PREDIAL 18/1', ''),
(108, 'Teste2', ''),
(109, 'Reunião NRSC', ''),
(110, 'MANUTENÇÃO', ''),
(111, 'Dependência Matemática', ''),
(112, 'Dependência História', ''),
(113, 'Dependência Português', ''),
(114, 'Dependência Biologia', ''),
(115, 'Clube Comunicação na Prática', ''),
(116, 'Clube Retrô Tec Games', ''),
(117, 'Clube Teatro', ''),
(118, 'Clube de Inglês', ''),
(119, 'ASSISTENTE ADM. 18/1 - Precicast', ''),
(120, 'Eletricista - CELESC', ''),
(121, 'Suporte e Manutenção 18/01', ''),
(122, 'Assistente ADM. - Intelbras', ''),
(123, 'Mecânico de Refigeração 2018/1 N1', 'Noturno'),
(125, 'Eletroeletronica V8 Brasil 2018/1 N1', 'Noturno'),
(126, 'Marceneiro 2017/2 N1', 'Noturno'),
(128, 'Eletricista Predial', 'Noturno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `login`, `senha`) VALUES
(1, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alterar`
--
ALTER TABLE `alterar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_turmaHorario` (`idTurma`),
  ADD KEY `FK_professorHorario` (`idProfessor`),
  ADD KEY `FK_salaHorario` (`idSala`),
  ADD KEY `FK_tipoHorario` (`idTipo`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_horarioRegistro` (`idHorario`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alterar`
--
ALTER TABLE `alterar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `registro`
--
ALTER TABLE `registro`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `FK_professorHorario` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`id`),
  ADD CONSTRAINT `FK_salaHorario` FOREIGN KEY (`idSala`) REFERENCES `sala` (`id`),
  ADD CONSTRAINT `FK_tipoHorario` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`id`),
  ADD CONSTRAINT `FK_turmaHorario` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`id`);

--
-- Limitadores para a tabela `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `FK_horarioRegistro` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
