<?php

    include("/models/modeloUsuarios.php");

    
    class Usuario{
        private $correo;
        private $username;
        private $nombreReal;
        private $esMod;
        private $esGestor;
        private $esSuper;

        function __construct(){
            $this->correo = 'no';
            $this->username = 'no';
            $this->nombreReal = 'no';
            $this->esMod = 'no';
            $this->esGestor = 'no';
            $this->esSuper = 'no';
        }

        public function userExist($user, $pass){
            // Podría encriptarse la contraseña de tal forma
            // $md5pass = md5($pass);

            // Se le pide al modelo que haga la comprobación
            $existe = ModeloUsuarios::checkUser($user, $pass);

            return $existe;
        }

        // Establece el usuario $user como usuario logueado en la sesión
        public function setUser($user){
            $usuario = ModeloUsuarios::getUser($user);

            $this->correo = $usuario[1];
            $this->username = $usuario[0];
            $this->nombreReal = $usuario[2];
            $this->esMod = $usuario[3];
            $this->esGestor = $usuario[4];
            $this->esSuper = $usuario[5];

            //echo "<script type=\"text/javascript\">alert(\"$this->nombreReal\");</script>";
        }

        public function getCorreo(){
            return $this->correo;
        }

        public function toString(){
            $string =  $this->correo . " " . $this->username . " " . $this->nombreReal . " " . $this->esMod . " " . $this->esGestor . " " . $this->esSuper;
            return $string;
        }

        // Esta si que se queda aqui :D
        public function getNombre(){
            return $this->username;
        }
    }
?>