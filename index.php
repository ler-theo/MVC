<?php

// Premier
class Model
{

  public $string;

  public function __construct()
  {
    $this -> string = "Le MVC, c'est le pied !";
  }

}

//Deuxieme
class Controller
{

  private $model;

  public function __construct($model)
  {
    $this -> model = $model;
  }

}

//Troisieme
class View
{

  private $model;
  private $controller;

  public function __construct($controller, $model)
  {
    $this -> controller = $controller;
    $this -> model = $model;
  }

  public function output()
  {
    return "<p>" . $this -> model -> string . "</p>";
  }

}


//Instance 1
$model = new Model();

//Instance 2, injection de 1
$controller = new Controller($model);

//Instance 3, injection de 2(1) et de 1
$view = new View($controller, $model);

//Appel method 
echo $view -> output();
