# 👥 Sistema de Cadastro de Amigos da Gabi

> Sistema Web **CRUD de amigos** com **autenticação de usuários**, desenvolvido como projeto da disciplina de **Desenvolvimento de Sistemas II**.

<p align="center">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5">
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3">
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-00758F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/XAMPP-FB7A24?style=for-the-badge&logo=xampp&logoColor=white" alt="XAMPP">
</p>

---

## 📖 Sumário

- [Sobre o projeto](#-sobre-o-projeto)
- [Funcionalidades](#-funcionalidades)
- [Tecnologias utilizadas](#-tecnologias-utilizadas)
- [Estrutura de pastas](#-estrutura-de-pastas)
- [Banco de dados](#-banco-de-dados)
- [Como instalar e executar](#-como-instalar-e-executar)
- [Credenciais de teste](#-credenciais-de-teste)
- [Como o login funciona](#-como-o-login-funciona)
- [Como o CRUD funciona](#-como-o-crud-funciona)
- [Segurança implementada](#-segurança-implementada)
- [Demonstração](#-demonstração)
- [Autor](#-autor)
- [Licença](#-licença)

---

## 🎯 Sobre o projeto

O **Sistema de Cadastro de Amigos da Gabi** é uma aplicação Web que permite a um usuário autenticado gerenciar sua lista pessoal de amigos de forma segura e organizada. O sistema substitui cadernos e planilhas por uma solução centralizada em banco de dados, com acesso protegido por login.

O projeto foi desenvolvido como atividade prática da disciplina de **Desenvolvimento de Sistemas II**, com o objetivo de aplicar, de forma integrada, os conceitos de:

- **HTML5** semântico para estruturação das páginas;
- **CSS3** para estilização e responsividade;
- **JavaScript** para validação no cliente e melhoria da experiência;
- **PHP** para o back-end, sessões e regras de negócio;
- **MySQL** para persistência dos dados;
- **SQL** para manipulação das tabelas e registros.

> ⚠️ **Sem frameworks.** O projeto foi construído propositalmente sem Laravel, Bootstrap ou similares, para evidenciar o domínio dos fundamentos de PHP, SQL e do protocolo HTTP.

---

## ✨ Funcionalidades

- ✅ **Cadastro de usuário** (via script SQL inicial)
- ✅ **Login** com e-mail e senha
- ✅ **Logout** com encerramento correto da sessão
- ✅ **Proteção de páginas internas** (redireciona se não autenticado)
- ✅ **Dashboard** com total de amigos cadastrados
- ✅ **CREATE** — Cadastrar novo amigo
- ✅ **READ** — Listar todos os amigos
- ✅ **READ** — Buscar por nome, sobrenome ou e-mail
- ✅ **UPDATE** — Editar dados de um amigo
- ✅ **DELETE** — Excluir amigo com dupla confirmação
- ✅ **Validação** de formulários no cliente (JS) e no servidor (PHP)
- ✅ **Layout responsivo** adaptado para desktop

---

## 🛠 Tecnologias utilizadas

| Tecnologia | Uso no projeto |
|------------|----------------|
| **HTML5** | Estrutura semântica das páginas |
| **CSS3** | Estilização, layout e responsividade |
| **JavaScript** | Validação de formulários no cliente e confirmação de exclusão |
| **PHP 7+** | Back-end, sessões, regras de negócio e acesso ao banco |
| **MySQL** | Banco de dados relacional |
| **SQL** | Comandos `INSERT`, `SELECT`, `UPDATE`, `DELETE` |
| **PDO** | Camada de acesso a dados com prepared statements |
| **XAMPP** | Ambiente de desenvolvimento local (Apache + MySQL + PHP) |

---

## 📁 Estrutura de pastas

```
cadastro-amigos/
│
├── index.php                    # Redireciona para login ou dashboard
├── login.php                    # Tela e lógica de login
├── logout.php                   # Encerra a sessão
├── dashboard.php                # Painel inicial (área protegida)
│
├── amigos/
│   ├── listar.php               # READ  — lista todos os amigos
│   ├── cadastrar.php            # CREATE — cadastra novo amigo
│   ├── editar.php               # UPDATE — edita amigo existente
│   └── excluir.php              # DELETE — exclui amigo com confirmação
│
├── config/
│   └── conexao.php              # Conexão PDO com o MySQL
│
├── includes/
│   ├── auth.php                 # Controle de sessão e proteção
│   ├── header.php               # Cabeçalho comum
│   └── footer.php               # Rodapé comum
│
├── css/
│   └── style.css                # Estilos do sistema
│
├── js/
│   └── script.js                # Validações e confirmações
│
└── database/
    └── banco.sql                # Script completo de criação do banco
```

---

## 🗄 Banco de dados

**Nome do banco:** `cadastro_amigos`  
**Codificação:** `utf8mb4` / `utf8mb4_unicode_ci`  
**Engine:** InnoDB

### Tabela `usuarios`

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `id` | INT (PK, AUTO_INCREMENT) | Identificador único |
| `nome` | VARCHAR(100) | Nome do usuário |
| `email` | VARCHAR(150) UNIQUE | Login do usuário |
| `senha` | VARCHAR(255) | Hash bcrypt da senha |
| `criado_em` | TIMESTAMP | Data de criação automática |

### Tabela `amigos`

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `id` | INT (PK, AUTO_INCREMENT) | Identificador único |
| `nome` | VARCHAR(100) | Nome do amigo |
| `sobrenome` | VARCHAR(100) | Sobrenome do amigo |
| `email` | VARCHAR(150) | E-mail de contato |
| `telefone` | VARCHAR(20) | Telefone (opcional) |
| `data_nascimento` | DATE | Data de nascimento (opcional) |
| `cidade` | VARCHAR(100) | Cidade (opcional) |
| `observacoes` | TEXT | Anotações livres |
| `data_cadastro` | TIMESTAMP | Data de cadastro automática |

> 💡 **Não há chave estrangeira** entre as tabelas — a lista de amigos é única no sistema.

---

## 🚀 Como instalar e executar

### Pré-requisitos

- [XAMPP](https://www.apachefriends.org/pt_br/index.html) instalado (ou pacote equivalente com Apache + MySQL + PHP)
- Navegador moderno (Chrome, Firefox, Edge)
- Editor de código (VS Code recomendado)

### Passo a passo

#### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/cadastro-amigos.git
```

Ou baixe o `.zip` e extraia.

#### 2. Mova para a pasta do XAMPP

- **Windows:** `C:\xampp\htdocs\cadastro-amigos`
- **Linux:** `/opt/lampp/htdocs/cadastro-amigos`
- **macOS:** `/Applications/XAMPP/xamppfiles/htdocs/cadastro-amigos`

#### 3. Inicie o XAMPP

Abra o **XAMPP Control Panel** e clique em **Start** em:

- ✅ **Apache**
- ✅ **MySQL**

#### 4. Importe o banco de dados

1. Acesse: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Clique na aba **Importar**
3. Selecione o arquivo `database/banco.sql`
4. Clique em **Executar**

> O script cria automaticamente o banco `cadastro_amigos`, as tabelas `usuarios` e `amigos`, o usuário de teste e três amigos de exemplo.

#### 5. Acesse o sistema

No navegador:

```
http://localhost/cadastro-amigos/
```

#### 6. Faça login

Use as credenciais de teste (veja abaixo).

---

## 🔑 Credenciais de teste

| Campo | Valor |
|-------|-------|
| **E-mail** | `admin@gabi.com` |
| **Senha** | `123456` |

> Se o login não funcionar de primeira, gere o hash correto executando o script `gerar_hash.php` (veja a seção [Como o login funciona](#-como-o-login-funciona)) e atualize no phpMyAdmin.

---

## 🔐 Como o login funciona

1. O usuário informa **e-mail** e **senha** em `login.php`.
2. O PHP valida os campos (não vazios, e-mail em formato válido).
3. Uma **consulta preparada** busca o usuário pelo e-mail:
   ```sql
   SELECT id, nome, senha FROM usuarios WHERE email = :email LIMIT 1
   ```
4. Se o usuário existir, o PHP chama:
   ```php
   password_verify($senhaDigitada, $usuario['senha'])
   ```
5. Se a senha estiver correta, o sistema cria a **sessão**:
   ```php
   $_SESSION['usuario_id'] = $usuario['id'];
   $_SESSION['usuario_nome'] = $usuario['nome'];
   ```
6. Redireciona para `dashboard.php`.
7. **Toda página interna** começa com:
   ```php
   require_once '../includes/auth.php';
   verificarLogin();
   ```
   Se a sessão não existir, redireciona para o login.
8. O **logout** limpa `$_SESSION`, destrói o cookie e a sessão.

### Gerando o hash correto da senha

Como `password_hash()` gera um valor diferente a cada execução, use este script temporário:

```php
<?php
// gerar_hash.php — apague depois de usar
echo password_hash('123456', PASSWORD_DEFAULT);
```

Copie o hash gerado e atualize no phpMyAdmin:

```sql
UPDATE usuarios SET senha = 'COLE_O_HASH_AQUI' WHERE email = 'admin@gabi.com';
```

---

## 🔄 Como o CRUD funciona

### 🟢 CREATE — Cadastrar amigo

- **Arquivo:** `amigos/cadastrar.php`
- **SQL:**
  ```sql
  INSERT INTO amigos (nome, sobrenome, email, telefone,
                      data_nascimento, cidade, observacoes)
  VALUES (:nome, :sobrenome, :email, :telefone,
          :nascimento, :cidade, :obs)
  ```
- **Fluxo:** formulário → validação JS → validação PHP → `prepare()` + `execute()` → mensagem de sucesso.

### 🔵 READ — Listar amigos

- **Arquivo:** `amigos/listar.php`
- **SQL:**
  ```sql
  SELECT * FROM amigos ORDER BY nome
  ```
- **Com busca:**
  ```sql
  SELECT * FROM amigos
  WHERE nome LIKE :b OR sobrenome LIKE :b OR email LIKE :b
  ORDER BY nome
  ```
- **Fluxo:** consulta → `fetchAll()` → `foreach` → tabela HTML com botões **Editar** e **Excluir**.

### 🟡 UPDATE — Editar amigo

- **Arquivo:** `amigos/editar.php?id=X`
- **SQL:**
  ```sql
  UPDATE amigos SET nome = :nome, ..., observacoes = :obs
  WHERE id = :id
  ```
- **Fluxo:** carrega registro → preenche formulário → `POST` → validação → `UPDATE` → mensagem.

### 🔴 DELETE — Excluir amigo

- **Arquivo:** `amigos/excluir.php?id=X`
- **SQL:**
  ```sql
  DELETE FROM amigos WHERE id = :id
  ```
- **Fluxo:** confirmação via JavaScript → tela de confirmação em PHP → `DELETE` → redireciona para lista.

---

## 🛡 Segurança implementada

| Mecanismo | Onde é usado |
|-----------|--------------|
| **Sessões PHP** | Autenticação e proteção das páginas internas |
| **`password_verify()`** | Ao validar o login |
| **PDO + prepared statements** | Todas as consultas SQL |
| **`filter_var()` + `FILTER_VALIDATE_EMAIL`** | Validação de e-mail no servidor |
| **`trim()`** | Sanitização de entradas |
| **`htmlspecialchars()`** | Toda saída de dados ao HTML |
| **Validação dupla (JS + PHP)** | Formulários de login e CRUD |
| **Logout seguro** | Limpa `$_SESSION`, cookie e destrói a sessão |

> 🚫 **Nunca confie apenas no JavaScript.** Toda validação crítica também existe no PHP.

---

## 🎬 Demonstração

Fluxo completo de utilização:

1. Abrir `http://localhost/cadastro-amigos/`
2. Fazer login com `admin@gabi.com` / `123456`
3. Ver o dashboard com total de amigos
4. Cadastrar um novo amigo
5. Visualizar na listagem
6. Editar os dados
7. Excluir com confirmação
8. Fazer logout
9. Tentar acessar `dashboard.php` direto (é redirecionado)

> 📹 **Sugestão:** grave um vídeo de 2 a 3 minutos demonstrando esse fluxo para incluir no repositório.

---

## 📄 Licença

Este projeto foi desenvolvido para fins **acadêmicos**.  
Sinta-se à vontade para estudar, adaptar e reutilizar o código como referência de aprendizado.

---
