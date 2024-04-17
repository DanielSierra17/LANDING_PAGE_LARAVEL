<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('materialize/css/materialize.css') }}" rel="stylesheet" />
    <title>Document</title>
</head>

<body>

    <nav class="nav-wrapper teal accent-3">
        <a href="{{ route('descargar.excel') }}" class="waves-effect waves-light btn">Excel</a>
        <button onclick="mostrarGanador()" class="waves-effect waves-light btn">Mostrar Ganador</button>
    </nav>

    <div class="container">
        <h1>REGISTRO DE USUARIOS</h1>
        <form action="{{ route('guardar-datos') }}" method="post">
            @csrf
            <label>Nombres</label>
            <input type="text" name="nombres" id="nombres">
            <label>Apellidos</label>
            <input type="text" name="apellidos" id="apellidos">
            <label>Número de Cedula</label>
            <input type="number" name="cedula" id="cedula">
            <label>Departamento</label>
            <select id="departamentos" name="departamentos" class="browser-default">
                <option value="">Selecciona un departamento</option>
            </select>
            <label>Ciudad</label>
            <select id="ciudades" class="browser-default" name="ciudad">
                <option value="">Selecciona una ciudad</option>
            </select>
            <label>Celular</label>
            <input type="number" name="celular" id="celular">
            <label>Correo</label>
            <input type="email" name="correo" id="correo">
            <label>
                <input type="checkbox" class="filled-in" checked="checked" />
                <span>“Autorizo el tratamiento de mis datos de acuerdo con la
                    finalidad establecida en la política de protección de datos personales”</span>
            </label>
            <input class="waves-effect waves-light btn" type="submit" value="Enviar">
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var departamentos = [
                "Amazonas", "Antioquia", "Arauca", "Atlántico", "Bolívar", "Boyacá",
                "Caldas", "Caquetá", "Casanare", "Cauca", "Cesar", "Chocó", "Córdoba",
                "Cundinamarca", "Guainía", "Guaviare", "Huila", "La Guajira", "Magdalena",
                "Meta", "Nariño", "Norte de Santander", "Putumayo", "Quindío", "Risaralda",
                "San Andrés y Providencia", "Santander", "Sucre", "Tolima", "Valle del Cauca",
                "Vaupés", "Vichada"
            ];

            var ciudadesPorDepartamento = {
                "Amazonas": ["Leticia", "Puerto Nariño"],
                "Antioquia": ["Medellín", "Bello", "Envigado", "Itagüí", "Sabaneta", "Rionegro", "Apartadó",
                    "Turbo", "Caucasia"
                ],
                "Arauca": ["Arauca", "Saravena"],
                "Atlántico": ["Barranquilla", "Soledad", "Malambo", "Sabanalarga", "Puerto Colombia"],
                "Bolívar": ["Cartagena", "Magangué", "Soledad", "Malambo", "Sabanalarga"],
                "Boyacá": ["Tunja", "Duitama", "Sogamoso", "Chiquinquirá", "Puerto Boyacá", "Paipa"],
                "Caldas": ["Manizales", "Manzanares", "La Dorada", "Chinchiná", "Villamaría"],
                "Caquetá": ["Florencia", "San Vicente del Caguán", "Valparaíso", "Albania", "Morelia"],
                "Casanare": ["Yopal", "Tauramena", "Aguazul", "Villanueva", "Paz de Ariporo"],
                "Cauca": ["Popayán", "Santander de Quilichao", "Patía", "Piendamó", "Puerto Tejada"],
                "Cesar": ["Valledupar", "Aguachica", "Aguazul", "Villanueva", "Paz de Ariporo"],
                "Chocó": ["Quibdó", "Riosucio", "Nuquí", "Istmina", "Tadó"],
                "Córdoba": ["Montería", "Tierralta", "Cereté", "Lorica", "Sahagún"],
                "Cundinamarca": ["Bogotá", "Soacha", "Facatativá", "Girardot", "Zipaquirá", "Chía"],
                "Guainía": ["Inírida", "Barrancominas", "Mapiripana", "Cacahual"],
                "Guaviare": ["San José del Guaviare", "Calamar", "Miraflores", "Retorno"],
                "Huila": ["Neiva", "Pitalito", "Garzón", "La Plata", "Campoalegre"],
                "La Guajira": ["Riohacha", "Maicao", "Uribia", "Fonseca", "Manaure"],
                "Magdalena": ["Santa Marta", "Ciénaga", "Fundación", "El Banco", "Aracataca"],
                "Meta": ["Villavicencio", "Acacías", "Granada", "San Martín", "Puerto López"],
                "Nariño": ["Pasto", "Tumaco", "Ipiales", "Túquerres", "Samaniego"],
                "Norte de Santander": ["Cúcuta", "Ocaña", "Pamplona", "Villa del Rosario", "Los Patios"],
                "Putumayo": ["Mocoa", "Puerto Asís", "Orito", "Colón", "Sibundoy"],
                "Quindío": ["Armenia", "Calarcá", "Quimbaya", "Circasia", "Montenegro"],
                "Risaralda": ["Pereira", "Dosquebradas", "Santa Rosa de Cabal", "La Virginia", "Santuario"],
                "San Andrés y Providencia": ["San Andrés", "Providencia", "Santa Catalina"],
                "Santander": ["Bucaramanga", "Floridablanca", "Girón", "Piedecuesta", "Barrancabermeja"],
                "Sucre": ["Sincelejo", "Corozal", "Santiago de Tolú", "San Marcos", "Coveñas"],
                "Tolima": ["Ibagué", "Espinal", "Mariquita", "Chaparral", "Líbano"],
                "Valle del Cauca": ["Cali", "Buenaventura", "Palmira", "Tuluá", "Yumbo"],
                "Vaupés": ["Mitú", "Carurú", "Pacoa", "Taraira"],
                "Vichada": ["Puerto Carreño", "Cumaribo", "La Primavera", "Santa Rosalía"]
            };


            var selectDepartamentos = document.getElementById("departamentos");
            var selectCiudades = document.getElementById("ciudades");

            // Llenar el select de departamentos
            departamentos.forEach(function(departamento) {
                var option = document.createElement("option");
                option.text = departamento;
                option.value = departamento;
                selectDepartamentos.appendChild(option);
            });

            // Función para llenar el select de ciudades según el departamento seleccionado
            function llenarCiudades() {
                var departamentoSeleccionado = selectDepartamentos.value;
                var ciudades = ciudadesPorDepartamento[departamentoSeleccionado] || [];

                // Limpiar opciones anteriores
                selectCiudades.innerHTML = "";

                // Llenar el select de ciudades con las ciudades del departamento seleccionado
                ciudades.forEach(function(ciudad) {
                    var option = document.createElement("option");
                    option.text = ciudad;
                    option.value = ciudad;
                    selectCiudades.appendChild(option);
                });
            }

            // Evento change para el select de departamentos
            selectDepartamentos.addEventListener("change", llenarCiudades);
        });


        function mostrarGanador() {
            // Realizar una solicitud AJAX para obtener los datos del ganador
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '{{ route('ganador') }}', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var ganador = JSON.parse(xhr.responseText);
                    // Mostrar los nombres y apellidos del ganador en un alert
                    Swal.fire('Los datos del ganador del sorteo son:\n' + ganador.id + '\n' + ganador.nombres + '\n' + ganador.apellidos + '\n' + ganador.cedula + '\n' + ganador.departamentos + '\n' + ganador.ciudad + '\n' + ganador.celular + '\n' + ganador.correo);
                }
            };
            xhr.send();
        }
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = '{{ session('success') }}';
        if (successMessage) {
            Swal.fire(successMessage);
        }
    });
</script>

</body>

</html>
