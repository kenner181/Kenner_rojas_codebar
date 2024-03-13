<?php
require 'conexion/conexion.php';
$db = new Database();
$con = $db->conectar();

require 'vendor/autoload.php';
use Picqer\Barcode\BarcodeGeneratorPNG;

if (isset($_POST["registro"]) && $_POST["registro"] == "formu"){
    $placa = $_POST['placa'];
    $marca= $_POST['marca'];
    $dueno = $_POST['dueno'];

    //variable para el codigo de barras
    $codigo_barras = uniqid() . rand(1000, 9999);
    $generator = new BarcodeGeneratorPNG();
    $codigo_barras_imagen = $generator->getBarcode($codigo_barras, $generator::TYPE_CODE_128);

    //ruta para guardar los codigos de barras
    $ruta_imagen = 'images/' . $codigo_barras . '.png';
    file_put_contents(__DIR__ . '/images/' . $codigo_barras . '.png', $codigo_barras_imagen);

    //hacemos el insert a la base de datos
    $insertSQL = $con->prepare ("INSERT INTO carros (placa, cod_bar, marca, dueno) 
    VALUES (?,?,?,?)");
    $insertSQL->execute([$placa,$codigo_barras,$marca,$dueno]);
    echo "<script>alert('Vehiculo registrado exitosamente');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de vehiculos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <aside class="col-md-4">
            <h2>Formulario</h2>
            <form method="post">
                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <input name="placa" type="text" class="form-control" id="placa" placeholder="Ingrese la placa" required>
                </div>
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input name="marca" type="text" class="form-control" id="marca" placeholder="Ingrese la marca" required>
                </div>
                <div class="form-group">
                    <label for="dueno">Dueño:</label>
                    <input name="dueno" type="text" class="form-control" id="dueño" placeholder="Ingrese el nombre del dueño" required>
                </div>
                
                <input type="submit" class="btn btn-primary" value="Registrar">
                <input type="hidden" name="registro" value="formu">
            </form>
        </aside>



        <div class="col-md-8">
            <h2>Tabla de Datos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Dueño</th>
                        <th>Codigo</th>
                    </tr>
                </thead>
                <tbody>
                   
                        <?php
                        $result = $con->query("SELECT * FROM carros");
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $ruta_imagen = 'images/' . $row['cod_bar'] . '.png';
                            echo "<tr>";
                            echo "<td>" . $row['placa'] . "</td>";
                            echo "<td>" . $row['marca'] . "</td>";
                            echo "<td>" . $row['dueno'] . "</td>";
                            echo "<td><img src='" . $ruta_imagen . "' alt='Código de Barras'></td>"; 
                            echo "</tr>";   

                        }
                        ?>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
