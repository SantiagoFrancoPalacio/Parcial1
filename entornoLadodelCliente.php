//Frontend estático

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maqueta Web Dinámica en PHP</title>


    
</head>
<body>

    <header>
        <h1>Mi Primer Sitio Web</h1>
        <nav>
            <ul>
                <li><a href="home.php?seccion=inicio">Inicio</a></li>
                <li><a href="home.php?seccion=servicios">Servicios</a></li>
                <li><a href="home.php?seccion=contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <div id="contenedor-principal">
        <div>
            <?php
            // 2. Evaluamos el valor de la variable para decidir qué contenido imprimir
            switch ($seccion_actual) {
                case 'inicio':
                    echo "<h2>Bienvenido a nuestra Página de Inicio</h2>";
                    echo "<p>Este es el contenido principal de la portada. Cambia dinámicamente usando PHP al interactuar con el menú superior sin necesidad de crear múltiples archivos HTML.</p>";
                    break;

                case 'servicios':
                    echo "<h2>Nuestros Servicios</h2>";
                    echo "<p>Ofrecemos soluciones web a medida:</p>";
                    echo "<ul>";
                    echo "<li>Desarrollo Backend con PHP</li>";
                    echo "<li>Maquetación Semántica HTML/CSS</li>";
                    echo "<li>Diseño de Interfaces Dinámicas</li>";
                    echo "</ul>";
                    break;

                case 'contacto':
                    // Verificamos si el usuario envió el formulario de contacto
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
                    $nombre_contacto = trim($_POST['nombre']);

                    if (!empty($nombre_contacto)) {
                    try {
                        // Preparamos la consulta SQL con un marcador (:nombre) por seguridad
                        $sql = "INSERT INTO contactos (nombre) VALUES (:nombre)";
                        $stmt = $conexion->prepare($sql);
                
                        // Vinculamos el parámetro y ejecutamos
                        $stmt->execute([':nombre' => $nombre_contacto]);
                
                        $mensaje_db = "<p style='color: green; font-weight: bold;'>¡Mensaje guardado con éxito en la Base de Datos!</p>";
                        } catch (PDOException $e) {
                        $mensaje_db = "<p style='color: red;'>Error al guardar: " . $e->getMessage() . "</p>";
                    }
                    } else {
                        $mensaje_db = "<p style='color: red;'>Por favor, escribe un nombre válido.</p>";
                    }
                }

                echo "<h2>Página de Contacto</h2>";
    
                // Mostramos la respuesta del servidor si existe
                echo $mensaje_db;

                echo '<form action="" method="POST">
                    <label for="nombre">Tu Nombre: </label><br>
                    <input type="text" id="nombre" name="nombre" required><br><br>
                    <button type="submit">Enviar Mensaje</button>
                    </form>';
                break;

                default:
                    // Si el usuario inventa un parámetro en la URL (ej. ?seccion=invalido)
                    echo "<h2>Error 404</h2>";
                    echo "<p>La sección solicitada no existe.</p>";
                    break;
            }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Mi Empresa - Todos los derechos reservados.</p>
    </footer>

</body>
</html>