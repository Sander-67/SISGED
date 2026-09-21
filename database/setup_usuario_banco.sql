-- use estas credenciais no .env do projeto:
--   DB_DATABASE=sisged
--   DB_USERNAME=sisged_dev
--   DB_PASSWORD=RBNtech1512

-- 1. Cria o usuário de aplicação (o que o Laravel vai usar no .env)
CREATE USER IF NOT EXISTS 'sisged_dev'@'localhost'
    IDENTIFIED BY 'RBNtech1512';
    
-- 2. Dá permissão SOMENTE ao grupo "Dados" (CRUD), dentro do banco
--    "sisged". Sem CREATE, ALTER, INDEX ou DROP — ou seja, não
--    consegue mexer na estrutura das tabelas, só nos dados dentro
--    delas.
GRANT SELECT, INSERT, UPDATE, DELETE ON sisged.* TO 'sisged_dev'@'localhost';

-- 3. Troca a senha do root local para a nova senha combinada
ALTER USER 'root'@'localhost' IDENTIFIED BY 'TechRBN026';

-- 4. Aplica todas as permissões e a nova senha
FLUSH PRIVILEGES;
