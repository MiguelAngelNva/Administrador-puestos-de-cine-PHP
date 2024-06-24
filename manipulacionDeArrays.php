<?php
    // Verificamos si se han recibido datos del formulario
    if(isset($_POST['fila']) && isset($_POST['columna']) && isset($_POST['accion'])) {
        // Si es asi, guardaremos los datos llegados del formulario en una variable para cada dato
        $fila = $_POST['fila'];
        $puesto = $_POST['columna'];
        $accion = $_POST['accion'];

        // Inicializamos el teatro con todos los puestos disponibles (valor "L" por defecto)
        $teatro = inicializarTeatro();

        $mensaje = procesarAccion($teatro, $fila, $puesto, $accion);

        // Generamos la tabla HTML con el teatro actualizado
        $tablaHTML = generarTablaHTML($teatro);

        // mostramos la tabla con el cambio realizado junto al formulario 
        echo '<style>
            .container {
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                margin-top: 20px;
            }

            .form-group {
                margin-top: 10px;
            }

            .buttons {
                margin-top: 10px;
            }
        </style>';

        echo '<div class="container">';
        echo '<div class="table-container">';
        echo $tablaHTML;
        echo '</div>';
        echo '<p>' . $mensaje . '</p>';
        echo '</div>';

        echo '
        <form action="manipulacionDeArrays.php" method="post">
            <div class="container">
                <div class="form-group">
                    <label >Fila:</label>
                    <select name="fila" id="numeroDeFila">
                        <option selected disabled>#</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Columna:</label>
                    <select name="columna" id="numeroDeColumna">
                        <option selected disabled>#</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Reservar:</label>
                    <input type="checkbox" name="accion" value="reservar" id="reservar">
                </div>

                <div class="form-group">
                    <label>Comprar:</label>
                    <input type="checkbox" name="accion" value="comprar" id="comprar">
                </div>

                <div class="form-group">
                    <label>Liberar:</label>
                    <input type="checkbox" name="accion" value="liberar" id="liberar">
                </div>

                <div class="buttons">
                    <button type="submit">Enviar</button>
                    <button type="cancel" onclick="reset()">Cancelar</button>
                </div>
                
            </div>
        </form>
        ';
    } else {
        echo "Error: No se han recibido datos del formulario." ;
        echo '
        <a href="index2.php"
            <button type="button">Volver</button>
        </a>;
        ';
    }

    // Función para inicializar el teatro con todos los puestos disponibles (esta es la tabla base)
    function inicializarTeatro() {
        $teatro = array();
        for ($i = 0; $i < 5; $i++) {
            $fila = array();
            for ($j = 0; $j < 5; $j++) {
                $fila[] = 'L'; 
            }
            $teatro[] = $fila;
        }
        return $teatro;
    }

    function procesarAccion(&$teatro, $fila, $puesto, $accion) {
        // Verificamos si la fila y el puesto proporcionados son válidos
        if (!is_numeric($fila) || !is_numeric($puesto) || $fila < 1 || $fila > 5 || $puesto < 1 || $puesto > 5) {
            return "Error: La fila y/o el puesto proporcionados no son válidos.";
        }

        // Convertimos fila y puesto a índices de arreglo (restamos 1 porque los índices de arreglo comienzan en 0)
        $filaIndex = $fila - 1;
        $puestoIndex = $puesto - 1;

        /* Verificamos la acción solicitada, ya sea Liberar, reservar o comprar y realizamos la operación correspondiente 
        mediante un switch teniendo en cuenta que no sea la misma accion que ya tenia anteriromente */
        switch ($accion) {
            case 'reservar':
                // Verificamos si el puesto está disponible para ser reservado
                if ($teatro[$filaIndex][$puestoIndex] === 'L') {
                    // Marcamos el puesto como reservado
                    $teatro[$filaIndex][$puestoIndex] = 'R';
                    return "Puesto $puesto en la fila $fila reservado correctamente.";
                } else {
                    return "Error: El puesto $puesto en la fila $fila no está disponible para ser reservado.";
                }
                break;
            case 'comprar':
                // Verificamos si el puesto está disponible o reservado para ser comprado
                if ($teatro[$filaIndex][$puestoIndex] === 'L' || $teatro[$filaIndex][$puestoIndex] === 'R') {
                    // Marcamos el puesto como vendido
                    $teatro[$filaIndex][$puestoIndex] = 'V';
                    return "Puesto $puesto en la fila $fila comprado correctamente.";
                } else {
                    return "Error: El puesto $puesto en la fila $fila no está disponible para ser comprado.";
                }
                break;
            case 'liberar':
                // Verificamos si el puesto está reservado para ser liberado
                if ($teatro[$filaIndex][$puestoIndex] === 'R') {
                    // Marcamos el puesto como disponible
                    $teatro[$filaIndex][$puestoIndex] = 'L';
                    return "Puesto $puesto en la fila $fila liberado correctamente.";
                } else {
                    return "Error: El puesto $puesto en la fila $fila no está reservado y no puede ser liberado.";
                }
                break;
            default:
                return "Error: Acción no válida.";
                break;
        }
    }

    // Función para generar la tabla HTML con el estado actualizado del teatro
    function generarTablaHTML($teatro) {
        $html = '<table border="1">';
        $html .= '<tr><th></th>';
        for ($j = 1; $j <= 5; $j++) {
            $html .= "<th>Puesto $j</th>"; // Números de puesto en la primera fila
        }
        $html .= '</tr>';
        for ($i = 0; $i < 5; $i++) {
            $html .= '<tr>';
            $html .= "<th>Fila " . ($i + 1) . "</th>"; // Números de fila en la primera columna
            for ($j = 0; $j < 5; $j++) {
                $html .= '<td>' . $teatro[$i][$j] . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';
        return $html;
    }

    // Convertimos el arreglo del teatro a una cadena de caracteres mediante la funcion serialize
    function teatroACadena($teatro) {
        
        return serialize($teatro);
    }

    // Convertimos la cadena de caracteres del teatro a un arreglo del teatro mediante la funcion unserialize
    function cadenaATeatro($cadena) {
        return unserialize($cadena);
    }

?>


