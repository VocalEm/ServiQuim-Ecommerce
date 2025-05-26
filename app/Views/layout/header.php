<header class="header">
    <div class="contenedor-header">
        <a href="/">
            <div class="header-contendorLogo <?php echo $show_class ? 'logointro' : ''; ?>">
                <div class="header-logo"></div>
                <h1>ServiQuim</h1>
            </div>
        </a>

        <form class="header-search" action="">
            <input
                type="text"
                name="searchBarHeader"
                id="header-searchBar"
                placeholder="Buscar..." />
            <button type="submit">
                <i class="fa fa-search fa-2x"></i>
            </button>
        </form>

        <div class="header-iconos">
            <?php
            if (!isset($_SESSION['ID'])) {
            ?>
                <a href="/login" class="<?php echo $show_class ? 'perfilintro' : ''; ?>"><i class="fa-regular fa-circle-user fa-3x useri"></i></a> <?php
                                                                                                                                                } else {
                                                                                                                                                    ?>
                <a href="/perfil" class="<?php echo $show_class ? 'perfilintro' : ''; ?>"><i class="fa-regular fa-circle-user fa-3x useri"></i></a>
            <?php
                                                                                                                                                }
            ?>
            <a href="/carrito" class="<?php echo $show_class ? 'carritointro' : ''; ?>"><i class="fa fa-shopping-cart fa-3x carti"></i></a>
            <a href="/Favoritos" class="<?php echo $show_class ? 'favoritosintro' : ''; ?>"><i class="fa-regular fa-heart fa-3x hearti"></i></a>
        </div>
    </div>
</header>

<div class="subheader">
    <div class="contenedor-subheader">
        <div class="subheader-botonp <?php echo $show_class ? 'tiendaintro' : ''; ?>">
            <i class="fa fa-bars"></i><a href="/tienda?categoria=2">Tienda en linea</a>
        </div>
        <div class="subheader-botons <?php echo $show_class ? 'contactointro' : ''; ?>"><a href="/contacto">Contactanos</a></div>
        <div class="subheader-botons <?php echo $show_class ? 'sucursalintro' : ''; ?>"><a href="/sucursales">Sucursales</a></div>
        <div class="subheader-botons <?php echo $show_class ? 'nosotrosintro' : ''; ?>"><a href="/nosotros">Nosotros</a></div>
    </div>
</div>