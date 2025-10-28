<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-people"></i> Gestión de Clientes</h2>
                    <div>
                        <a href="/salario" class="btn btn-outline-primary me-2">
                            <i class="bi bi-calculator"></i> Cálculo Salarial
                        </a>
                        <a href="/admin/clientes/create" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nuevo Cliente
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($clientes->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Dirección</th>
                                            <th>Fecha Creación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clientes as $cliente)
                                            <tr>
                                                <td>{{ $cliente->cliente }}</td>
                                                <td>{{ $cliente->nombre_cliente }}</td>
                                                <td>{{ $cliente->direccion }}</td>
                                                <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="/admin/clientes/{{ $cliente->cliente }}" class="btn btn-sm btn-outline-info">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="/admin/clientes/{{ $cliente->cliente }}/edit" class="btn btn-sm btn-outline-warning">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="/admin/clientes/{{ $cliente->cliente }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-people display-1 text-muted"></i>
                            <h4 class="mt-3">No hay clientes registrados</h4>
                            <p class="text-muted">Comienza agregando tu primer cliente</p>
                            <a href="/admin/clientes/create" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Crear Primer Cliente
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
