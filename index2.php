<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
    </style>
</head>
<body>

    

    <!-- Control oculto para transmitir la cadena de caracteres del teatro -->
    <textarea name="cadenaTeatro" style="display: none;"><?php echo $cadenaTeatro; ?></textarea>

    <!-- formulario para enviar datos al servidor -->
    <div class="container">
        <div class="table-container">
        <?php require_once 'mostrarHTML.php'; ?>

        <form action="manipulacionDeArrays.php" method="post">
            <div class="form-container">
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
                    <a href="index2.php"
                        <button type="cancel">Cancelar</button>
                    </a>
                </div>
                
            </div>
        </form>
    </div>

    </body>
</html> 