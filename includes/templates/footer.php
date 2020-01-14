<footer class="site-footer">
    <div class="contenedor clearfix">
        <div class="footer-informacion">
            <h3>Sobre <span>gldwebcamp</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, sit, distinctio veniam itaque porro minima quisquam reprehenderit illum, impedit aliquam quibusdam, ab eligendi maxime pariatur!</p>
        </div>
        <div class="ultimos-tweets">
            <h3>Últimos <span>tweets</span></h3>
            <ul>
                <li><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quae mollitia ducimus cumque magni maxime.</p></li>
                <li><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quae mollitia ducimus cumque magni maxime.</p></li>
                <li><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quae mollitia ducimus cumque magni maxime.</p></li>
            </ul>
        </div>
        <div class="menu">
            <h3>Redes <span>sociales</span></h3>
            <nav class="redes-sociales">
                <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </nav>
        </div>
    </div>

    <p class="copyright">
        Todos los derechos Reservados GLDWEBCAMP 2016.
    </p>

</footer>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.lettering.js"></script>
<?php 
    //Cargando archivos de acuerdo a la página abierta.
$archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace(".php", "", $archivo);

if($pagina == 'invitados' || $pagina == 'index'){
  echo '<script src="js/jquery.colorbox.js"></script>';
} else if($pagina == 'conferencia') {
  echo '<script src="js/lightbox.js"></script>';
}
if($pagina==='registro'){
    echo '<script src="js/cotizador.js"></script>';
}
?>

<script src="js/main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADRjgYqBMCQPX9NAMLocWzOcl4RI5sww0&callback=initMap"
async defer></script>


<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>
