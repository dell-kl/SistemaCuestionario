    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <?php
        if ( isset($_GET['accion']) )
        {
            if ( $_GET['accion'] === "opciones" ) {
                ?>
                <script src="./wwwroot/js/listadoCuestionario.js"></script>
    <?php   }else {  ?>
                <script src="./wwwroot/js/script.js"></script>
    <?php   }
        }
    ?>
</body>
</html>