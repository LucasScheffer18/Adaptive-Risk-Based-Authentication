-- Criar tabela de usuários
CREATE TABLE Usuario (
    id_usuario UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha TEXT NOT NULL,
    data_criado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela de tentativas de login
CREATE TABLE Tentativa_Login (
    id_tentativa UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    id_usuario UUID REFERENCES Usuario(id_usuario) ON DELETE CASCADE,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip VARCHAR(45),
    dispositivo VARCHAR(255),
    localizacao VARCHAR(255),
    risco DECIMAL(5,2) CHECK (risco >= 0 AND risco <= 1)
);

-- Criar tabela de autenticação adicional
CREATE TABLE Autenticacao_Adicional (
    id_autenticacao UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    id_tentativa UUID REFERENCES Tentativa_Login(id_tentativa) ON DELETE CASCADE,
    tipo VARCHAR(255) NOT NULL,
    validado BOOLEAN DEFAULT FALSE
);

-- Criar tabela de logs de autenticação
CREATE TABLE Log_Autenticacao (
    id_log SERIAL PRIMARY KEY,
    id_usuario UUID REFERENCES Usuario(id_usuario) ON DELETE CASCADE,
    id_tentativa UUID REFERENCES Tentativa_Login(id_tentativa) ON DELETE SET NULL,
    status VARCHAR(50) NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela de configurações de segurança
CREATE TABLE Configuracao_Seguranca (
    id_config SERIAL PRIMARY KEY,
    id_usuario UUID REFERENCES Usuario(id_usuario) ON DELETE CASCADE,
    dois_fatores BOOLEAN DEFAULT FALSE,
    lista_dispositivos JSONB DEFAULT '[]',
    lista_ips JSONB DEFAULT '[]'
);

-- Índices para otimização
CREATE INDEX idx_tentativa_usuario ON Tentativa_Login(id_usuario);
CREATE INDEX idx_log_usuario ON Log_Autenticacao(id_usuario);
CREATE INDEX idx_autenticacao_tentativa ON Autenticacao_Adicional(id_tentativa);
