<?php
class Model
{
    public $string;

    public function __construct() {
        $this -> string = "Clique-moi, grand fou !";
    }

    /*public function clicked() {
        $this -> string = "Clique-moi, grand fou !";
    }


    public function clickedAgain() {
        $this -> string = "Ich bin clicked again !";
    }

    public function clickedAgainAndAgain() {
        $this -> string = "Ich bin clicked again and again!";
    }*/
}

class View
{
    private $model;
    private $controller;

    public function __construct($controller, $model) {
        $this -> controller = $controller;
        $this -> model = $model;
    }

    public function output() {
        //$url = "<p><a href=\"index.php\">Back to the home</a></p>";
        $url = "<p><a href=\"index.php?action=clicked\">" . $this -> model -> string . "</a></p>";
        return $url;
    }
}

class Controller
{
    private $model;

    public function __construct($model) {
        $this -> model = $model;
    }
    public function clicked() {
        $this -> model -> string = "Méthode clicked appelee";
    }/*

    public function clickedAgain($model) {
        $this -> model = $model;
    }

    public function clickedAgainAndAgain($model) {
        $this -> model = $model;
    }
*/
}



$action = $_GET['action'];

if (!empty($action)) {
  $date = array(
    'mentions' => array('model' => 'MentionModel', 'view' => 'MentionsView', 'controller' => 'MentionController'),
    'Contact' => array('model' => 'ContactModel', 'view' => 'ContactView', 'controller' => 'ContactController'),
  );

  foreach ($data as $key => $components) {
    if ($action == $key) {
      $model = $components['model'];
      $view = $components['view'];
      $controller = $components['controller'];
      break;
    }
  }

  if (isset($model)) {

    $m = new $model();
    $v = new $view();
    $c = new $controller();

    echo $v -> output();
  }
}




$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller -> {$_GET['action']}();
}

echo $view -> output();
