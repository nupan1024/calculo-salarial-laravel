<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="bi bi-person"></i> Información del Cliente</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>ID:</strong>
                            </div>
                            <div class="col-sm-9">
                                {{ $cliente->cliente }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>Nombre:</strong>
                            </div>
                            <div class="col-sm-9">
                                {{ $cliente->nombre_cliente }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>Dirección:</strong>
                            </div>
                            <div class="col-sm-9">
                                {{ $cliente->direccion }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>Fecha de Creación:</strong>
                            </div>
                            <div class="col-sm-9">
                                {{ $cliente->created_at->format('d/m/Y H:i:s') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>Última Actualización:</strong>
                            </div>
                            <div class="col-sm-9">
                                {{ $cliente->updated_at->format('d/m/Y H:i:s') }}
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/admin/clientes" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Volver a la Lista
                            </a>
                            <div>
                                <a href="/admin/clientes/{{ $cliente->cliente }}/edit" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="/admin/clientes/{{ $cliente->cliente }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
