<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
    <div class="container-fluid">
        <div class="col-2 col-lg-2 col-xl-2">
            <div class="navbar-wrapper ">
                <div class="navbar-toggle ">
                    <button type="button " class="navbar-toggler ">
                        <span class="navbar-toggler-bar bar1 "></span>
                        <span class="navbar-toggler-bar bar2 "></span>
                        <span class="navbar-toggler-bar bar3 "></span>
                    </button>
                </div>
                <a class="navbar-brand d-none d-lg-inline-block" href="#">
                    <img src="public/css/img/logo.jpg " class="d-inline-block rounded mx-auto img-fluid ">
                </a>
            </div>
        </div>
        <div class="col-9 col-sm-9 col-md-9 col-lg-8 col-xl-8 text-center d-none d-md-block ">
            <span class="navbar-text nav-titulo">
                Sistema de Gestión de Libros
            </span>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index "
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab "></span>
            <span class="navbar-toggler-bar navbar-kebab "></span>
            <span class="navbar-toggler-bar navbar-kebab "></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="menuUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                        <p>
                            <span>user-name</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menuUsuario">
                        <a class="dropdown-item" href="#">Cerrar sesion</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>