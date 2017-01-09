<?php

// Premier
class Model
{

  public $string;
  public $string2;

  public function __construct()
  {

    $this -> string = "Page 1";

    $this -> string2 = "Page 2";

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

  public function page1()
  {
    $this -> model -> string = "Page 2";
    $this -> model -> string2 = "Acceuil";
  }

  public function page2()
  {
    $this -> model -> string = "Page 1";
    $this -> model -> string2 = "Acceuil";
  }

  public function acceuil()
  {
    $this -> model -> string = "Page 1";
    $this -> model -> string2 = "Page 2";
  }


}

// Troisieme
class View
{

  private $model;
  private $controller;
  public $action = "page1";
  public $action2 = "page2";

  public function __construct($controller, $model)
  {
    $this -> controller = $controller;
    $this -> model = $model;
  }

  public function output()
  {
    return
    "<p><a href=\"index.php?action=" . $this -> action . "\">" . $this -> model -> string . "</a></p>"
     .
    "<p><a href=\"index.php?action=" . $this -> action2 . "\">" . $this -> model -> string2 . "</a></p>";
  }
  public function toggle($action)
  {
    if ($action === "page1") {

      $this -> action = "page2";
      $this -> action2 = "acceuil";

    } elseif ($action === "acceuil") {

      $this -> action = "page1";
      $this -> action2 = "page2";

    } elseif ($action === "page2") {

      $this -> action = "page1";
      $this -> action2 = "acceuil";

    } elseif (empty($action)) {
      $this -> action = "acceuil";
    }
  }

}


//Instance 1
$model = new Model();

//Instance 2, injection de 1
$controller = new Controller($model);

//Instance 3, injection de 2(1) et de 1
$view = new View($controller, $model);

//Verification si le $_GET est definie
if (isset($_GET['action'])) {

  //Si oui, on le stock dans une variable pour le $_GET
  $actionGet = $_GET['action'];

}

// Verification de l'action
if (isset($_GET['action']) && !empty($actionGet) && $actionGet === 'acceuil') {

  //Appel de la method toggle
  $view -> toggle($actionGet);

  $controller -> {$actionGet}();

} elseif (isset($_GET['action']) && !empty($actionGet) && $actionGet === 'page1') {

  $view -> toggle($actionGet);

  $controller -> {$actionGet}();
} elseif (isset($_GET['action']) && !empty($actionGet) && $actionGet === 'page2') {

  $view -> toggle($actionGet);

  $controller -> {$actionGet}();
}



//Appel method
echo $view -> output();
