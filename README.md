# API REST usando a linguagem PHP.
Configuração do Banco de dados:
No diretório Source/config.php endite os campos para seu banco de dados:
    "driver" => "mysql",
    "host" => "Host", #Padrão local: localhost
    "port" => "Porta", #Padrão: 3306
    "dbname" => "Banco de Dados", #Padrão arquivo SQL: bancoapirest
    "username" => "Usuario BD",
    "passwd" => "Senha BD",

 Também é preciso importa o SQL no seu Banco de dados:
 Importe o arquivo script.sql

 Pronto agora é só usa-lo: 


 Link: Source/Controllers/User.php

# Para realizar o cadastro:
   Método POST, com Labels no formato JSON: First_Name, Last_Name e Email.

# Para realizar a consultar:
   Método GET.
   Trará todas os usuarios cadastrados

# Para realizar a atualização:
   METODO PUT, com Query: ID, e Labels no formato JSON: First_Name, Last_Name e Email.
   
# Para realizar a remoção:
   METODO DELETE, com Query: ID.
