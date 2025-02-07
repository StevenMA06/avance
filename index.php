<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generar PDF</title>

    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Archivo CSS separado -->

    <!-- Librería pdf-lib -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
</head>
<body>

    <!-- Contenedor principal con barra lateral -->
    <div class="d-flex">
        
        <!-- Barra lateral con imagen y botones -->
        <div class="sidebar bg-dark text-white p-3 d-flex flex-column align-items-center" style="width: 200px;">
            <img src="8.png" alt="Logo" class="img-fluid mb-3">
            
            <!-- Botones de tipo certificado en columna -->
            <div class="btn-group-vertical w-100">
                <button class="btn btn-secondary mb-2" id="ejem1">CERTIFICADO TIPO 1</button>
                <button class="btn btn-secondary mb-2" id="ejem2">CERTIFICADO TIPO 2</button>
                <button class="btn btn-secondary mb-2" id="ejem3">CERTIFICADO TIPO 3</button>
                <button class="btn btn-secondary mb-2" id="ejem4">CERTIFICADO TIPO 4</button>
                <button class="btn btn-secondary mb-2" id="ejem5">CERTIFICADO TIPO 5</button>
                <button class="btn btn-secondary mb-2" id="ejem6">CERTIFICADO TIPO 6</button>
            </div>
        </div>

        <!-- Contenedor principal -->
        <div class="container-fluid">

              <div class="container mt-4" id="formContainer1">
                <h1 class="text-center">Datos del Certificado TIPO 1</h1>

                <!-- Formulario de Búsqueda de Certificado -->
                <form id="formBuscar" method="POST" onsubmit="return buscarCertificado(event)">
                    <div class="mb-3">
                        <label for="certificadoID">Ingresa el ID del Certificado:</label>
                        <input type="text" class="form-control" id="certificadoID" name="certificadoID" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-ter">Buscar</button>
                    </div>

                    <script>
                        function buscarCertificado(event) {
                            event.preventDefault();  // Previene el envío del formulario de búsqueda

                            var certificadoID = document.getElementById('certificadoID').value;

                            // Verificar si el ID está vacío
                            if (certificadoID.trim() == "") {
                                alert("Por favor ingresa un ID.");
                                return;
                            }

                            // Realizar la petición AJAX para buscar los datos del certificado
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "buscar.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            
                            // Enviar el ID al archivo PHP para realizar la consulta
                            xhr.send("certificadoID=" + certificadoID);

                            xhr.onload = function() {
                                if (xhr.status == 200) {
                                    // Si se encontró el certificado, llenar los campos
                                    var response = JSON.parse(xhr.responseText);
                                    if (response.success) {
                                        document.getElementById('solicitante1').value = response.solicitante;
                                        document.getElementById('referencia1').value = response.referencia;
                                        document.getElementById('denominacion1').value = response.denominacion;
                                        document.getElementById('codigo1').value = response.codigo;
                                        document.getElementById('fecha1').value = response.fecha;
                                        document.getElementById('firmaSeleccionada').value = response.firma;

                                        // Mostrar el formulario de datos (si estaba oculto)
                                        document.getElementById('formContainer1').classList.remove('d-none');
                                    } else {
                                        alert(response.message);
                                    }
                                }
                            };
                        }
                    </script>
                </form>

                <!-- Formulario de Inserción de Certificado -->
                <form id="form1" method="POST" action="insertar.php"> <!-- Este es el formulario para insertar o actualizar datos -->
                    <div class="mb-3">
                        <label for="solicitante" class="form-label">Solicitante</label>
                        <input type="text" class="form-control" id="solicitante1" name="solicitante" required>
                    </div>
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input type="text" class="form-control" id="referencia1" name="referencia" required>
                    </div>
                    <div class="mb-3">
                        <label for="denominacion" class="form-label">Denominación</label>
                        <input type="text" class="form-control" id="denominacion1" name="denominacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" class="form-control" id="codigo1" name="codigo" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha (Día y Mes)</label>
                        <input type="text" class="form-control" id="fecha1" name="fecha" placeholder="Ejemplo: 26 diciembre" required>
                        <small class="form-text text-muted">Ingresa el día seguido del mes en texto (ejemplo: 26 diciembre).</small>
                    </div>
                    <div class="firma-selector-container">
                        <label for="firmaSeleccionada">Selecciona la firma:</label>
                        <select id="firmaSeleccionada">
                            <option value="8.png">Arq1 firma</option>
                            <option value="9.png">Arq2 firma</option>
                            <option value="10.png">Arq3 firma</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar Datos</button>
                        <button type="button" class="btn btn-secondary" id="generarPDF1">Generar PDF</button>
                    </div>
                </form>
            </div>

        
            <!-- Contenedor para el Certificado TIPO 2 -->
            <div class="container mt-4 d-none" id="formContainer2" aria-hidden="true">
                <h1 class="text-center">Datos del Certificado TIPO 2</h1>

                <!-- Formulario de Búsqueda de Certificado -->
                <form id="formBuscar2" method="POST" onsubmit="return buscarCertificado2(event)">
    <div class="mb-3">
        <label for="certificadoID2">Ingresa el ID del Certificado:</label>
        <input type="text" class="form-control" id="certificadoID2" name="certificadoID2" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-ter">Buscar</button>
    </div>
