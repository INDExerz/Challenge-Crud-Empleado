let tabla;

$(document).ready(function(){
    tabla = $("#tabla").DataTable({
        language: {
						"url": "js/datatablesSpanish.json"
					},
        ajax:{
            url:"../controllers/UsuarioController.php",
            type:"POST",
            data:{action:"listar"},
            dataSrc:""
        },
        columns:[
            {data:"nombre"},
            {data:"email"},
            {data:"sexo", render: (data) => data === 'M' ? 'Masculino' : 'Femenino'},
            {data:"area_nombre"},
            {data:"boletin", render: (data) => data == 1 ? 'Sí' : 'No'},
            {
                data:null,
                render:(d)=>`<button class="btn btn-warning btn-sm" onclick="editar(${d.id})"><i class="bi bi-pencil-square"></i></button>`
            },
            {
                data:null,
                render:(d)=>`<button class="btn btn-danger btn-sm" onclick="eliminar(${d.id})"><i class="bi bi-trash-fill"></i></button>`
            }
        ]
    });
});

function nuevo(){
    $("#form")[0].reset();
    $("#modalTitle").text("Crear Empleado");
    
    Promise.all([ObtenerAreas(), ObtenerRoles()]).then(([areas, roles]) => {
        // Cargar áreas
        let selectArea = $("select[name=area]");
        selectArea.empty();
        selectArea.append('<option value="">Selecciona un área</option>');
        
        areas.forEach((area) => {
            selectArea.append(`<option value="${area.id}">${area.nombre}</option>`);
        });
        
        // Cargar roles como checkboxes
        let rolesContainer = $("#rolesContainer");
        rolesContainer.empty();
        
        roles.forEach((role, index) => {
            rolesContainer.append(`
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="${role.id}" id="rol${index}">
                    <label class="form-check-label" for="rol${index}">
                        ${role.nombre}
                    </label>
                </div>
            `);
        });
        
        var myModal = new bootstrap.Modal(
            document.getElementById('modal'),
            {
                backdrop: 'static',
                keyboard: false
            }
        );

        myModal.show();
    }).catch(() => {
        alert('Error al cargar áreas o roles');
    });
}

function Validaciones(){
    // Limpiar errores previos
    $(".is-invalid").removeClass("is-invalid");
    $("#alertContainer").empty();

    let isValid = true;
    let errors = [];

    // Validar nombre
    let nombre = $("input[name=nombre]").val().trim();
    let nombreRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (!nombre || !nombreRegex.test(nombre)) {
        isValid = false;
        errors.push("El nombre solo debe contener letras y espacios.");
        $("input[name=nombre]").addClass("is-invalid");
    }

    // Validar correo
    let correo = $("input[name=correo]").val().trim();
    let correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correo || !correoRegex.test(correo)) {
        isValid = false;
        errors.push("El correo debe tener un formato válido.");
        $("input[name=correo]").addClass("is-invalid");
    }

    // Validar sexo
    let sexo = $("input[name=sexo]:checked").val();
    if (!sexo || (sexo !== "M" && sexo !== "F")) {
        isValid = false;
        errors.push("Debe seleccionar Masculino o Femenino.");
        // Resaltar los radios
        $("input[name=sexo]").closest(".col-6").addClass("is-invalid");
    }

    // Validar área
    let area = $("select[name=area]").val();
    if (!area) {
        isValid = false;
        errors.push("Debe seleccionar un área.");
        $("select[name=area]").addClass("is-invalid");
    }

    // Validar descripción
    let descripcion = $("textarea[name=descripcion]").val().trim();
    if (!descripcion) {
        isValid = false;
        errors.push("La descripción es obligatoria.");
        $("textarea[name=descripcion]").addClass("is-invalid");
    }

    // Validar roles
    let rolesSeleccionados = $("input[name='roles[]']:checked");
    if (rolesSeleccionados.length === 0) {
        isValid = false;
        errors.push("Debe seleccionar al menos un rol.");
        $("#rolesContainer").addClass("is-invalid");
    }

    if (!isValid) {
        // Mostrar alert de error
        let alertHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<strong>Errores de validación:</strong><ul>';
        errors.forEach(error => {
            alertHtml += '<li>' + error + '</li>';
        });
        alertHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
        $("#alertContainer").html(alertHtml);
        return;
    }
}

function guardar(){
    Validaciones();
    let data = $("#form").serializeArray();
    let action = $("input[name=id]").val() ? "actualizar":"crear";
    data.push({name:"action", value:action});

    $.post("../controllers/UsuarioController.php", data, function(){
        $("#modal").modal("hide");
        tabla.ajax.reload();
        if(action == "crear"){
            Swal.fire(
                'Guardado!',
                'El empleado ha sido creado.',
                'success'
            );
        } else if(action == "actualizar"){
            Swal.fire(
                'Actualizado!',
                'El empleado ha sido actualizado.',
                'success'
            );
        }
    });
}

function editar(id){
    $("#form")[0].reset();
    $("#modalTitle").text("Editar Empleado");
    
    Promise.all([ObtenerAreas(), ObtenerRoles()]).then(([areas, roles]) => {
        // Cargar áreas
        let selectArea = $("select[name=area]");
        selectArea.empty();
        selectArea.append('<option value="">Selecciona un área</option>');
        
        areas.forEach((area) => {
            selectArea.append(`<option value="${area.id}">${area.nombre}</option>`);
        });
        
        // Cargar roles como checkboxes
        let rolesContainer = $("#rolesContainer");
        rolesContainer.empty();
        
        roles.forEach((role, index) => {
            rolesContainer.append(`
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="${role.id}" id="rol${index}">
                    <label class="form-check-label" for="rol${index}">
                        ${role.nombre}
                    </label>
                </div>
            `);
        });
        
        // Obtener datos del empleado
        $.post("../controllers/UsuarioController.php", {action:"obtener", id}, function(res){
            let d = JSON.parse(res);

            $("input[name=id]").val(d.id);
            $("input[name=nombre]").val(d.nombre);
            $("input[name=correo]").val(d.email);
            $("input[name=sexo][value='" + d.sexo + "']").prop("checked", true);
            $("select[name=area]").val(d.area_id);
            $("textarea[name=descripcion]").val(d.descripcion);
            if(d.boletin == 1){
                $("#boltin").prop("checked", true);
            }

            // Marcar roles
            d.roles.forEach(rol_id => {
                $("input[name='roles[]'][value='" + rol_id + "']").prop("checked", true);
            });

            $("#modal").modal("show");
        });
    }).catch(() => {
        alert('Error al cargar áreas o roles');
    });
}

function eliminar(id){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../controllers/UsuarioController.php", {action:"eliminar", id}, function(){
                tabla.ajax.reload();
                Swal.fire(
                    'Eliminado!',
                    'El empleado ha sido eliminado.',
                    'success'
                );
            });
        }
    });
}