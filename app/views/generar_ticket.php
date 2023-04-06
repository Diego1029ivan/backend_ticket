<!DOCTYPE html>
<html>

<head>

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
img {
  max-width: 100%;
  display: block;
  height: auto;
  margin: 0 auto;
}
 .ticket {
        max-width: 11.6px;
        /* max-height: 3px;  */
           
        margin:0 auto;
        padding:  0 0.1px;
        /* background-color: aqua; */
        }
.ticket-title{
     font-size: 0.4px;

}
.ticket-container-superior{
 position:  relative;
 margin-bottom: 0.2px;

}
.ticket-container-superior img{
    position: absolute;
    top: 0;
    right: 0;
}
.ticket-position{
    position: relative;
    margin-top: -19.4px;
}
.ticket-position h4{
    position: absolute;
    left: 0;
    right: 0;
    top: 1px;
    font-size: 0.4px;
    text-align: center;

}

.col-3{
    margin: 0 auto;
    text-align: center;

}
.col-4{
    margin: 2 auto;
    text-align: center;
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
                    <img  src="https://unsm.edu.pe/wp-content/uploads/2016/10/cropped-logo-ICONO.png" alt="logo" style="max-width:10%;"></div>
                </div>

                <div class="ticket-container">
                    
                    <div class="col-3">
                        <?php $src1="http://localhost:8012/backend_ticket/inventarioBarra/".$codigo;
                        echo '<img  style="max-width:80%;max-height:50%;" src="'.$src1.'" alt="codigo barra">';
                        ?>
                    </div>
                    <div class="ticket-position">
                        <h4 class="ticket-codigo"><?php echo $codigo ?>  |  <?php echo $inventario->fecha ?></h4>

                        <h4 class="ticket-codigo"></h4>
                    </div>

                </div>
        </div>
    </div>
</body>

</html>