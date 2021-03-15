<?php
    require_once "vendor/autoload.php";
    require_once "controllers/UserController.php";
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;

    $app = AppFactory::create();
    

    $app->get("/", function(Request $req, Response $res) {
        $userController = new UserController();
        $result = $userController->getAllUsers();
        $json = json_encode($result);
        
        $res->getBody()->write($json);
        return $res->withHeader("Content-type", "application/json");
    });

    $app->run();
?>