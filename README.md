# API REST usando a linguagem PHP.
Configuração do Banco de dados:<br/>
No diretório Source/config.php endite os campos para seu banco de dados:<br/>
"driver" => "mysql",<br/>
"host" => "Host", #Padrão local: localhost<br/>
"port" => "Porta", #Padrão: 3306<br/>
"dbname" => "Banco de Dados", #Padrão arquivo SQL: bancoapirest<br/>
"username" => "Usuario BD",<br/>
"passwd" => "Senha BD",<br/>

 Também é preciso importa o SQL no seu Banco de dados:<br/>
 Importe o arquivo script.sql<br/>
<br/>
 Pronto agora é só usa-lo: <br/>
<br/>
<br/>
 Link: Source/Controllers/User.php<br/>
<br/>
# Para realizar o cadastro:<br/>
   Método POST, com Labels no formato JSON: First_Name, Last_Name e Email.<br/>
<br/>
# Para realizar a consultar:<br/>
   Método GET.<br/>
   Trará todas os usuarios cadastrados<br/>
<br/>
# Para realizar a atualização:<br/>
   METODO PUT, com Query: ID, e Labels no formato JSON: First_Name, Last_Name e Email.<br/>
   <br/>
# Para realizar a remoção:<br/>
   METODO DELETE, com Query: ID.<br/>
