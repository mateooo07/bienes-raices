<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;


require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render("paginas/index", [
            "propiedades" => $propiedades,
            "inicio" => $inicio
        ]);
    }
    
    public static function nosotros(Router $router){
        $router->render("paginas/nosotros", [

        ]);
    }
    
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $router->render("paginas/propiedades", [
            "propiedades" => $propiedades,
        ]);
    }

    public static function propiedad(Router $router){
        $id = validarORedireccionar("/propiedades");

        $propiedad = Propiedad::find($id);

        $router->render("paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }
    
    public static function blog(Router $router){
        $router->render("paginas/blog", []);
    }

    public static function entrada(Router $router){
        $router->render("paginas/entrada", []);
    }

    public static function contacto(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = $_ENV['MAIL_HOST'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $_ENV['MAIL_USERNAME'];
                $mail->Password   = $_ENV['MAIL_PASSWORD'];
                $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
                $mail->Port       = $_ENV['MAIL_PORT'];

                $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
                $mail->addAddress($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);

                $mail->Subject = "Tienes un Nuevo Mensaje";
                $mail->isHTML(true);
                $mail->CharSet = "UTF-8";

                $contenido = "<html><p>Tienes un nuevo mensaje</p></html>";
                $mail->Body = $contenido;
                $mail->AltBody = "Esto es texto alternativo sin HTML";

                $mail->send();
                echo "Mensaje enviado correctamente";
            } catch (Exception $e) {
                echo "El mensaje no se pudo enviar. Error: {$mail->ErrorInfo}";
            }
        }

        $router->render("paginas/contacto", [

        ]);
    }
}