CREATE TABLE `alterar` (
  `id` int(11) NOT NULL,
  `alteracao` varchar(255) NOT NULL,
  `tema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--

INSERT INTO `alterar` (`id`, `alteracao`) VALUES
(1, 'f429391e858a3c038d93ba75ecd3bb4f');

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

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--

CREATE TABLE `registro` (
  `id` bigint(20) NOT NULL,
  `idHorario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `turno` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--

INSERT INTO `usuario` (`id`, `nome`, `login`, `senha`) VALUES
(1, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--

ALTER TABLE `alterar`
  ADD PRIMARY KEY (`id`);

--

ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_turmaHorario` (`idTurma`),
  ADD KEY `FK_professorHorario` (`idProfessor`),
  ADD KEY `FK_salaHorario` (`idSala`),
  ADD KEY `FK_tipoHorario` (`idTipo`);

--

ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--

ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_horarioRegistro` (`idHorario`);

--

ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--

ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--

ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);

--

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--

ALTER TABLE `alterar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--

ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--

ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--

ALTER TABLE `registro`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--

ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--

ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--

ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--

ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--

ALTER TABLE `horario`
  ADD CONSTRAINT `FK_professorHorario` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`id`),
  ADD CONSTRAINT `FK_salaHorario` FOREIGN KEY (`idSala`) REFERENCES `sala` (`id`),
  ADD CONSTRAINT `FK_tipoHorario` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`id`),
  ADD CONSTRAINT `FK_turmaHorario` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`id`);

--

ALTER TABLE `registro`
  ADD CONSTRAINT `FK_horarioRegistro` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`id`);
COMMIT;