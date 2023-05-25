<?php

    class Usuario{
        public function login($email, $senha){
            
            require_once 'config.php';
            $user = new Usuario();
            if($user->registrado($email)){
                $sql = "SELECT * FROM usuario WHERE email_usuario=:email AND senha_usuario=:senha";
                $sql = $pdo->prepare($sql);
                $sql->bindParam('email', $email);
                $sql->bindParam('senha', $senha);
                $sql->execute();
    
                if($sql->rowCount() > 0){
    
                    $dado = $sql->fetch();
    
                    $_SESSION['emailUser'] = $dado['email_usuario'];
                    $_SESSION['cduser'] = $dado['cd_usuario'];
                    $_SESSION['adm']=$dado['usuario_adm'];
                    $_SESSION['user']=true;
                    return true;
                    
                }
                else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function registrado($email){
            
            include 'config.php';

            $sql = "SELECT * FROM usuario WHERE email_usuario=:email";
            $sql = $pdo->prepare($sql);
            $sql->bindParam('email', $email);
            $sql->execute();

            if($sql->rowCount() > 0){

                return true;
                
            }else{
                return false;
            }

        }
    }


?>