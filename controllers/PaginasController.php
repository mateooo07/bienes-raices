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
    $mensaje = null;  // ← Inicializar FUERA del if
    
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $respuestas = $_POST["contacto"];

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

            // Sanitizar datos
            $nombre = htmlspecialchars($respuestas["nombre"] ?? '', ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($respuestas["email"] ?? '', ENT_QUOTES, 'UTF-8');
            $telefono = htmlspecialchars($respuestas["telefono"] ?? '', ENT_QUOTES, 'UTF-8');
            $mensajeUsuario = nl2br(htmlspecialchars($respuestas["mensaje"] ?? '', ENT_QUOTES, 'UTF-8'));
            $tipo = htmlspecialchars($respuestas["tipo"] ?? '', ENT_QUOTES, 'UTF-8');
            $precio = htmlspecialchars($respuestas["precio"] ?? '', ENT_QUOTES, 'UTF-8');
            $contacto = htmlspecialchars($respuestas["contacto"] ?? '', ENT_QUOTES, 'UTF-8');
            $fecha = htmlspecialchars($respuestas["fecha"] ?? '', ENT_QUOTES, 'UTF-8');
            $hora = htmlspecialchars($respuestas["hora"] ?? '', ENT_QUOTES, 'UTF-8');

            $contenido = "<html>";
            $contenido .= "<h2>Tienes un nuevo mensaje!</h2>";
            $contenido .= "<p><strong>Nombre:</strong> {$nombre}</p>";
            
            if($contacto === "telefono"){
                $contenido .= "<p><strong>Prefiere ser contactado por:</strong> Llamada telefónica</p>";
                $contenido .= "<p><strong>Teléfono:</strong> {$telefono}</p>";
                $contenido .= "<p><strong>Fecha Contacto:</strong> {$fecha}</p>";
                $contenido .= "<p><strong>Hora Contacto:</strong> {$hora}</p>";
            } else {
                $contenido .= "<p><strong>Prefiere ser contactado por:</strong> Correo electrónico</p>";
                $contenido .= "<p><strong>Email:</strong> {$email}</p>";
            }   
            
            $contenido .= "<p><strong>Mensaje:</strong><br>{$mensajeUsuario}</p>";
            $contenido .= "<p><strong>Vende o Compra:</strong> {$tipo}</p>";
            $contenido .= "<p><strong>Presupuesto o Precio:</strong> \${$precio}</p>";
            $contenido .= "</html>";
            
            $mail->Body = $contenido;
            $mail->AltBody = strip_tags($contenido);

            $mail->send();
            
        } catch (Exception $e) {
            $mensaje = "El mensaje no se pudo enviar. Error: {$mail->ErrorInfo}";
        }
    }

    $router->render("paginas/contacto", [
        "mensaje" => $mensaje  
    ]);
}
}