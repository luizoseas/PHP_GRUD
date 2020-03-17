<?php
namespace Source\Controllers;

use Source\Models\User;
use Source\Models\Validations;

require "../../vendor/autoload.php";
require "../config.php";

switch($_SERVER["REQUEST_METHOD"]){
    case "POST":
        $data = json_decode(file_get_contents("php://input"),false);
        if(!$data){
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array("response"=>"Nenhum dado informado"));
            exit;
        }
        $errors = array();
        if(!Validations::validationString($data->first_name)){
            array_push($errors,'Nome');
        }
        if(!Validations::validationString($data->last_name)){
            array_push($errors,'Sobrenome');
        }
        if(!Validations::validationEmail($data->email)){
            array_push($errors,'Email');
        }
        if(count($errors)>0){
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array("response"=>"A campos invalidos no formulario!","fields:"=>$errors));
            exit;
        }
        $user = new User();
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->email = $data->email;
        $user->save();
        if($user->fail()){
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array("response"=>$user->fail()->getMessage()));
            exit;
        }
        header('HTTP/1.1 201 Created');
        echo json_encode(array("response"=>"Usuario criado com sucesso"));
    break;
    case "GET":
        header('HTTP/1.1 200 OK');
        $users = new User();
        if($users->find()->count()>0){
            $return = array();
            foreach($users->find()->fetch(true) as $user){
                // Tratamento de dados vindos do banco
                array_push($return,$user->data());
            }
            echo json_encode(array("response:"=>$return));
        }else{
            echo json_encode(array("response:"=>"Nenhum usuário localizado"));
        }
    break;
    case "PUT":
        $userId = filter_input(INPUT_GET,"id");
        if(!$userId){
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array("response"=>"Id não informado"));
            exit;
        }
        if(!Validations::validationInteger($userId)){
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array("response"=>"Id não é valido."));
            exit;
        }
        $data = json_decode(file_get_contents("php://input"),false);
        if(!$data){
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array("response"=>"Nenhum dado informado"));
            exit;
        }
        $errors = array();
        if(!Validations::validationString($data->first_name)){
            array_push($errors,"Nome Invalído");
        }
        if(!Validations::validationString($data->last_name)){
            array_push($errors,"Sobrenome Invalído");
        }
        if(!Validations::validationEmail($data->email)){
            array_push($errors,"Email Invalído");
        }
        if(count($errors)>0){
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array("response"=>"A campos invalidos no formulario!","fields:"=>$errors));
            exit;
        }
        $user = (new User())->findById($userId);
        if(!$user){
            header('HTTP/1.1 200 OK');
            echo json_encode(array("response"=>"Nenhum usuario foi localizado"));
            exit;
        }
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->email = $data->email;
        $user->save();
        if($user->fail()){
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array("response"=>$user->fail()->getMessage()));
            exit;
        }
        header('HTTP/1.1 200 OK');
        echo json_encode(array("response"=>"Usuario atualizado com sucesso"));
    break;
    case "DELETE":
        $userId = filter_input(INPUT_GET,"id");
        if(!$userId){
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array("response"=>"Id não informado"));
            exit;
        }
        if(!Validations::validationInteger($userId)){
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array("response"=>"Id não é valido."));
            exit;
        }
        $user = (new User())->findById($userId);
        if(!$user){
            header('HTTP/1.1 200 OK');
            echo json_encode(array("response"=>"Nenhum usuario foi localizado"));
            exit;
        }
        $user->destroy();
        if($user->fail()){
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array("response"=>$user->fail()->getMessage()));
            exit;
        }
        header('HTTP/1.1 200 OK');
        echo json_encode(array("response"=>"Usuario removido com sucesso"));
    break;    
    default:
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(array("response"=>"Método não previsto na API"));
    break;
}



