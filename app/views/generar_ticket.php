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
           max-width: 144px;
          width: 90%;
        margin: 8 auto;
        }
.ticket-title{
     font-size: 5px;

}
.ticket-codigo{
      font-size: 4px;
      text-align: center;
}
.ticket-container{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 0;
}
.ticket-container-superior{
 position:  relative;
 margin-bottom: 6px;
}
.ticket-container-superior img{
    position: absolute;
    top: 0;
    right: 0;
}
.ticket-position{
    position: relative;
    margin-top: -6px;
}
.ticket-position h4{
    position: absolute;
    left: 0;
    right: 0;
    top: 0;

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
        <div class="ticket-container">
            <div class="col-3">
            <?php $src1="http://localhost/backend_ticket/inventarioBarra/".$codigo;
            echo '<img  src="'.$src1.'" alt="codigo barra">';
            ?>
            </div>
            <div class="ticket-position">
            <h4 class="ticket-codigo"><?php echo $codigo ?></h4>
        </div>

        </div>
    </div>
</body>

</html>
