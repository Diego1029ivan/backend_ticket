<?php

$medidaTicket = 180;

?>
<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }

       
        .centrado {
            text-align: center;
            align-content: center;
        }
        .ticket {
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
        }

        .barras{
            width:50%;
        }
        .qr{
            
        }

        * {
            margin: 0;
            padding: 0;
        }

        .ticket {
            margin: 0;
            padding: 0;
        }

        body {
            text-align: center;
            
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="ticket centrado">
        
        <h2><?php echo $inventario->nombre ?></h2>
        <h2><?php echo $inventario->fecha ?></h2>
        <div class="row">
            <div class="col-3">
            <?php $src1="http://localhost:8012/backend_ticket/inventarioBarra/".$codigo;
            echo '<img class="barras" src="'.$src1.'" alt="">';
            ?> 
            <h4><?php echo $codigo ?></h4>
            </div>

            <div class="col-4">
            <?php $src2="http://localhost:8012/backend_ticket/inventarioQR/".$codigo;
            echo '<img class="qr" src="'.$src2.'" alt="">';
            ?> 
            </div>
        </div>
       
        
        
        <!-- <p class="centrado">¡GRACIAS POR SU COMPRA!
            <br>parzibyte.me</p> -->
    </div>
</body>

</html>