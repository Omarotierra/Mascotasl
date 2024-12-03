@extends('layouts/template')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopcion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Lista de Adopciones</h2>

    <!-- Botón Agregar y Buscar -->
    <div class="d-flex justify-content-between mb-3">
        <div class="input-group w-25">
            <input type="text" id="buscar" class="form-control" placeholder="Buscar..." autocomplete="off">
            <button type="button" id="clearInput" class="btn btn-light">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fa fa-plus" aria-hidden="true"></i> Adoptar
        </button>
    </div>

    <!-- Tabla de Adopciones -->
    <table class="table table-striped table-bordered" id="adopcionesTable">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Raza</th>
                <th>Edad</th>
                <th>Peso</th>
                <th>Estado</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($adopciones as $adopcion)
    <tr>
        <td>{{ $adopcion->nombre }}</td>
        <td>{{ $adopcion->especie }}</td>
        <td>{{ $adopcion->raza }}</td>
        <td>{{ $adopcion->edad }}</td>
        <td>{{ $adopcion->peso }}</td>
        <td>{{ $adopcion->estado }}</td>
        <td>
        @if ($adopcion->imagen)
    <img src="{{ asset('storage/' . $adopcion->imagen) }}" style="width: 50px; height: auto;">
@else
    <p>No disponible</p>
@endif

        </td>
</td>
        <td>
            <button class="btn btn-primary btn-edit" data-id="{{ $adopcion->id }}">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i> Editar
            </button>
            <button class="btn btn-danger btn-delete" data-id="{{ $adopcion->id }}">
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
            <form action="{{ route('adopciones.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="especie" class="form-label">Especie</label>
                        <input type="text" class="form-control" name="especie" required>
                    </div>
                    <div class="mb-3">
                        <label for="raza" class="form-label">Raza</label>
                        <input type="text" class="form-control" name="raza">
                    </div>
                    <div class="mb-3">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" class="form-control" name="edad">
                    </div>
                    <div class="mb-3">
                        <label for="peso" class="form-label">Peso</label>
                        <input type="decimal" class="form-control" name="peso">
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" name="estado" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen del animal a Adoptar</label>
                        <input type="file" class="form-control" name="imagen" accept="image/*">
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
                        <label for="editEspecie" class="form-label">Especie</label>
                        <input type="text" class="form-control" id="editEspecie" name="especie" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRaza" class="form-label">Raza</label>
                        <input type="text" class="form-control" id="editRaza" name="raza">
                    </div>
                    <div class="mb-3">
                        <label for="editEdad" class="form-label">Edad</label>
                        <input type="number" class="form-control" id="editEdad" name="edad">
                    </div>
                    <div class="mb-3">
                        <label for="editPeso" class="form-label">Peso</label>
                        <input type="decimal" class="form-control" id="editPeso" name="peso">
                    </div>
                    <div class="mb-3">
                        <label for="editNombreDueño" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="editEstado" name="estado" required>
                    </div>
                    <div class="mb-3">
    <label for="editImagen" class="form-label">Imagen Actual</label>
    <div id="currentImage">   
    @if ($adopcion->imagen)
            <img src="{{ asset('storage/' . $adopcion->imagen) }}" style="width: 50px; height: auto;">
        @else
            <p>No disponible</p>
        @endif
    </div>
</div>

<div class="mb-3">
    <label for="imagen" class="form-label">Cambiar Imagen</label>
    <input type="file" class="form-control" name="imagen" accept="image/*">
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
                ¿Estás seguro de que deseas eliminar esta Adopcion?
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
                fetch(`/adopciones/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editId').value = data.id;
                        document.getElementById('editNombre').value = data.nombre;
                        document.getElementById('editEspecie').value = data.especie;
                        document.getElementById('editRaza').value = data.raza;
                        document.getElementById('editEdad').value = data.edad;
                        document.getElementById('editPeso').value = data.peso;
                        document.getElementById('editEstado').value = data.estado;
                        if (data.imagen) {
                        document.getElementById('currentImage').innerHTML = `<img src="{{ asset('storage/') }}/${data.imagen}" style="width: 50px; height: auto;">`;
                    } else {
                        document.getElementById('currentImage').innerHTML = '<p>No disponible</p>';
                    }
                        document.getElementById('formEdit').action = `/adopciones/${data.id}`;
                        new bootstrap.Modal(document.getElementById('editModal')).show();
                    });
            });
        });


        // Búsqueda de adopcioness
        const inputBuscar = document.getElementById('buscar');
        const clearInputBtn = document.getElementById('clearInput');

        inputBuscar.addEventListener('input', function () {
            let query = this.value;
            fetch(`/adopciones/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    updateTable(data.adopciones);
                })
                .catch(error => console.error('Error al buscar:', error));
        });

        clearInputBtn.addEventListener('click', function () {
            inputBuscar.value = '';
            inputBuscar.dispatchEvent(new Event('input'));
        });

        // Actualizar la tabla con los resultados de la búsqueda
        function updateTable(adopciones) {
            const tableBody = document.querySelector('#adopcionesTable tbody');
            tableBody.innerHTML = '';

            adopciones.forEach(adopcion => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${adopcion.nombre}</td>
                    <td>${adopcion.especie}</td>
                    <td>${adopcion.raza}</td>
                    <td>${adopcion.edad}</td>
                    <td>${adopcion.peso}</td>
                    <td>${adopcion.nombre_dueño}</td>
                    <td>${adopcion.telefono}</td>
                    <td>
                    @if ($adopcion->imagen)
                            <img src="{{ asset('storage/') }}/${adopcion.imagen}" style="width: 50px; height: auto;">
        @else
            <p>No disponible</p>
        @endif
            </td>
                    <td>
                        <button class="btn btn-primary btn-edit" data-id="${adopcion.id}">
                            <i class="fa fa-pencil-alt"></i> Editar
                        </button>
                        <button class="btn btn-danger btn-delete" data-id="${adopcion.id}">
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
                fetch(`/adopciones/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editId').value = data.id;
                        document.getElementById('editNombre').value = data.nombre;
                        document.getElementById('editEspecie').value = data.especie;
                        document.getElementById('editRaza').value = data.raza;
                        document.getElementById('editEdad').value = data.edad;
                        document.getElementById('editPeso').value = data.peso;
                        document.getElementById('editEstado').value = data.estado;
                        if (data.imagen) {
                        document.getElementById('currentImage').innerHTML = `<img src="{{ asset('storage/') }}/${data.imagen}" style="width: 50px; height: auto;">`;
                    } else {
                        document.getElementById('currentImage').innerHTML = '<p>No disponible</p>';
                    }
                        document.getElementById('formEdit').action = `/adopciones/${data.id}`;
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
