<?php
// Verificar si el formulario fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<!DOCTYPE html><html lang='es'><head><meta charset='utf-8'><title>No hay datos</title></head><body><h2>No se recibieron datos por POST.</h2></body></html>";
    exit;
}

// Función para sanitizar texto
function s($v) {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

// Captura y sanitización de variables
$nombre       = s($_POST['nombre_cliente'] ?? '');
$email        = s($_POST['email_cliente'] ?? '');
$telefono     = s($_POST['telefono_cliente'] ?? '');
$tipoVehiculo = s($_POST['tipo_vehiculo'] ?? '');
$marca        = s($_POST['marca_interes'] ?? '');
$condicion    = s($_POST['condicion'] ?? '');
$presupuesto  = $_POST['presupuesto_max'] ?? '';
$metodoPago   = s($_POST['metodo_pago'] ?? '');
$rendimiento  = s($_POST['prioridad_rendimiento'] ?? '');
$seguridad    = s($_POST['prioridad_seguridad'] ?? '');
$tecnologia   = s($_POST['prioridad_tecnologia'] ?? '');
$comentarios  = s($_POST['comentarios_adicionales'] ?? '');

// Formatear presupuesto
$presupuesto_display = ($presupuesto === '' || $presupuesto === null)
    ? '-'
    : '$' . number_format((float)$presupuesto, 0, ',', '.');

// Datos para la tabla
$rows = [
    'Nombre' => $nombre ?: '-',
    'Correo Electrónico' => $email ?: '-',
    'Teléfono' => $telefono ?: '-',
    'Tipo de Vehículo' => $tipoVehiculo ?: '-',
    'Marca de Interés' => $marca ?: '-',
    'Condición' => $condicion ?: '-',
    'Presupuesto Aproximado' => $presupuesto_display,
    'Método de Pago' => $metodoPago ?: '-',
    'Prioridad en Rendimiento' => $rendimiento ?: '-',
    'Prioridad en Seguridad' => $seguridad ?: '-',
    'Prioridad en Tecnología' => $tecnologia ?: '-',
    'Comentarios Adicionales' => $comentarios ?: '-',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Datos recibidos - DarckCar</title>
  <style>
    body { font-family: Arial, Helvetica, sans-serif; padding: 20px; background:#f7f7f7; color:#222; }
    h1 { color:#111; }
    table { border-collapse: collapse; width: 100%; max-width: 800px; background:#fff; box-shadow:0 1px 3px rgba(0,0,0,.1); }
    th, td { padding: 10px 12px; border: 1px solid #e1e1e1; text-align: left; vertical-align: top; }
    th { background:#fafafa; width: 30%; }
    td { background:#fff; }
    .meta { margin-top: 16px; color:#555; }
    a.button { display:inline-block; margin-top:12px; padding:8px 14px; background:#0078d4; color:#fff; text-decoration:none; border-radius:4px; }
  </style>
</head>
<body>
  <h1>Datos recibidos correctamente 🚗</h1>

  <table>
    <thead>
      <tr><th>Campo</th><th>Valor</th></tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $campo => $valor): ?>
        <tr>
          <th><?php echo s($campo); ?></th>
          <td><?php echo nl2br(s($valor)); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p class="meta"><em>Gracias por contactarte con DarckCar. Un asesor se comunicará contigo pronto.</em></p>
  <a class="button" href="index.html" target="_blank" rel="noopener">Volver al sitio</a>
</body>
</html>
