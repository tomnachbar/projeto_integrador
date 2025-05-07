-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/05/2025 às 02:37
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
-- Banco de dados: `servicosdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `prestador_id` int(11) NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `nota` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `data_avaliacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `usuario_id`, `prestador_id`, `data_inicio`, `data_fim`, `nota`, `comentario`, `data_avaliacao`) VALUES
(1, 2, 1, '2025-05-05', '2025-05-05', 5, '', '2025-05-06 11:02:07'),
(2, 2, 1, '2025-05-06', '2025-05-06', 2, 'Atraso no corte.', '2025-05-06 20:58:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `prestadores`
--

CREATE TABLE `prestadores` (
  `id` int(11) NOT NULL,
  `nome_razao_social` varchar(100) DEFAULT NULL,
  `tipo_servico` varchar(50) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `disponibilidade` varchar(100) DEFAULT NULL,
  `referencias` text DEFAULT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `prestadores`
--

INSERT INTO `prestadores` (`id`, `nome_razao_social`, `tipo_servico`, `descricao`, `telefone`, `email`, `disponibilidade`, `referencias`, `senha`) VALUES
(1, 'Barbearia Elite', 'Corte de Cabelo', 'Especializada em cortes masculinos modernos.', '11977777777', 'elite@barbearia.com', 'Seg a Sáb - 9h às 18h', 'Indicação do João', 'senha123'),
(2, 'Relax Spa', 'Serviços Elétricos', 'Massagem relaxante com óleos essenciais e velas', '21966666666', 'spa@relax.com', 'Seg a Sex - 10h às 17h', '5 estrelas no Google', 'senha123'),
(8, 'Cabelereira Marcia', 'Serviço A', 'Cortes de cabelo feminino, químicas em geral', NULL, 'marcia@hotmail.com', 'Segunda-feira, Quarta-feira, Sexta-feira', 'Instagram: Marcia Cabeleireira', 'senha123'),
(9, 'Julio Serviços Eletricos', 'Serviço A', 'Reparos e Instalacoes Eletricas Residencial.', '11975001200', 'julio@servicos.com', 'Segunda-feira, Terça-feira, Quarta-feira, Quinta-feira, Sexta-feira', 'site: julioservicoseletricos.com.br', 'senha123'),
(10, 'Joao Barbeiro', 'Serviço A', 'Corte de cabelo masculino ou infantil a domicilio', '119752000000', 'joao@barbearia.com', 'Sexta-feira, Sábado', 'Instagram: Joao Barbeiro', 'senha123'),
(11, 'Jose Silva', '', '', '11970250000', 'josesilva@gmail.com', '', '', 'senha123'),
(12, 'Doceria Indaiatuba', 'Doces e Bolos', 'Doces e Bolos sob encomenda', '1198000000', 'doceria_indaiatuba@gmail.com', 'Sexta-feira, Sábado, Domingo | 08h às 12h, 13h às 18h', 'Doceria Indaiatuba', 'senha123'),
(13, 'Claudio Serviços Gerais', 'Pequenos Reparos (Marido de Aluguel)', 'Pequenos reparos domesticos', '11978000000', 'claudio_servicos@hotmail.com', 'Segunda-feira, Terça-feira, Quarta-feira, Quinta-feira | 08h às 12h, 13h às 18h', 'Avaliacoes', 'senha123');

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome_completo` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `interesse` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_completo`, `senha`, `email`, `telefone`, `sexo`, `data_nascimento`, `cidade`, `estado`, `endereco`, `interesse`) VALUES
(1, 'João da Silva\r\n', 'senha789', 'joao@email.com', '11999999999', 'Masculino', '1990-05-10', 'São Paulo', 'SP', 'Rua Exemplo, 123\r\n', 'Barbearia'),
(2, 'Eliton Nachbar', 'senha123', 'nachbars@msn.com', '11975144138', 'masculino', '1989-08-31', 'Jundiai', 'SP', 'Rua Teste 123', ''),
(3, 'Flavio Medeiros', 'senha123', 'flavio@email.com', '1197000000', 'masculino', '1980-07-10', 'Indaiatuba', 'SP', 'Rua Exemplo 123', ''),
(4, 'Confeitaria Paraiso', 'senha123', 'confeitaria@paraiso.com', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(5, 'Cabelereira Marcia', 'senha123', 'marcia@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(6, 'Julio Serviços Eletricos', 'senha123', 'julio@servicos.com', '11975001200', NULL, NULL, NULL, NULL, NULL, ''),
(7, 'Joao Barbeiro', 'senha123', 'joao@barbearia.com', '119752000000', '', '0000-00-00', '', '', '', ''),
(8, 'Jose Silva', 'senha123', 'josesilva@gmail.com', '11970250000', 'masculino', '1970-05-10', 'Itu', 'SP', 'Rua das Arvores, 150', ''),
(9, 'Maria das Dores', 'senha345', 'mariadores@gmail.com', '11978000000', 'feminino', '1955-09-05', 'Salto', 'SP', 'Rua das Flores, 200', 'Doceria');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `prestador_id` (`prestador_id`);

--
-- Índices de tabela `prestadores`
--
ALTER TABLE `prestadores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produto_servico`
--
ALTER TABLE `produto_servico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestador_id` (`prestador_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `prestadores`
--
ALTER TABLE `prestadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `produto_servico`
--
ALTER TABLE `produto_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`prestador_id`) REFERENCES `prestadores` (`id`);

--
-- Restrições para tabelas `produto_servico`
--
ALTER TABLE `produto_servico`
  ADD CONSTRAINT `produto_servico_ibfk_1` FOREIGN KEY (`prestador_id`) REFERENCES `prestadores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
