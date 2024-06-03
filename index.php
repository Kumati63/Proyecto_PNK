<?php

session_start();

if(isset($_SESSION['usu']))
{
    switch($_SESSION['tipo']){
        case 1: $tipo="ADMINISTRADOR";
            break;
        case 2: $tipo="PROPIETARIO";
            break;
        case 3: $tipo="VENDEDOR";
            break;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/style_index.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>PNK Inmovilaria</title>
</head>
<body>
    <header>
        <a href="index.html">
            <div class="logo" id="titulo"><img src="img/logo.png" alt="" width="430px"></div>
        </a>
        
        <div class="menu-header">
            <a href="menu.php">Perfil</a>
            <a href="error.html">Contactanos</a>
            <a href="">Quienes somos</a>
        </div>
    </header>

    <section class="section">

        <div class="main-image">
            <img id="section-image" src="img/main_background_image.png"  alt="">
        </div>

        <div class="image-text" id="image-text">
            <p id="texto1">Buscas un nuevo hogar? Haz llegado al lugar correcto!</p>br
            <p id="texto2">Te invitamos a revisar nuestra pagina y encontrar tus opciones preferidas</p>
        </div>
        <form method="post" action="#">
            <div class="searcher" id="searcher">
                <div class="selects">
                    <select name="Region">
                        <option value="0">Región</option>
                        <option value="1"></option>
                        <option value="2"></option>
                        <option value="3"></option>
                    </select>
                </div>
                <div class="selects">
                    <select name="Comuna">
                        <option value="0">Comuna</option>
                        <option value="1"></option>
                        <option value="2"></option>
                    </select>
                </div>
                <div class="selects">
                    <select name="Ciudad">
                        <option value="0">Ciudad</option>
                        <option value="1"></option>
                        <option value="2"></option>
                    </select>
                </div>
                <div class="search-button">
                    <button type="submit">Buscar</button>
                </div>
            </div>
        </form>

        <label for="">Casas</label>
        <div class="gallery-scroller">
            <div class="item">
                <img src="img/casas-depas-terr/casa.jpg" alt="">
                <div class="item-text">Av. Gullermo Ulriksen <br> 2 piezas 1 baño</div>
                <button class="button">ver más</button>
            </div>
            <div class="item">
                <img src="img/casas-depas-terr/casa2.jpg" alt=""></img>
                <div class="item-text"></div>
                <button class="button">ver más</button>
            </div>
            <div class="item">
                <img src="img/casas-depas-terr/casa3.jpg" alt=""></img>
                <div class="item-text"></div>
                <button class="button">ver más</button>
            </div>
            <div class="item">
                <img src="img/casas-depas-terr/casa.jpg" alt="">
                <div class="item-text">Av. Gullermo Ulriksen <br> 2 piezas 1 baño</div>
                <button class="button">ver más</button>
            </div>
            <div class="item">
                <img src="img/casas-depas-terr/casa2.jpg" alt=""></img>
                <div class="item-text"></div>
                <button class="button">ver más</button>
            </div>
            <div class="item">
                <img src="img/casas-depas-terr/casa3.jpg" alt=""></img>
                <div class="item-text"></div>
                <button class="button">ver más</button>
            </div>
        </div>

        <label for="">Departamentos</label>
        <div class="gallery-scroller">
            <div class="item">
                <img src="img/casas-depas-terr/departamento1.png" alt="">
                <div class="item-text">La Florida<br> 2 piezas 2 baño</div>
                <button class="button">ver más</button>
            </div>
            <div class="item">
                <img src="img/casas-depas-terr/departamento2.png" alt=""></img>
                <div class="item-text"></div>
                <button class="button">ver más</button>
            </div>
            <div class="item">
                <img src="img/casas-depas-terr/departamento3.png" alt=""></img>
                <div class="item-text"></div>
                <button class="button">ver más</button>
            </div>
        </div>

        <label for="">Terrenos</label>
        <div class="gallery-scroller">
            <div class="item">
                <img src="img/casas-depas-terr/terreno1.jpg" alt="">
                <div class="item-text"></div>
                <button class="button">ver más</button>
            </div>
            <div class="item">
                <img src="img/casas-depas-terr/terreno2.jpg" alt=""></img>
                <div class="item-text"></div>
                <button class="button">ver más</button>
            </div>
            <div class="item">
                <img src="img/casas-depas-terr/terreno3.jpg" alt=""></img>
                <div class="item-text"></div>
                <button class="button">ver más</button>
            </div>
        </div>
        
    </section>

    <footer>
        <ul>
            <li><a  id="volver" href="#titulo">volver arriba</a></li>
        </ul>
    </footer>
</body>
</html>
<?php
}else{
    header("Location:error.html");
}
?>