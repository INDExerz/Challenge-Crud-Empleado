function ObtenerAreas(){
    return $.ajax({
        url:"../controllers/AreasController.php",
        type:"POST",
        dataType: "json",
        data:{action:"listar"}
    });
}