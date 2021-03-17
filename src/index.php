<?php
    require_once "vendor/autoload.php";
    require_once "controllers/UserController.php";
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;

    $app = AppFactory::create();
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->addErrorMiddleware(true, true, true);

    $app->get("/user", function(Request $req, Response $res) {
        $userController = new UserController();
        $result = $userController->getAllUsers();
        $json = json_encode($result);
        
        $res->getBody()->write($json);
        return $res->withHeader("Content-type", "application/json");
    });

    $app->get("/user/{id}", function(Request $req, Response $res, $args) {
        $userController = new UserController();
        $id = $args["id"];
        $result = $userController->getUser($id);
        $json = json_encode($result);
        
        $res->getBody()->write($json);
        return $res->withHeader("Content-type", "application/json");
    });

    $app->post("/user", function(Request $req, Response $res) {
        $userController = new UserController();
        $params = $req->getParsedBody();

        $userController->createUser($params["name"], $params["email"]);

        $json = json_encode(array(
            "sucess" => true,
        ));

        $res->getBody()->write($json);
        return $res->withHeader("Content-type", "application/json");
    });

    $app->put("/user/{id}", function(Request $req, Response $res, $args){
        $userController = new UserController();
        $params = $req->getParsedBody();
        $id = $args["id"];

        if (!isset($params["name"])){
            $user = $userController->getUser($id);
            $userController->updateUser($id, $user[0]["name"], $params["email"]);
        } else if (!isset($params["email"])) {
            $user = $userController->getUser($id);
            $userController->updateUser($id, $params["name"], $user[0]["email"]);
        } else {
            $userController->updateUser($id, $params["name"], $params["email"]);
        }

        $json = json_encode(array(
            "sucess" => true,
        ));

        $res->getBody()->write($json);
        return $res->withHeader("Content-type", "application/json");
    });

    $app->delete("/user/{id}", function (Request $req, Response $res, $args) {
        $userController = new UserController();
        $id = $args["id"];

        $userController->deleteUser($id);

        $json = json_encode(array(
            "sucess" => true,
        ));

        $res->getBody()->write($json);
        return $res->withHeader("Content-type", "application/json");
    });

    $app->run();
?>