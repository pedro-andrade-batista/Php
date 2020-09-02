SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

create database pw2;
use pw2;
--
-- Database: `pw2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `departamento`
--

INSERT INTO `departamento` (`id`, `nome`) VALUES
(1, 'RH'),
(2, 'TI'),
(3, 'PJ'),
(4, 'PF');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `idFuncionario` int(11) NOT NULL,
  `nome` varchar(512) DEFAULT NULL,
  `salario` double DEFAULT NULL,
  `login` varchar(512) DEFAULT NULL,
  `senha` varchar(512) DEFAULT NULL,
  `idPermissao` int(11) DEFAULT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `nome`, `salario`, `login`, `senha`, `idPermissao`, `idDepartamento`, `ativo`) VALUES
(12, 'root', NULL, 'root', '63a9f0ea7bb98050796b649e85481845', 1, NULL, 1),
(13, 'senha e login:ramos', 123456789, 'ramos', 'db3b992995b36a9d2ac616ea2867b14a', 2, 2, 1),
(14, 'Rodrigo Ramos', 123123, 'Rodrigo', '202cb962ac59075b964b07152d234b70', 1, 1, 1),
(15, 'Rodrigo H Ramos', 4646545, 'ramos2', 'db3b992995b36a9d2ac616ea2867b14a', 1, 1, 1);

select * from departamento;
-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE `permissao` (
  `id` int(11) NOT NULL,
  `tipo` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id`, `tipo`) VALUES
(1, 'root'),
(2, 'funcionario');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idFuncionario`),
  ADD KEY `depFK` (`idDepartamento`),
  ADD KEY `depPermissao` (`idPermissao`);

--
-- Indexes for table `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `depFK` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`id`),
  ADD CONSTRAINT `depPermissao` FOREIGN KEY (`idPermissao`) REFERENCES `permissao` (`id`);
COMMIT;

desc funcionario;
desc departamento;
desc permissao;

-- select nome from departamento where id = 2;

select p.tipo 
	from permissao p join funcionario f
    on f.idPermissao = p.id
    where p.id = 2;

select * from funcionario;
select * from departamento;
select * from permissao;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;