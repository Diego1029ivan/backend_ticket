<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>My Website</title>
  <!-- Cargar los estilos de Bootstrap -->

<style>

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
   padding-top:10%;
   font-size:2.5px;
   width:45%;
   text-align:center;


}
.img-log{
    padding-top:10%;
   width:10%;
   position:absolute;
    top:0;
    right:50%;

}
.imagen-barras{
    margin-top:10px;
}
.imagen-barras h4{
    width:50%;
    font-size:3px;
    text-align:center;

}

.imagen-barras img{
    width:40%;
    padding-left:10px;

}
.ticket-qr{
    padding-top: 10%;
    padding-left:10px;
    position:absolute;
    top:0;
    right:-8;
    width:50%;

}


</style>

</head>

<body>
    <div class="ticket ">
     <div class="ticket-container-superior">
        <div >
        <h1 class="ticket-title">Universidad Nacional de San Martin</h1>
    </div>
    <div>
        <img  src="https://unsm.edu.pe/wp-content/uploads/2016/10/cropped-logo-ICONO.png" alt="logo" style="max-width:14%;"></div>
    </div>
        <div class="ticket-container row">
            <div class="imagen-barras col">
            <?php $src1=$_ENV['APP_URL']."/backend_ticket/inventarioBarraExcel/".$codigo;
            echo '<img  src="'.$src1.'" alt="codigo barra">';
            ?>
            </div>
            <div class="ticket-position">
            <h4 class="ticket-codigo"><?php echo $codigo ?></h4>
            <!-- <hr> -->
            <!-- <h4 class="ticket-codigo">fecha adquisición <?php //echo $dia."-".$mes."-".$year ?></h4> -->
            </div>
            <div class="imagen-barras col"></div>
            <?php $src1=$_ENV['APP_URL']."/backend_ticket/inventarioQRExcel/".$codigo;
            echo '<img  src="'.$src1.'" alt="codigo barra">';
            ?>

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
                        <?php $src1=$_ENV['APP_URL']."/backend_ticket/inventarioBarraExcel/68481";
                        echo '<img  src="'.$src1.'" alt="codigo barra">';
                        ?>
                        <h4><?php echo "1511"?></h4>

                        <h4>fecha adquisición <?php echo "25-01-2021" ?></h4>
                    </div>


                </div>

    </div>
    <div class="ticket-qr">
                    <div class="imagen-qr">
                        <?php $src1=$_ENV['APP_URL']."/backend_ticket/inventarioQRExcel/11115";
                        echo '<img  src="'.$src1.'" alt="codigo barra">';
                        ?>
                    </div>
    </div>
</div>

</body>

</html>
