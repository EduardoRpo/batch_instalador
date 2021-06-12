<?php

if (!empty($_POST)) {
    $realizo = $_POST['firma'];

    $sql = "INSERT INTO batch_desinfectante_seleccionado (modulo, batch, realizo) VALUES(:modulo, :batch, :realizo)";
    $query = $conn->prepare($sql);
    $result = $query->execute(['modulo' => $modulo, 'batch' => $batch, 'realizo' => $realizo]);
    registrarFirmas($conn, $batch, $modulo);
    if ($result) echo '1';
    else echo '0';
}
