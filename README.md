# Calculo Salarial - Laravel 12 + MySQL

Sistema web para cálculo de salarios con arquitectura MVC, desarrollado en Laravel 12 y MySQL.

## 🚀 Características

- **Cálculo de Salario**: 25,000 pesos/hora hasta 48h, 35,000 pesos/hora extras
- **CRUD Completo**: Gestión de clientes, productos y facturas
- **API REST**: Endpoints para integración con frontend
- **Interfaz Web**: Formulario interactivo para cálculo de salarios
- **Base de Datos**: MySQL con relaciones y restricciones

## 📋 Requisitos

- PHP 8.2+
- Composer
- MySQL 5.7+ o 8.x
- Node.js (opcional, para assets)

## 🛠️ Instalación

### 1. Clonar el proyecto
```bash
git clone https://github.com/nupan1024/calculo-salarial-laravel.git
cd calculo-salarial-laravel
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Configurar base de datos
```bash
# Copiar archivo de configuración
cp .env.example .env

# Editar .env con tus credenciales de MySQL
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=calculo_salarial
DB_USERNAME=usuario_cs
DB_PASSWORD=123456
```

### 4. Generar clave de aplicación
```bash
php artisan key:generate
```

### 5. Ejecutar migraciones
```bash
php artisan migrate
```

### 6. Poblar base de datos con datos de ejemplo
```bash
php artisan db:seed
```

### 7. Iniciar servidor
```bash
php artisan serve
```

El servidor estará disponible en: `http://localhost:8000`

## 📖 Uso

### Interfaz Web
- Acceder a: `http://localhost:8000`
- Ingresar nombre del empleado y horas trabajadas
- Click en "Calcular Salario" para ver el resultado

### API Endpoints

#### Cálculo de Salario
```http
POST /api/salario/calcular
Content-Type: application/json

{
    "nombre": "Juan Gómez",
    "horas": 47
}
```

**Respuesta:**
```json
{
    "nombre_empleado": "Juan Gómez",
    "horas_trabajadas": 47,
    "salario": 1175000,
    "mensaje": "Al Empleado Juan Gómez se le debe pagar la suma de 1.175.000 pesos."
}
```

#### CRUD Clientes
```http
GET    /api/clientes          # Listar clientes
POST   /api/clientes          # Crear cliente
GET    /api/clientes/{id}     # Ver cliente
PUT    /api/clientes/{id}     # Actualizar cliente
DELETE /api/clientes/{id}     # Eliminar cliente
```

#### CRUD Productos
```http
GET    /api/productos         # Listar productos
POST   /api/productos         # Crear producto
GET    /api/productos/{id}    # Ver producto
PUT    /api/productos/{id}    # Actualizar producto
DELETE /api/productos/{id}    # Eliminar producto
```

#### Consulta Facturas
```http
GET /api/facturas            # Listar facturas
GET /api/facturas/{id}       # Ver factura con detalles
```

## 🗄️ Estructura de Base de Datos

### Tablas
- **clientes**: Información de clientes
- **productos**: Catálogo de productos
- **cabeza_factura**: Cabeceras de facturación
- **detalle_factura**: Líneas de detalle de facturas

### Relaciones
- Un cliente puede tener múltiples facturas
- Una factura puede tener múltiples detalles
- Un producto puede estar en múltiples detalles

## 🧮 Lógica de Cálculo Salarial

```php
// Tarifas
$tarifaNormal = 25000;  // hasta 48 horas
$tarifaExtra = 35000;   // más de 48 horas

// Cálculo
if ($horas <= 48) {
    $salario = $horas * $tarifaNormal;
} else {
    $salario = (48 * $tarifaNormal) + (($horas - 48) * $tarifaExtra);
}
```

## 📁 Estructura del Proyecto

```
calculo-salarial-laravel/
├── app/
│   ├── Http/Controllers/     # Controladores
│   │   ├── SalarioController.php
│   │   ├── ClienteController.php
│   │   ├── ProductoController.php
│   │   └── FacturaController.php
│   └── Models/               # Modelos Eloquent
│       ├── Cliente.php
│       ├── Producto.php
│       ├── CabezaFactura.php
│       └── DetalleFactura.php
├── database/
│   └── migrations/           # Migraciones de BD
├── resources/
│   └── views/
│       └── salario.blade.php # Vista principal
├── routes/
│   ├── api.php              # Rutas API
│   └── web.php              # Rutas web
└── README.md
```

## 🧪 Ejemplos de Uso

### Datos de Ejemplo Incluidos
El seeder crea 5 clientes usando el factory con datos aleatorios:
- Nombres generados automáticamente
- Direcciones realistas de diferentes ciudades colombianas
- Datos únicos en cada ejecución del seeder

### Ejemplo 1: Empleado con 47 horas
- **Cliente**: [Cualquier cliente del select], Horas=47
- **Resultado**: 47 × 25,000 = 1,175,000 pesos
- **Mensaje**: "Al Empleado [Nombre] se le debe pagar la suma de 1.175.000 pesos."

### Ejemplo 2: Empleado con 50 horas
- **Cliente**: [Cualquier cliente del select], Horas=50
- **Cálculo**: (48 × 25,000) + (2 × 35,000) = 1,200,000 + 70,000 = 1,270,000
- **Resultado**: 1,270,000 pesos

## 🔧 Desarrollo

### Comandos útiles
```bash
# Ejecutar migraciones
php artisan migrate

# Revertir migraciones
php artisan migrate:rollback

# Poblar base de datos con datos de ejemplo
php artisan db:seed

# Ejecutar migraciones y seeders en un solo comando
php artisan migrate --seed

# Crear clientes usando el factory (para testing)
php artisan tinker
>>> App\Models\Cliente::factory(10)->create()

# Limpiar cache
php artisan cache:clear
php artisan config:clear

# Ver rutas
php artisan route:list
```

### Testing
```bash
# Ejecutar tests (si los hay)
php artisan test
```

## 📝 Notas

- El sistema usa validación de datos en todos los endpoints
- Las respuestas de la API están en formato JSON
- La interfaz web es responsive y usa Bootstrap 5
- Las migraciones incluyen restricciones de integridad referencial

