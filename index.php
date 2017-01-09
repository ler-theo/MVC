<?php

// Premier
class Model
{

  public $string;

  public function __construct()
  {

    $this -> string = "Page d'acceuil";

  }


}

// Deuxieme
class Controller
{

  private $model;

  public function __construct($model)
  {
    $this -> model = $model;
  }

  public function clicked()
  {
    $this -> model -> string = "Page 1";
  }

  public function acceuil()
  {
    $this -> model -> string = "Page 2";
  }


}

// Troisieme
class View
{

  private $model;
  private $controller;
  public $action = "clicked";

  public function __construct($controller, $model)
  {
    $this -> controller = $controller;
    $this -> model = $model;
  }

  public function output()
  {
    return "<p><a href=\"index.php?action=" . $this -> action . "\">" . $this -> model -> string . "</a></p>";
  }

  public function toggle($action)
  {
    if ($action === "clicked") {

      $this -> action = "acceuil";

    } elseif ($action === "acceuil") {

      $this -> action = "clicked";

    }
  }
}


//Instance 1
$model = new Model();

//Instance 2, injection de 1
$controller = new Controller($model);

//Instance 3, injection de 2(1) et de 1
$view = new View($controller, $model);

$actionGet = $_GET['action'];
// Condition pour definir l'action realisez
if (isset($_GET['action']) && !empty($actionGet) && $actionGet === 'clicked') {

  $view -> toggle($actionGet);

  $controller -> {$actionGet}();

} elseif (isset($_GET['action']) && !empty($actionGet) && $actionGet === 'acceuil') {

  $view -> toggle($actionGet);

  $controller -> {$actionGet}();
}



//Appel method
echo $view -> output();
