@extends('layouts/template')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Lista de Productos</h2>

    <!-- Botón Agregar y Buscar -->
    <div class="d-flex justify-content-between mb-3">
        <div class="input-group w-25">
            <input type="text" id="buscar" class="form-control" placeholder="Buscar..." autocomplete="off">
            <button type="button" id="clearInput" class="btn btn-light">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fa fa-plus" aria-hidden="true"></i> Productos
        </button>
    </div>

    <!-- Tabla de Productos -->
    <table class="table table-striped table-bordered" id="productosTable">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($productos as $producto)
    <tr>
        <td>{{ $productos->nombre }}</td>
        <td>{{ $productos->categoria }}</td>
        <td>{{ $productos->cantidad }}</td>
        <td>{{ $productos->precio }}</td>
        <td>
        </td>
</td>
        <td>
            <button class="btn btn-primary btn-edit" data-id="{{ $producto->id }}">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i> Editar
            </button>
            <button class="btn btn-danger btn-delete" data-id="{{ $producto->id }}">
                    <i class="fa fa-trash" aria-hidden="true"></i> Eliminar
                    </button>
        </td>
    </tr>
    @endforeach
</tbody>

    </table>
</div>

<!-- Modal para Agregar Mascota -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Adoptar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <input type="text" class="form-control" name="categoria" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad">
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="decimal" class="form-control" name="precio">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal para Editar la Adopción -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEdit" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Adopción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId">
                    <div class="mb-3">
                        <label for="editNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editNombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoria" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="editCategoria" name="categoria" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="editCantidad" name="cantidad">
                    </div>
                    <div class="mb-3">
                        <label for="editPrecio" class="form-label">Precio</label>
                        <input type="decimal" class="form-control" id="editPrecio" name="precio">
                    </div>
</div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este Producto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" action="" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.btn-edit');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                fetch(`/productos/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editId').value = data.id;
                        document.getElementById('editNombre').value = data.nombre;
                        document.getElementById('editCategoria').value = data.categoria;
                        document.getElementById('editcCantidad').value = data.cantidad;
                        document.getElementById('editPrecio').value = data.precio;
                        document.getElementById('formEdit').action = `/productos/${data.id}`;
                        new bootstrap.Modal(document.getElementById('editModal')).show();
                    });
            });
        });


        // Búsqueda de productos
        const inputBuscar = document.getElementById('buscar');
        const clearInputBtn = document.getElementById('clearInput');

        inputBuscar.addEventListener('input', function () {
            let query = this.value;
            fetch(`/productos/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    updateTable(data.productos);
                })
                .catch(error => console.error('Error al buscar:', error));
        });

        clearInputBtn.addEventListener('click', function () {
            inputBuscar.value = '';
            inputBuscar.dispatchEvent(new Event('input'));
        });

        // Actualizar la tabla con los resultados de la búsqueda
        function updateTable(productos) {
            const tableBody = document.querySelector('#productosTable tbody');
            tableBody.innerHTML = '';

            productos.forEach(producto => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${producto.nombre}</td>
                    <td>${producto.categoria}</td>
                    <td>${producto.cantidad}</td>
                    <td>${producto.precio}</td>

                    <td>
                        <button class="btn btn-primary btn-edit" data-id="${producto.id}">
                            <i class="fa fa-pencil-alt"></i> Editar
                        </button>
                        <button class="btn btn-danger btn-delete" data-id="${producto.id}">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
            const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
                const id = this.dataset.id;
                fetch(`/productos/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editId').value = data.id;
                        document.getElementById('editNombre').value = data.nombre;
                        document.getElementById('editEspecie').value = data.especie;
                        document.getElementById('editRaza').value = data.raza;
                        document.getElementById('editEdad').value = data.edad;
                        document.getElementById('editPeso').value = data.peso;
                        document.getElementById('editEstado').value = data.estado;

                        document.getElementById('formEdit').action = `/producto/${data.id}`;
                        new bootstrap.Modal(document.getElementById('editModal')).show();
                    });
        });
    });
            const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const form = document.getElementById('deleteForm');
                form.action = `/adopciones/${id}`;
                new bootstrap.Modal(document.getElementById('confirmDeleteModal')).show();
            });
        });


        }
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const form = document.getElementById('deleteForm');
                form.action = `/adopciones/${id}`;
                new bootstrap.Modal(document.getElementById('confirmDeleteModal')).show();
            });
        });

    });
</script>


</body>
</html>
@endsection
