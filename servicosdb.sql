-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/05/2025 às 20:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `servicosdbold`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_servico`
--

CREATE TABLE `produto_servico` (
  `id` int(11) NOT NULL,
  `prestador_id` int(11) NOT NULL,
  `nome_prestador` varchar(255) NOT NULL,
  `nome_produto_servico` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tipo_servico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto_servico`
--

INSERT INTO `produto_servico` (`id`, `prestador_id`, `nome_prestador`, `nome_produto_servico`, `valor`, `tipo_servico`) VALUES
(2, 1, 'Barbearia Elite', 'Pezinho', 15.00, NULL),
(3, 1, 'Prestador A', 'Corte de cabelo', 50.00, NULL),
(4, 1, 'Barbearia Elite', 'Corte de Cabelo Masculino', 60.00, NULL),
(5, 1, 'Barbearia Elite', 'Sobrancelha', 20.00, 'Corte de Cabelo'),
(6, 13, 'Claudio Serviços Gerais', 'Reparo de Chuveiro', 50.00, 'Pequenos Reparos (Marido de Aluguel)'),
(7, 12, 'Doceria Indaiatuba', 'Bolo de Brigadeiro (KG)', 45.00, 'Produto C');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produto_servico`
--
ALTER TABLE `produto_servico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestador_id` (`prestador_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produto_servico`
--
ALTER TABLE `produto_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produto_servico`
--
ALTER TABLE `produto_servico`
  ADD CONSTRAINT `produto_servico_ibfk_1` FOREIGN KEY (`prestador_id`) REFERENCES `prestadores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
