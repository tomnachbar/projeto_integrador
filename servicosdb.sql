-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/05/2025 às 23:10
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
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
