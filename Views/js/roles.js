function ObtenerRoles(){
    return $.ajax({
        url:"../controllers/RolesController.php",
        type:"POST",
        dataType: "json",
        data:{action:"listar"}
    });
}