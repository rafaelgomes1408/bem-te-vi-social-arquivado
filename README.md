# Bem-te-vi

É um protótipo de rede social desenvolvido como parte do Trabalho de Conclusão de Curso (TCC) no curso de Sistemas de Informação da Universidade do Estado de Minas Gerais (UEMG). O projeto visa integrar usuários de forma positiva, oferecendo um espaço livre de postagens ofensivas.

## Funcionalidades

- **Cadastro de Usuários**: Permite que usuários criem contas com informações pessoais.
- **Postagens**: Usuários podem criar e visualizar postagens.
- **Segurança com BERTimbau**: Utiliza a IA BERTimbau para análise de conteúdo e bloqueio de postagens maliciosas.

## Estrutura do Projeto

- **Backend**: Desenvolvido em PHP seguindo o padrão MVC.
- **Banco de Dados**: Utiliza SQLite.
- **Infraestrutura**: Configurado localmente com Laragon no Windows 11.
- **Scripts de Análise**: Python e BERTimbau para moderação de conteúdo (logo seram compartilhados).

## Requisitos

- Python 3.13+
- Laragon

## Instalação

1. Clone o repositório:
   ```sh
   git clone https://github.com/rafaelgomes1408/bem-te-vi-social-arquivado.git
   ```
2. Configure o ambiente:
   ```sh
   cp .env.example .env
   ```
   Edite o arquivo `.env` com as credenciais do banco de dados.
3. Instale dependências:
   ```sh
   composer install
   ```
4. Execute migrações do banco:
   ```sh
   php artisan migrate
   ```
5. Inicie o servidor Laragon e acesse o projeto via navegador.

## Autores

[Rafael de Castro Gomes](https://github.com/rafaelcastrogomes)<br>
[Renato Medeiros Guimarães](https://github.com/Rtomedeiros)

## Links importantes do projeto Bem-te-vi

- [BERTimbau - Portuguese BERT](https://github.com/neuralmind-ai/portuguese-bert/) - Este repositório contém modelos BERT pré-treinados e treinados na língua portuguesa.
- [BERTimbau Base (aka "bert-base-portuguese-cased")](https://huggingface.co/neuralmind/bert-base-portuguese-cased) - Página do BERTimbau no Hugging Face.
- [HateBR](https://github.com/franciellevargas/HateBR) - Repositório do HateBR, Dataset de linguagem ofensiva e discurso de ódio em português brasileiro.
