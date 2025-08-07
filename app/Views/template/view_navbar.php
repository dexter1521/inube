<!-- Top Navbar Area -->
<nav class="navbar top-navbar navbar-expand">
    <div class="collapse navbar-collapse" id="navbarSupportContent">
        <div class="responsive-burger-menu d-block d-lg-none">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>

        <ul class="navbar-nav left-nav align-items-center">

        </ul>

        <div class="ml-auto"></div>

        <ul class="navbar-nav right-nav align-items-center">

            <li class="nav-item dropdown profile-nav-item">
                <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="menu-profile">
                        <span class="name" id="name"></span>
                        <img src="<?php echo base_url('assets/img/product3.jpg') ?>" class="rounded-circle" alt="image">
                    </div>
                </a>

                <div class="dropdown-menu">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="<?php echo base_url('assets/img/product3.jpg') ?>" class="rounded-circle" alt="image">
                        </div>

                        <div class="info text-center">
                            <span class="name"></span>
                            <p class="mb-3 email"></p>
                        </div>
                    </div>

                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class='bx bx-user'></i> <span>Perfil</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class='bx bx-edit-alt'></i> <span>Editar Perfil</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class='bx bx-cog'></i> <span>Herramientas</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-footer">
                        <ul class="profile-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="logout()">
                                    <i class='bx bx-log-out'></i> <span>Salir</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- End Top Navbar Area -->

<!-- Start Main Content Wrapper Area -->
