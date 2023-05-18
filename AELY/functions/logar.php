<?php
    

	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){
		
        require '../config/UsuarioClass.php';

        $user = new Usuario();
        
        $email = $_POST['email'];
		$senha = md5($_POST['senha']);

        if($user->login($email, $senha)){
            if(isset($_SESSION['emailUser'])){
                if($_SESSION['adm']){
                header("Location: ../menuAdm.php");
                }
                else{
                    header("Location: ../index.php");
                }
            }else{
                header("Location: ../index.php");
            }

        }else{
            $_SESSION['error']=true;
            header("Location:../login.php");
        }

	}else{

	}

?>