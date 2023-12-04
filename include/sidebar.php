<div class="sidebar" id="sidebar">
    <div class="logo-content">
        <div class="logo">
            <i class="fa-solid fa-graduation-cap"></i>
            <h1 class="logo-name">Seguimiento<span>EGRESADO</span></h1>
        </div>
    </div>
    <ul class="nav-list">
        <li>
            <div class="icon-link">
                <a href="graduate.php?rute=mgraduate">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span class="link-name">Egresados</span>
                </a>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li>
                    <p class="submenu-name">Egresados</p>
                </li>

                <li><a href="graduateform.php?rute=agraduate">Agregar Egresado</a></li>

                <li><a href="graduate.php?rute=mgraduate">Ver Egresados</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="user.php?rute=muser">
                    <i class="fa-regular fa-circle-user"></i>
                    <span class="link-name">Usuarios</span>
                </a>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li>
                    <p class="submenu-name">Usuarios</p>
                </li>

                <li><a href="userform.php?rute=auser">Agregar Usuario</a></li>

                <li><a href="user.php?rute=muser">Ver Usuarios</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="profile.php?rute=mprofile">
                    <i class="fa-regular fa-id-card"></i>
                    <span class="link-name">Perfiles</span>
                </a>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li>
                    <p class="submenu-name">Perfiles</p>
                </li>

                <li><a href="profile.php?rute=mprofile">Ver perfiles</a></li>
            </ul>
        </li>
    </ul>
    <div class="profile-content">
        <div class="profile-group">
            <div class="profile">
                <div class="profile-details">
                    <img src="../img/user.png" alt="">
                    <div class="name-user">
                        <h2 class="name"><?php echo $user_nombre; ?></h2>
                        <p class="position"><?php echo $user_perfi; ?></p>
                    </div>
                </div>
                <a class='fa-solid fa-right-from-bracket btn-exit' id="log-out" href="../config/exit.php"></a>
            </div>
        </div>
    </div>
</div>