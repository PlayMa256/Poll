# Poll
Sistema de pesquisa de satisfação criado utilizando também os dados das tabelas do sistema de tickets GLPI. Futuramente será incluido diretamente ao GLPI.

## Uso
  * Edite o arquivo classes/Connetions.php com os dados de acesso ao seu banco de dados
  * Para criar uma pesquisa de satisfação passe o numero do ticket para /index.php?ticket=# onde # é o numero do ticket.
  * Para acessar o painel de controle onde será possivel
    * Cadastrar Novas perguntas
    * Editar os seus respectivos status (ativado ou desativado)
    * deleta-las
    * Ver resultados.