</form>

<script>
    function buscarCertificado2(event) {
        event.preventDefault();  // Previene el envío del formulario de búsqueda

        var certificadoID2 = document.getElementById('certificadoID2').value;

        // Verificar si el ID está vacío
        if (certificadoID2.trim() == "") {
            alert("Por favor ingresa un ID.");
            return;
        }

        // Realizar la petición AJAX para buscar los datos del certificado
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "buscar2.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        // Enviar el ID al archivo PHP para realizar la consulta
        xhr.send("certificadoID2=" + certificadoID2);

        xhr.onload = function() {
            if (xhr.status == 200) {
                // Si se encontró el certificado, llenar los campos
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById('solicitante2').value = response.solicitante;
                    document.getElementById('referencia2').value = response.referencia;
                    document.getElementById('contenido').value = response.contenido;
                    document.getElementById('nota').value = response.nota;
                    document.getElementById('fecha2').value = response.fecha;
                    document.getElementById('firmaSeleccionada2').value = response.firma;

                    // Mostrar el formulario de datos (si estaba oculto)
                    document.getElementById('formContainer2').classList.remove('d-none');
                } else {
                    alert(response.message);
                }
            }
        };
    }
</script>


                <form id="form2" method="POST" action="insertar2.php"> 
                    <div class="mb-3">
                        <label for="solicitante" class="form-label">Solicitante</label>
                        <input type="text" class="form-control" id="solicitante2" name="solicitante" required>
                    </div>
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input type="text" class="form-control" id="referencia2" name="referencia" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido</label>
                        <input type="text" class="form-control" id="contenido"  name="contenido" required>
                    </div>
                    <div class="mb-3">
                        <label for="nota" class="form-label">Nota</label>
                        <input type="text" class="form-control" id="nota" name="nota" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha (Día y Mes)</label>
                        <input type="text" class="form-control" id="fecha2" name="fecha"placeholder="Ejemplo: 26 diciembre" required>
                        <small class="form-text text-muted">Ingresa el día seguido del mes en texto (ejemplo: 26 diciembre).</small>
                    </div>
                    <div class="firma-selector-container">
                        <label for="firmaSeleccionada2">Selecciona la firma:</label>
                        <select id="firmaSeleccionada2">
                            <option value="8.png">Arq1 firma</option>
                            <option value="9.png">Arq2 firma</option>
                            <option value="10.png">Arq3 firma</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar Datos</button>
                        <button type="button" class="btn btn-secondary" id="generarPDF2">Generar PDF</button>
                    </div>
                </form>
            </div>



            <!-- Contenedor para el Certificado TIPO 3 -->
            <div class="container mt-4 d-none" id="formContainer3" aria-hidden="true">
                <h1 class="text-center">Datos del Certificado TIPO 3</h1>
                <form id="form3">
                    <div class="mb-3">
                        <label for="solicitante" class="form-label">Solicitante</label>
                        <input type="text" class="form-control" id="solicitante3" required>
                    </div>
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input type="text" class="form-control" id="referencia3" required>
                    </div>
                    <div class="mb-3">
                        <label for="denominacion1" class="form-label">Denominacion</label>
                        <input type="text" class="form-control" id="denominacion3" required>
                    </div>
                    <div class="mb-3">
                        <label for="Codigo" class="form-label">Codigo</label>
                        <input type="text" class="form-control" id="codigo3" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha (Día y Mes)</label>
                        <input type="text" class="form-control" id="fecha3" placeholder="Ejemplo: 26 diciembre" required>
                        <small class="form-text text-muted">Ingresa el día seguido del mes en texto (ejemplo: 26 diciembre).</small>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" id="generarPDF3">Generar PDF</button>
                    </div>
                </form>
            </div>

            <!-- Contenedor para el Certificado TIPO 4 -->
            <div class="container mt-4 d-none" id="formContainer4" aria-hidden="true">
                <h1 class="text-center">Datos del Certificado TIPO 4</h1>
                <form id="form4">
                    <div class="mb-3">
                        <label for="solicitante" class="form-label">Solicitante</label>
                        <input type="text" class="form-control" id="solicitante4" required>
                    </div>
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input type="text" class="form-control" id="referencia4" required>
                    </div>
                    <div class="mb-3">
                        <label for="denominacion1" class="form-label">Denominacion</label>
                        <input type="text" class="form-control" id="denominacion4" required>
                    </div>
                    <div class="mb-3">
                        <label for="Codigo" class="form-label">Codigo</label>
                        <input type="text" class="form-control" id="codigo4" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha (Día y Mes)</label>
                        <input type="text" class="form-control" id="fecha4" placeholder="Ejemplo: 26 diciembre" required>
                        <small class="form-text text-muted">Ingresa el día seguido del mes en texto (ejemplo: 26 diciembre).</small>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" id="generarPDF4">Generar PDF</button>
                    </div>
                </form>
            </div>

            <!-- Contenedor para el Certificado TIPO 5 -->
            <div class="container mt-4 d-none" id="formContainer5" aria-hidden="true">
                <h1 class="text-center">Datos del Certificado TIPO 5</h1>
                <form id="form5">
                    <div class="mb-3">
                        <label for="solicitante" class="form-label">Solicitante</label>
                        <input type="text" class="form-control" id="solicitante5" required>
                    </div>
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input type="text" class="form-control" id="referencia5" required>
                    </div>
                    <div class="mb-3">
                        <label for="sublote" class="form-label">Sublote</label>
                        <input type="text" class="form-control" id="sublote5" required>
                    </div>
                    <div class="mb-3">
                        <label for="denominacion1" class="form-label">Denominacion</label>
                        <input type="text" class="form-control" id="denominacion5" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo5" required>
                    </div>
                    <div class="mb-3">
                        <label for="numeroC" class="form-label">Numero Catastral</label>
                        <input type="text" class="form-control" id="catastral5" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha (Día y Mes)</label>
                        <input type="text" class="form-control" id="fecha5" placeholder="Ejemplo: 26 diciembre" required>
                        <small class="form-text text-muted">Ingresa el día seguido del mes en texto (ejemplo: 26 diciembre).</small>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" id="generarPDF5">Generar PDF</button>
                    </div>
                </form>
            </div>

            <!-- Contenedor para el Certificado TIPO 6 -->
            <div class="container mt-4 d-none" id="formContainer6" aria-hidden="true">
                <h1 class="text-center">Datos del Certificado TIPO 6</h1>
                <form id="form6">
                    <div class="mb-3">
                        <label for="solicitante" class="form-label">Solicitante</label>
                        <input type="text" class="form-control" id="solicitante6" required>
                    </div>
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input type="text" class="form-control" id="referencia6" required>
                    </div>
                    <div class="mb-3">
                        <label for="denominacion1" class="form-label">Denominacion</label>
                        <input type="text" class="form-control" id="denominacion6" required>
                    </div>
                    <div class="mb-3">
                        <label for="catastral6" class="form-label">Catastral</label>
                        <input type="text" class="form-control" id="catastral6" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo6" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo6" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha (Día y Mes)</label>
                        <input type="text" class="form-control" id="fecha6" placeholder="Ejemplo: 26 diciembre" required>
                        <small class="form-text text-muted">Ingresa el día seguido del mes en texto (ejemplo: 26 diciembre).</small>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" id="generarPDF6">Generar PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Botón de Salir en la parte inferior izquierda -->
    <button class="text-center btn btn-danger position-fixed bottom-0 start-0 m-3" id="btnSalir">Salir</button>

    <script>
        document.getElementById("btnSalir").addEventListener("click", function() {
            window.location.replace("http://localhost/loguin/"); // Cambia esto por la URL a la que quieres ir
        });
    </script>

    <script src="formulario.js"></script> <!-- Archivo para manejar el formulario -->
    <script src="ejemplo1.js"></script> <!-- Archivo para manejar la generación del PDF -->
    <script src="ejemplo2.js"></script>
    <script src="ejemplo3.js"></script>
    <script src="ejemplo4.js"></script>
    <script src="ejemplo5.js"></script>
    <script src="ejemplo6.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
