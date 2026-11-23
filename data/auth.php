<?php
    session_start();
    if(!isset($_SESSION["usuario_id"])){
        header("Location: /login.php");
        exit;
    }else{
        if($_SESSION["tipo_usuário"] === "Cliente"){
<<<<<<< HEAD
            header("Location: /");
        }
    };
    
=======
            header("Location /home.php");
        }else{
            header("Location /index.php");
        }
    }
>>>>>>> 7116ede3ff1994b3e04c18ba68f3120f0203c249
?>