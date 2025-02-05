# Projeto de Cadastro e Gerenciamento de Tarefas

## Descrição
Esta é uma aplicação simples de cadastro e gerenciamento de tarefas, desenvolvida em PHP com banco de dados MySQL. O frontend utiliza Materialize CSS e jQuery para uma interface responsiva e intuitiva.

## Tecnologias Utilizadas
- **Backend:** PHP (Medoo para interação com MySQL)
- **Banco de Dados:** MySQL
- **Frontend:** HTML, CSS (Materialize), JavaScript (jQuery)

## Estrutura do Projeto
```
/
├── css/               # Estilos personalizados
├── js/                # Scripts JavaScript (tarefas.js)
├── sql/               # Script do banco de dados (banco.sql)
├── src/               # Código PHP (config.php, tarefa.php, colaborador.php)
├── vendor/            # Dependências do Composer
├── composer.json      # Configuração do Composer
├── composer.lock      # Lockfile do Composer
└── index.html         # Interface principal
```

## Configuração do Ambiente

### 1. Clonar o Repositório
```bash
git clone https://gitlab.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### 2. Instalar Dependências do PHP
Certifique-se de ter o **Composer** instalado:
```bash
composer install
```

### 3. Configuração do Banco de Dados

#### Importar o Banco de Dados
1. Abra o MySQL Workbench.
2. Clique em **Server > Data Import**.
3. Selecione o arquivo `sql/banco.sql` do projeto.
4. Importe para um novo schema (por exemplo, `tarefas_db`).

#### Configurar a Conexão no `config.php`
No arquivo `src/config.php`, ajuste as credenciais do banco:
```php
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'tarefas_db', // Nome do banco importado
    'server' => 'localhost',
    'username' => 'seu_usuario',
    'password' => 'sua_senha'
]);
```

### 4. Executar o Projeto
Basta abrir o arquivo `index.html` em um navegador ou rodar um servidor local:
```bash
php -S localhost:8000
```
Acesse via [http://localhost:8000](http://localhost:8000).

## Funcionalidades
- Cadastro de novas tarefas
- Listagem de tarefas
- Edição de tarefas existentes
- Exclusão de tarefas

## Possíveis Erros e Soluções
- **Erro de conexão com o banco:** Verifique as credenciais em `config.php`.
- **Problemas com Materialize:** Confirme se os links do CDN estão ativos.

## Autor
Desenvolvido por [Seu Nome].

