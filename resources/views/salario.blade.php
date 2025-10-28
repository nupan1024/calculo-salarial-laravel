<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculo Salarial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .resultado {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-top: 1rem;
        }
        .mensaje-salario {
            font-size: 1.1rem;
            font-weight: 500;
            color: #198754;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Calculo Salarial</h3>
                    </div>
                    <div class="card-body">
                        <form id="salarioForm">
                            <div class="mb-3">
                                <label for="cliente_id" class="form-label">Seleccionar Cliente</label>
                                <select class="form-select" id="cliente_id" name="cliente_id" required>
                                    <option value="">-- Seleccione un cliente --</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="horas" class="form-label">Horas trabajadas</label>
                                <input type="number" class="form-control" id="horas" name="horas" min="0" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Calcular Salario</button>
                            </div>
                        </form>

                        <div id="resultado" class="resultado" style="display: none;">
                            <h5>Resultado:</h5>
                            <div id="mensaje" class="mensaje-salario"></div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <strong>Cliente:</strong> <span id="cliente-nombre"></span><br>
                                    <strong>Horas trabajadas:</strong> <span id="horas-trabajadas"></span><br>
                                    <strong>Salario total:</strong> $<span id="salario-total"></span> pesos
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Información del Sistema</h5>
                        <a href="/admin/clientes" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-people"></i> Gestionar Clientes
                        </a>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>Tarifa normal:</strong> $25,000 pesos por hora (hasta 48 horas)</li>
                            <li><strong>Tarifa extra:</strong> $35,000 pesos por hora (más de 48 horas)</li>
                        </ul>
                        <div class="alert alert-info">
                            <strong>Ejemplo:</strong> Si un empleado trabaja 47 horas, su salario será: 47 × $25,000 = $1,175,000 pesos
                        </div>
                        <div class="alert alert-warning">
                            <strong>Nota:</strong> Primero debes crear clientes para poder calcular salarios.
                            <a href="/admin/clientes/create" class="alert-link">Crear cliente aquí</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cargar clientes al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            cargarClientes();
        });

        function cargarClientes() {
            fetch('/api/clientes')
                .then(response => response.json())
                .then(clientes => {
                    const select = document.getElementById('cliente_id');
                    select.innerHTML = '<option value="">-- Seleccione un cliente --</option>';

                    clientes.forEach(cliente => {
                        const option = document.createElement('option');
                        option.value = cliente.cliente;
                        option.textContent = cliente.nombre_cliente;
                        select.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar clientes:', error);
                });
        }

        document.getElementById('salarioForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const data = {
                cliente_id: parseInt(formData.get('cliente_id')),
                horas: parseInt(formData.get('horas'))
            };

            fetch('/salario/calcular', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('mensaje').textContent = data.mensaje;
                document.getElementById('cliente-nombre').textContent = data.nombre_empleado;
                document.getElementById('horas-trabajadas').textContent = data.horas_trabajadas;
                document.getElementById('salario-total').textContent = new Intl.NumberFormat('es-CO').format(data.salario);
                document.getElementById('resultado').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al calcular el salario');
            });
        });
    </script>
</body>
</html>
