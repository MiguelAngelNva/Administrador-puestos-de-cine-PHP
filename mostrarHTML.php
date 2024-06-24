<?php
// Inicializamos el teatro con todos los puestos disponibles (valor "L" por defecto)
$teatro = array();
for ($i = 0; $i < 5; $i++) {
    $fila = array();
    for ($j = 0; $j < 5; $j++) {
        $fila[] = 'L';
    }
    $teatro[] = $fila;
}

// Imprimimos la tabla html
echo '<table border="1">';
echo '<tr><th></th>'; // Espacio vacío para la esquina superior izquierda de la tabla
for ($j = 1; $j <= 5; $j++) {
    echo "<th>Puesto $j</th>"; // Números de puesto en la primera fila
}
echo '</tr>';
for ($i = 0; $i < 5; $i++) {
    echo '<tr>';
    echo "<th>Fila " . ($i + 1) . "</th>"; // Números de fila en la primera columna
    for ($j = 0; $j < 5; $j++) {
        echo '<td>' . $teatro[$i][$j] . '</td>';
    }
    echo '</tr>';
}
echo '</table>';
?>