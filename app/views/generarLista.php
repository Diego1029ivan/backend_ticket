<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>My Website</title>
  <!-- Cargar los estilos de Bootstrap -->

<style>
    @page {
    size: 10.5cm 2.4cm;
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
   padding-top:4%;
   font-size:6.5px;
   width:100%;
   margin-left:20px;
   text-align:center;


}
.img-log{
    padding-top:1%;
   width:20px;
   height:20px;
   position:absolute;
    top:0;
    right:53%;

}

.imagen-barras h4{
    width:45%;
    font-size:6px;
    margin-bottom:-2px;
    padding-left:50%;
    text-align:center;
    white-space: nowrap;

}

.imagen-barras img{
    margin-top:9px;
    width:100%;
    padding-left:25%;

}
.ticket-qr{
    padding-top: 10px;
    padding-left:10px;
    position:absolute;
    top:0;
    right:-17;
    width:40%;
    

}
.imagen-qr{
    width:75px;
    height:75px;
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
                        <?php $src1=$_ENV['APP_URL']."/backend_ticket/inventarioBarraExcel/".$codigo;
                        echo '<img  src="'.$src1.'" alt="codigo barra">';
                        ?>
                        <h4><?php echo $codigo ?></h4>
                        
                        <h4>F.A. <?php echo $fecha ?></h4> 
                    </div>


                </div>

    </div>
    <div class="ticket-qr">
                    <div >
                        <?php $src1=$_ENV['APP_URL']."/backend_ticket/inventarioQRExcel/".$codigo."/".$fecha."/".$descripcion;
                        echo '<img  class="imagen-qr" src="'.$src1.'" alt="codigo barra">';
                        ?>
                    </div>
    </div>
</div>

</body>

</html>
