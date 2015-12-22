# Poll
  * Desenvolvido com laravel e AngularJS.

## Funcionamento
 - Para fazer a criação de uma nova pesquisa no sistema, é necessário passar o numero do ticket como parâmetro da url. Por exemplo **/ticket/231**.
 - O painel de Controle se encontra em /painel/

## Pré requerimentos.
 - O projeto foi construido com laravel, o que necessita com que você tinha instalado **[composer](https://getcomposer.org/)**.
 - Para as dependências de front-end, foi utilizado o  **[npm](https://nodejs.org/en/)** para fazer o gerenciamento das mesmas.
 - Além do proprio php+mysql (ou qualquer outro banco de dados relacional a sua escolha.
 - Também será necessário ter github instalado.

## Instalação
- Clone o repositorio através do comando
``` git clone https://github.com/PlayMa256/Poll.git ```
- Depois de clonado, adentre a pasta do repositório ``` cd Poll ```
- digite ``` sudo composer install```
- e logo após ``` sudo npm install```

##Execução
- o laravel utiliza de um comando próprio para inicializar o seu serviço, pois então:
  * Entre na pasta em que está o projeto.
  * Digite ```php artisan serve``` (rodará como padrão na porta 8000)
     * Para colocar em qualquer outra porta, utilize ```php artisan serve --port=80```
     
## Configuração.
- Para configurar os dados de acesso ao banco de dados, utilize o arquivo .env
- Alterar os dados de DB1 para o banco onde ficará o projeto poll.
- Alterar os dados de DB2 para onde está o banco de dados do GLPI.
