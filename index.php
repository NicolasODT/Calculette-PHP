<?php
session_name('calculatrice');
session_start();

require_once "./Calculatrice.php";

$calculatrice = new Calculatrice();

// Si un nombre ou une opération est sélectionné
if (isset($_POST['nombre']) || isset($_POST['operation'])) {
    // Si un nombre est sélectionné
    if (isset($_POST['nombre'])) {
        // Si la session 'b' n'existe pas
        if (!isset($_SESSION['b'])) {
            $_SESSION['b'] = $_POST['nombre'];
        } else {
            // Sinon, ajoute la valeur du nombre sélectionné à la session 'b'
            $_SESSION['b'] .= $_POST['nombre'];
        }
    } else {
        // Si une opération est sélectionnée
        // Enregistre 'b' ou le résultat précédent dans 'a'
        $_SESSION['a'] = isset($_SESSION['result']) ? $_SESSION['result'] : $_SESSION['b'];
        // Réinitialise 'b' pour y stocker le deuxième nombre
        $_SESSION['b'] = "";
        // Enregistre l'opération dans la session 'operation'
        $_SESSION['operation'] = $_POST['operation'];
    }

    // Si 'a', 'b' et 'operation' sont définis et que 'a' et 'b' sont des nombres
    if (isset($_SESSION['a'], $_SESSION['b'], $_SESSION['operation']) && is_numeric($_SESSION['a']) && is_numeric($_SESSION['b'])) {
        $operation = $_SESSION['operation'];
        $a = $_SESSION['a'];
        $b = $_SESSION['b'];

        $result = null;
        if ($operation == "+") {
            $result = $calculatrice->addition($a, $b);
        } elseif ($operation == "-") {
            $result = $calculatrice->soustraction($a, $b);
        } elseif ($operation == "*") {
            $result = $calculatrice->multiplication($a, $b);
        } elseif ($operation == "/") {
            $result = $calculatrice->division($a, $b);
        } elseif ($operation == "%") {
            $result = $calculatrice->pourcentage($a, $b);
        }
        $_SESSION['result'] = $result;
    }
}

// Réinitialise la session si 'C' est sélectionné
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
    <button name="operation" value="%">%</button>
</form>

<p><?= "$a $operation $b = " . ($result ?? '??') ?></p>
