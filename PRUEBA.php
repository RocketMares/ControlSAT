<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PRUEBA RFC CORTO</title>
  </head>
  <body>
<div class="container-fluid">
<button class="btn btn-danger" id="descarga" type="submit" >Descarga</button>
<button class="btn btn-danger" id="manda_responsiva" type="submit" >resp</button>
</div>
<?php
switch (ISSET($_GET['caso'])) {
    case 1:
        
    echo"<script>
 alert('no hay nada')
    </script>
<!--     <div class='alert alert-danger' role='alert'>
    No tiene documento
   </div>-->";
    break;
    
    default:
    echo"";
        break;
}

?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        $('#mandar').on('click',function(){
           var datos = $('#RFC_COMP').val();
            $.ajax({
                type:'POST',
                dataType: 'html',
                url:"algoritmo.php",
                data:{RFC:datos},
              
            }).done(function(respuesta){
                $('#RFC_CORTO').html(respuesta);
            })
        })
        $('#descarga').on('click',function(){
           
                location.href ="Prueba_boton_descarga.php";
               
        })
        $('#manda_responsiva').on('click',function(){
           
           url='php/Resp.php?id_usuario=2';
           window.open(url);
        })
    });

</script>
</body>
</html>