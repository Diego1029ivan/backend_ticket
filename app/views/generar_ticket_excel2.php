<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>My Website</title>
  <!-- Cargar los estilos de Bootstrap -->

<style>
    @page {
    size: 10.5cm 2cm;
    orientation: landscape;
  }
    html {
    box-sizing: border-box;
 }
*,
*:before,
*:after {
 box-sizing: inherit;
 font-family: 'DejaVu Sans', serif;
 margin: 0;
 padding: 0;
}
body{
   width:140px;
   height:8px;

}
.ticket-title h1{
   padding-top:5%;
   font-size:5px;

   text-align:center;


}
.img-log{
    padding-top:1%;
   width:18px;
   height:18px;
   position:absolute;
    top:0;
    right:60%;

}
.imagen-barras{
    margin-top:5px;
}
.imagen-barras h4{
    width:50%;
    font-size:5px;
    padding-left:30%;
    text-align:center;
    white-space: nowrap;

}

.imagen-barras img{
    width:60%;
    padding-left:25%;

}
.ticket-qr{
    padding-top: 10px;
    padding-left:10px;
    position:absolute;
    top:0;
    right:-10;
    width:40%;

}


</style>

</head>

<body>

<div class="todo">
    <div class="ticket">


                    <div class="">
                        <div class="ticket-title">
                            <h1>Universidad Nacional de San Martin</h1>
                        </div>
                        <div class="">
                            <img class="img-log" src="https://unsm.edu.pe/wp-content/uploads/2016/10/cropped-logo-ICONO.png" alt="logo" >
                        </div>
                    </div>


                <div class="">
                    <div class="imagen-barras">
                        <?php $src1="http://localhost/backend_ticket/inventarioBarraExcel/68481";
                        echo '<img  src="'.$src1.'" alt="codigo barra">';
                        ?>
                        <h4><?php echo "1511"?></h4>

                        <h4>Fecha de Adquisición <?php echo "25-01-2021" ?></h4>
                    </div>


                </div>

    </div>
    <div class="ticket-qr">
                    <div class="imagen-qr">
                        <?php $src1="http://localhost/backend_ticket/inventarioQRExcel/11115";
                        echo '<img  src="'.$src1.'" alt="codigo barra">';
                        ?>
                    </div>
    </div>
</div>

</body>

</html>
