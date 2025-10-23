<?php
require_once __DIR__ . '/vendor/autoload.php';
if (class_exists('\Mpdf\Mpdf')) {
    echo "✅ mPDF cargado correctamente";
} else {
    echo "❌ No se encuentra la clase Mpdf\Mpdf";
    exit;
}
$calavera = "uploads/one-piece-calavera.png";

function mostrar_formulario() {
    include "captura.html";
}

function mostrar_resultado() {
    global $calavera;

    $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
    $alias  = isset($_POST['alias'])  ? htmlspecialchars($_POST['alias'])  : '';
    $edad   = isset($_POST['edad'])   ? intval($_POST['edad']) : 0;
    $armas  = isset($_POST['armas'])  ? $_POST['armas'] : [];
    $magia  = isset($_POST['magia'])  ? htmlspecialchars($_POST['magia']) : 'no';

    $imagenMostrada = $calavera;
    $mensaje = "";

    if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != "") {
        $file = $_FILES['imagen'];
        $es_png = $file['type'] === 'image/png';
        $es_tamano = $file['size'] <= 10240;
        if ($file['error'] === UPLOAD_ERR_OK && $es_png && $es_tamano) {
            $nombreImagen = uniqid("jugador_") . ".png";
            $rutaDestino = "uploads/" . $nombreImagen;
            if (move_uploaded_file($file['tmp_name'], $rutaDestino)) {
                $imagenMostrada = $rutaDestino;
            } else {
                $mensaje = "Error al subir la imagen.";
            }
        } else {
            if (!$es_png) $mensaje = "La imagen debe ser PNG.";
            elseif (!$es_tamano) $mensaje = "La imagen debe pesar menos de 10KB.";
            else $mensaje = "Error al subir la imagen.";
        }
    }
    ob_start();
    ?>
    
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Resultado - Datos del Jugador</title>
      <link rel="stylesheet" href="default.css">
      <style>
        .resultado {
          background: #fff59d;
          border-radius: 15px;
          padding: 20px;
          width: 700px;
          margin: 30px auto;
          box-shadow: 0 0 10px rgba(0,0,0,0.2);
          font-family: Tahoma, Geneva, sans-serif;
        }

        .resultado h2 {
          text-align: center;
          color: #111;
          margin-top: 0;
        }

        .resultado-contenido {
          display: flex;
          justify-content: space-between;
          align-items: flex-start;
          gap: 20px;
        }

        .resultado .datos {
          flex: 1;
          padding-right: 10px;
        }

        .resultado .datos p {
          margin: 8px 0;
          font-size: 16px;
          color: #000;
        }

        .resultado .datos strong {
          display: inline-block;
          width: 180px;
        }

        .resultado .imagen {
          width: 200px;
          text-align: center;
        }

        .resultado .imagen img {
          border: 2px solid #555;
          border-radius: 6px;
          margin-top: 8px;
          max-width: 180px;
          height: auto;
          display: block;
          margin-left: auto;
          margin-right: auto;
        }

        .resultado .error {
          color: red;
          font-weight: bold;
          margin-top: 8px;
        }
      </style>
    </head>
    <body>
      <div class="resultado">
        <h2>Datos del Jugador</h2>
        <div class="resultado-contenido">
          <div class="datos">
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Alias:</strong> <?php echo $alias; ?></p>
            <p><strong>Edad:</strong> <?php echo $edad; ?></p>
            <p><strong>Armas seleccionadas:</strong> <?php echo htmlspecialchars(implode(', ', $armas)); ?></p>
            <p><strong>¿Practica artes mágicas?:</strong> <?php echo $magia; ?></p>
          </div>

          <div class="imagen">
            <?php if ($imagenMostrada !== $calavera): ?>
              <p><strong>Imagen subida:</strong></p>
            <?php else: ?>
              <p><strong>Imagen del resultado:</strong></p>
            <?php endif; ?>
            <img src="<?php echo htmlspecialchars($imagenMostrada); ?>" alt="Imagen del jugador">
            <?php if ($mensaje): ?>
              <p class="error"><?php echo $mensaje; ?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </body>
    </html>
    <?php
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_start();
    mostrar_resultado();
    $contenido = ob_get_clean();

    require_once __DIR__ . '/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($contenido);
    $mpdf->Output();
} else {
    mostrar_formulario();
}
?>
