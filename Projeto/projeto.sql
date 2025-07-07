-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/07/2025 às 02:16
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
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `autenticacao_adicional`
--

CREATE TABLE `autenticacao_adicional` (
  `id_autenticacao` char(36) NOT NULL,
  `id_tentativa` int(11) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `validado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autenticacao_adicional`
--

INSERT INTO `autenticacao_adicional` (`id_autenticacao`, `id_tentativa`, `tipo`, `validado`) VALUES
('686abcdb77c61', 31, 'otp', 0),
('686abcdf5e5ed', 31, 'otp', 1),
('686ac275718bf', 32, 'otp', 0),
('686ac27a64455', 32, 'otp', 1),
('686ac4a9975f8', 33, 'otp', 0),
('686ac4acded65', 33, 'otp', 1),
('686acb1316e86', 34, 'otp', 0),
('686acb1763409', 34, 'otp', 1),
('686af5cb3d133', 35, 'otp', 0),
('686af5d885cf1', 35, 'otp', 1),
('686b0535bbdd2', 36, 'otp', 0),
('686b053853b2b', 36, 'otp', 1),
('686b102747e32', 39, 'otp', 0),
('686b102e5428b', 39, 'otp', 0),
('686b103e03e41', 39, 'otp', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_autenticacao`
--

CREATE TABLE `log_autenticacao` (
  `id_log` int(11) NOT NULL,
  `id_usuario` char(36) DEFAULT NULL,
  `id_tentativa` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `log_autenticacao`
--

INSERT INTO `log_autenticacao` (`id_log`, `id_usuario`, `id_tentativa`, `status`, `data_hora`) VALUES
(23, '686ab99aeb52e', 31, 'sucesso', '2025-07-06 18:13:51'),
(24, '686ab99aeb52e', 32, 'sucesso', '2025-07-06 18:37:46'),
(25, '686ab99aeb52e', 33, 'sucesso', '2025-07-06 18:47:08'),
(26, '686ab99aeb52e', 34, 'sucesso', '2025-07-06 19:14:31'),
(27, '686ab99aeb52e', 35, 'sucesso', '2025-07-06 22:16:56'),
(28, '686ab99aeb52e', 36, 'sucesso', '2025-07-06 23:22:32'),
(29, '686b0ffaaf7bf', 39, 'sucesso', '2025-07-07 00:09:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tentativa_login`
--

CREATE TABLE `tentativa_login` (
  `id_tentativa` int(11) NOT NULL,
  `id_usuario` char(36) DEFAULT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(45) DEFAULT NULL,
  `dispositivo` varchar(255) DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `risco` decimal(5,2) DEFAULT NULL CHECK (`risco` >= 0 and `risco` <= 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tentativa_login`
--

INSERT INTO `tentativa_login` (`id_tentativa`, `id_usuario`, `data_hora`, `ip`, `dispositivo`, `localizacao`, `risco`) VALUES
(30, '686ab99aeb52e', '2025-07-06 18:13:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'Desconhecida', 0.50),
(31, '686ab99aeb52e', '2025-07-06 18:13:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb...', 'Desconhecida', 0.50),
(32, '686ab99aeb52e', '2025-07-06 18:37:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'Desconhecida', 0.50),
(33, '686ab99aeb52e', '2025-07-06 18:47:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'Desconhecida', 0.50),
(34, '686ab99aeb52e', '2025-07-06 19:14:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'Desconhecida', 0.50),
(35, '686ab99aeb52e', '2025-07-06 22:16:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'Desconhecida', 0.50),
(36, '686ab99aeb52e', '2025-07-06 23:22:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'Desconhecida', 0.80),
(38, '686b0ffaaf7bf', '2025-07-07 00:08:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'Desconhecida', 0.70),
(39, '686b0ffaaf7bf', '2025-07-07 00:09:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'Desconhecida', 0.70);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` char(36) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` text NOT NULL,
  `data_criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `otp` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `data_criado`, `otp`) VALUES
('686ab99aeb52e', 'Lucas', 'lucas@gmail.com', '$2y$10$PZtpeF5AwM2QfH5FLFFEE.2KAEYpiRq4jkrYEUCBxEnshEBUlSlzW', '2025-07-06 17:59:54', '8573'),
('686b0ffaaf7bf', 'Joao', 'joao@gmail.com', '$2y$10$FYpQplGLb0umesNSdDifJO.Mg72aRh0fJcjIOubslriN9dsKLyCEC', '2025-07-07 00:08:26', '2324');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `autenticacao_adicional`
--
ALTER TABLE `autenticacao_adicional`
  ADD PRIMARY KEY (`id_autenticacao`),
  ADD KEY `idx_autenticacao_tentativa` (`id_tentativa`);

--
-- Índices de tabela `log_autenticacao`
--
ALTER TABLE `log_autenticacao`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_tentativa` (`id_tentativa`),
  ADD KEY `idx_log_usuario` (`id_usuario`);

--
-- Índices de tabela `tentativa_login`
--
ALTER TABLE `tentativa_login`
  ADD PRIMARY KEY (`id_tentativa`),
  ADD KEY `idx_tentativa_usuario` (`id_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `log_autenticacao`
--
ALTER TABLE `log_autenticacao`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `tentativa_login`
--
ALTER TABLE `tentativa_login`
  MODIFY `id_tentativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `autenticacao_adicional`
--
ALTER TABLE `autenticacao_adicional`
  ADD CONSTRAINT `autenticacao_adicional_ibfk_1` FOREIGN KEY (`id_tentativa`) REFERENCES `tentativa_login` (`id_tentativa`) ON DELETE CASCADE;

--
-- Restrições para tabelas `log_autenticacao`
--
ALTER TABLE `log_autenticacao`
  ADD CONSTRAINT `log_autenticacao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_autenticacao_ibfk_2` FOREIGN KEY (`id_tentativa`) REFERENCES `tentativa_login` (`id_tentativa`) ON DELETE SET NULL;

--
-- Restrições para tabelas `tentativa_login`
--
ALTER TABLE `tentativa_login`
  ADD CONSTRAINT `tentativa_login_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
