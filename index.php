<?php
session_name('ccalculette');
session_start();

require_once "./calculatrice.php";

$calculatrice = new Calculatrice();

// si on appui sur un bouton
if (isset($_POST['nombre']) || isset($_POST['operation'])) {
	//si on appuie sur un chiffre
  if (isset($_POST['nombre'])) {
	//si session b n'existe pas 
    if (!isset($_SESSION['b'])) {
      $_SESSION['b'] = $_POST['nombre'];
    } else {
      //sinon on ajoute la valeur du nombre clique a la fin de la session b
        $_SESSION['b'] .= $_POST['nombre'];
    }
  } else {
	// sinon si on appui sur une opration
	//on save B dans A comme sa on recupere b pour la suite
    $_SESSION['a'] = $_SESSION['b'];
	// et on remet b a zero  comme sa on mes le 2 eme chiffre a l'interieur
    $_SESSION['b'] = "";
	// on save operation dans session operation ( +,-,*,/)
    $_SESSION['operation'] = $_POST['operation'];
  }
  if (isset($_SESSION['a'], $_SESSION['b'], $_SESSION['operation']) && is_numeric($_SESSION['a']) && is_numeric($_SESSION['b'])) {
    if ($_SESSION['operation'] == "+") {
      $result = $calculatrice->addition(($_SESSION['a']),($_SESSION['b']));
    } else if ($_SESSION['operation'] == "-") {
      $result = $calculatrice->soustraction(($_SESSION['a']),($_SESSION['b']));
    } else if ($_SESSION['operation'] == "*") {
      $result = $calculatrice->multiplication(($_SESSION['a']),($_SESSION['b']));
    } else if ($_SESSION['operation'] == "/") {
      $result = $calculatrice->division(($_SESSION['a']),($_SESSION['b']));
    }
    $_SESSION['result'] = $result;
  }
}

// reset si on click sur C
if (isset($_POST['clear'])) {
  session_unset();
}

$a = $_SESSION['a'] ?? '';
$b = $_SESSION['b'] ?? '';
$operation = $_SESSION['operation'] ?? '';
?>

<form method="post">
    <button name="nombre" value="1">1</button>
    <button name="nombre" value="2">2</button>
    <button name="nombre" value="3">3</button>
    <br />
    <button name="nombre" value="4">4</button>
    <button name="nombre" value="5">5</button>
    <button name="nombre" value="6">6</button>
    <br />
    <button name="nombre" value="7">7</button>
    <button name="nombre" value="8">8</button>
    <button name="nombre" value="9">9</button>
    <br />
    <button name="operation" value="+">+</button>
    <button name="nombre" value="0">0</button>
    <button name="operation" value="-">-</button>
    <br />
    <button name="operation" value="*">*</button>
    <button name="clear" value="C">C</button>
    <button name="operation" value="/">/</button>
</form>

<p><?= "$a $operation $b = " . ($result ?? '??') ?></p>
