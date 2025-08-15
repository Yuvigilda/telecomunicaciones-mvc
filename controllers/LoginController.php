<?php
namespace Controllers;


use MVC\Router;
use Clases\Email;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){

        $auth = new Usuario;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);//almacena lo que viene de pst

            $alertas = $auth->validarLogin();
            
            if(empty($alertas)){
                //comprobar que el usuario existe
                // Comprobar que el usuario existe
                /** @var ?Usuario $usuario */
                $usuario = Usuario::where('email', $auth->email);

          

                if($usuario){
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //autenticar al usuario
                        

                        if(!isset($_SESSION)){
                            session_start();
                        }
                        

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //redireccionamiento

                        if($usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /login');
                        }

                        
                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login',[
            'alertas' => $alertas,
            'auth' => $auth
        ]);
        
    }
    public static function logout(){
        if(!isset($_SESSION)){
            session_start();
        }
        

        $_SESSION = [];
        header('Location: /login');
    }
    public static function olvide(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty($alertas)){
                /** @var ?Usuario $usuario */
                $usuario = Usuario::where('email', $auth->email);
                if($usuario && $usuario->confirmado === "1"){
                    //generar un token

                    $usuario->crearToken();
                    $usuario->guardar();

                    //enviar el email

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    
                    //alerta de exito

                    Usuario::setAlerta('exito','Revisa tu email');

                }else{
                    Usuario::setAlerta('error', 'Usuario no existe o no esta confirmado');
                    
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide',[
            'alertas' => $alertas
        ]);
    }
    public static function recuperar(Router $router){
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);

        //buscar usuario por su token
        /** @var ?Usuario $usuario */
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error','Token no valido');
            $error = true;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //leer el nuevo pass y guardarlo
            $password= new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /login');
                }
            }
        }

        // debuguear($usuario);
        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
    public static function crear(Router $router){
        $usuario = new Usuario;
        //alertas vacias

        $alertas= [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // echo 'enviate el formulario';
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            //revisar que alertas este vacio

            if(empty($alertas)){
                //revisar  que el usuario no este registrado

                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    //no esta registrado
                    //hashear el password

                    $usuario->hashPassword();

                    //generar token unico

                    $usuario->crearToken();

                    //enviar el email

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();
                    
                    //crear el usuario

                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }

            }

        }
        $router->render('auth/crear-cuenta',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);

        
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }
    public static function  confirmar(Router $router) {

        $alertas = [];

        $token = s($_GET['token']);
        
    /** @var ?Usuario $usuario */
        $usuario = Usuario::where('token',$token);

        if(empty($usuario)){
            //mostrar mensaje de error
            
            Usuario::setAlerta('error', 'Token no valido');

        }else{
            //modificar a usuario confirmado
            $usuario->confirmado = '1';
            $usuario->token = null;
            $usuario->guardar();

            $usuario->setAlerta('exito', 'Cuenta comprobada correctamente');
        }
        //obtener alertas
        $alertas = Usuario::getAlertas();
        //renderizar la vista
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    } 
      
}