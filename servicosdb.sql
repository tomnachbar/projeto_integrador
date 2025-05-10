-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/05/2025 às 00:26
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
(1, 1, 1, '2025-05-06', '2025-05-06', 2, 'Atraso no corte.', '2025-05-06 20:58:43'),
(2, 2, 2, '2025-05-07', '2025-05-07', 5, 'Excelente massagem!', '2025-05-07 14:22:00'),
(3, 3, 3, '2025-05-08', '2025-05-08', 4, 'Serviço rápido.', '2025-05-08 10:15:30'),
(4, 4, 4, '2025-05-09', '2025-05-09', 3, 'Poderia ter mais capricho.', '2025-05-09 11:00:00'),
(5, 5, 5, '2025-05-10', '2025-05-10', 5, 'Deixou tudo brilhando.', '2025-05-10 13:45:00'),
(6, 6, 6, '2025-05-11', '2025-05-11', 4, 'Resolveu meu problema.', '2025-05-11 16:30:00'),
(7, 7, 7, '2025-05-12', '2025-05-12', 5, 'Atendimento excelente.', '2025-05-12 15:00:00'),
(8, 8, 8, '2025-05-13', '2025-05-13', 4, 'Muito cuidadoso com os detalhes.', '2025-05-13 10:00:00'),
(9, 9, 9, '2025-05-14', '2025-05-14', 5, 'Adorei os produtos.', '2025-05-14 12:00:00'),
(10, 10, 10, '2025-05-15', '2025-05-15', 5, 'Bolo maravilhoso!', '2025-05-15 14:00:00');

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
(1, 'Barbearia Elite', 'Barbearia', 'Especializada em cortes masculinos modernos.', '11977777777', 'elite@barbearia.com', 'Seg a Sáb - 9h às 18h', 'Indicação do João', 'senha345'),
(2, 'Estética Top', 'Massagem e Estética', 'Tratamentos relaxantes e estéticos.', '21966666666', 'top@estetica.com', 'Seg a Sex - 10h às 17h', 'Cliente Maria', 'senha456'),
(3, 'Eletricista Silva', 'Serviços Elétricos', 'Instalações e manutenções elétricas.', '31955555555', 'silva@eletrica.com', 'Todos os dias - 8h às 20h', 'Carlos recomenda', 'senha789'),
(4, 'Reformas Express', 'Reforma em Geral', 'Reformas rápidas e com qualidade.', '41944444444', 'express@reformas.com', 'Seg a Sáb - 9h às 18h', 'Ana indica', 'senha123'),
(5, 'Limpeza Rápida', 'Limpeza', 'Faxinas completas e por agendamento.', '51933333333', 'rapida@limpeza.com', 'Seg a Dom - 7h às 19h', 'Indicação da Fernanda', 'senha159'),
(6, 'InfoTech', 'Técnico de Informática', 'Suporte técnico e conserto de computadores.', '61922222222', 'suporte@infotech.com', 'Seg a Sáb - 8h às 18h', 'Lucas recomenda', 'senha753'),
(7, 'Unhas da Paula', 'Manicure e Pedicure', 'Manicure profissional e design de unhas.', '71911111111', 'paula@unhas.com', 'Seg a Sex - 9h às 17h', 'Paula Souza indica', 'senha852'),
(8, 'Pinturas Premium', 'Serviços de Pintura', 'Pinturas residenciais e comerciais.', '81900000000', 'premium@pinturas.com', 'Seg a Sáb - 8h às 17h', 'Renato indica', 'senha369'),
(9, 'Vida Natural', 'Produtos Naturais / Fitoterápicos', 'Produtos naturais e saudáveis.', '91999999999', 'natural@vida.com', 'Todos os dias - 9h às 20h', 'Juliana recomenda', 'senha951'),
(10, 'Delícias da Vó', 'Doces e Bolos', 'Bolos caseiros e sobremesas.', '11988888888', 'bolo@delicias.com', 'Seg a Sáb - 8h às 18h', 'Bruno recomenda', 'senha357');

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
(1, 1, 'Barbearia Elite', 'Corte Masculino', 30.00, 'Barbearia'),
(2, 1, 'Barbearia Elite', 'Sobrancelha', 20.00, 'Barbearia'),
(3, 2, 'Estética Top', 'Massagem Relaxante', 80.00, 'Massagem e Estética'),
(4, 3, 'Eletricista Silva', 'Troca de Fiação', 150.00, 'Serviços Elétricos'),
(5, 4, 'Reformas Express', 'Pintura Completa', 1200.00, 'Reforma em Geral'),
(6, 5, 'Limpeza Rápida', 'Faxina Residencial', 100.00, 'Limpeza'),
(7, 6, 'InfoTech', 'Formatação de PC', 90.00, 'Técnico de Informática'),
(8, 7, 'Unhas da Paula', 'Manicure e Pedicure', 50.00, 'Manicure e Pedicure'),
(9, 8, 'Pinturas Premium', 'Pintura Interna', 800.00, 'Serviços de Pintura'),
(10, 9, 'Vida Natural', 'Kit Fitoterápico', 75.00, 'Produtos Naturais / Fitoterápicos');

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
(1, 'João da Silva', 'senha789', 'joao@email.com', '11999999999', 'Masculino', '1990-05-10', 'São Paulo', 'SP', 'Rua Exemplo, 123', 'Barbearia'),
(2, 'Maria Oliveira', 'senha123', 'maria@email.com', '21988888888', 'Feminino', '1985-08-15', 'Rio de Janeiro', 'RJ', 'Av. das Flores, 456', 'Massagem e Estética'),
(3, 'Carlos Pereira', 'senha456', 'carlos@email.com', '31977777777', 'Masculino', '1978-12-20', 'Belo Horizonte', 'MG', 'Rua A, 789', 'Serviços Elétricos'),
(4, 'Ana Souza', 'senha321', 'ana@email.com', '41966666666', 'Feminino', '1992-03-08', 'Curitiba', 'PR', 'Rua B, 101', 'Reforma em Geral'),
(5, 'Fernanda Lima', 'senha147', 'fernanda@email.com', '51955555555', 'Feminino', '1989-07-11', 'Porto Alegre', 'RS', 'Rua C, 202', 'Limpeza'),
(6, 'Lucas Rocha', 'senha258', 'lucas@email.com', '61944444444', 'Masculino', '1995-11-05', 'Brasília', 'DF', 'Rua D, 303', 'Técnico de Informática'),
(7, 'Paula Silva', 'senha369', 'paula@email.com', '71933333333', 'Feminino', '1987-01-25', 'Salvador', 'BA', 'Rua E, 404', 'Manicure e Pedicure'),
(8, 'Renato Alves', 'senha741', 'renato@email.com', '81922222222', 'Masculino', '1980-06-30', 'Recife', 'PE', 'Rua F, 505', 'Serviços de Pintura'),
(9, 'Juliana Mendes', 'senha852', 'juliana@email.com', '91911111111', 'Feminino', '1993-09-19', 'Belém', 'PA', 'Rua G, 606', 'Produtos Naturais / Fitoterápicos'),
(10, 'Bruno Costa', 'senha963', 'bruno@email.com', '11900000000', 'Masculino', '1991-10-13', 'São Paulo', 'SP', 'Rua H, 707', 'Doces e Bolos');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `prestadores`
--
ALTER TABLE `prestadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `produto_servico`
--
ALTER TABLE `produto_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
