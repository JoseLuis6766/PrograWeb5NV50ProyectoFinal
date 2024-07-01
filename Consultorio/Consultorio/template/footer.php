</body>
<script>
    const base_url ="<?= BASE_URL ?>";
</script>
<script type="text/javascript">
    function verificarCarnet() {
        var iconoResultado = document.getElementById("iconoResultado");
        var carnet = $("#carnet").val();
        var data = {carnet : carnet}; // se tiene una variable json y se agrega lo que le vas a mandar, el nombre y el valor 

        if(carnet == "") {
            //console.log("Vacio");
            $("#iconoResultado").html('');
        } else {
            $.ajax({
            url:"../libs/verificar.php",
            type: "POST",
            data: data, //Los datos que se van a enviar por el post en este caso documento
            success: function(response) {
                    if(response.trim() == "1") {
                        //console.log("ya existe");
                        $("#iconoResultado").html('<i class="fa-sharp fa-solid fa-xmark"></i>');
                    } else if(response.trim() == "0") {
                        //console.log("no existe");
                        $("#iconoResultado").html('<i class="fa-solid fa-check"></i>');
                    }
                }
            });
        }
    }
</script>
</html>