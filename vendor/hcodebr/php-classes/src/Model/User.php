<?php

namespace Hcode\Modelo;

use \Hcode\DB\Sql;
use \Hcode\Model;


class User extends Model{

    public static function login($login, $password){

        $sql = new Sql();
        
        //pegando o valor do método :LOGIN
        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(

            ":LOGIN"=>$login

        ));

        if(count($results) === 0){
            throw new \Exception("Usuário inexistente ou senha inválida.", 1);
        }

        $data = $results[0];

        if (password_verify($password, $data["despassword"]) === true){

            $user = new User();

            $user->setiduser($data["iduser"]);

        } else{ 
            throw new \Exception("Usuário inexistente ou senha inválida.", 1);
        }        
    }
}

?>