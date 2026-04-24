<!DOCTYPE html>
<html>
<head>
    <title>CRUD empleados</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="container mt-4">

<h2>Empleados</h2>

<button class="btn btn-primary mb-3" onclick="nuevo()">Nuevo</button>

<table id="tabla" class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Sexo</th>
            <th>Area</th>
            <th>Boletin</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
</table>

<!-- MODAL -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 80%;">
        <div class="modal-content">

            <div class="text-center modal-header">
				<h3 class="w-100 modal-title" id="modalTitle">Crear Empleado</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

            <div class="modal-header">
                <div class="p-3 mb-2 bg-info text-dark rounded-1">Los campos con asteriscos (*) son obligatorios</div>
                <div id="alertContainer"></div>
            </div>

            <div class="modal-body">
                <form id="form">

                <input type="hidden" name="id">

                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <label>Nombre Completo *</label>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control mb-2" name="nombre" required>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <label>Correo electronico*</label>
                        </div>
                        <div class="col-6">
                            <input type="email" class="form-control mb-2" name="correo" required>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <label>Sexo *</label>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="M">
                                <label class="form-check-label" for="sexo1">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="F">
                                <label class="form-check-label" for="sexo2">
                                    Femenino
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <label>Area *</label>
                        </div>
                        <div class="col-6">
                            <select class="form-control mb-2" name="area" id="area" required>
                                <option value="">Selecciona un área</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <label>Descripcion *</label>
                        </div>
                        <div class="col-6">
                            <textarea class="form-control mb-2" name="descripcion" id="descripcion" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="boltin">
                                <label class="form-check-label" for="boltin">
                                    Deseo recibir boletín informativo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-2">
                            <label>Roles *</label>
                        </div>
                        <div class="col-6" id="rolesContainer">
                            <!-- Los roles se cargarán dinámicamente aquí -->
                        </div>
                    </div>
                </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="guardar()">Guardar</button>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="js/empleados.js"></script>
<script src="js/areas.js"></script>
<script src="js/roles.js"></script>

</body>
</html>