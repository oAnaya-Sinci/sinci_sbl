<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> OEE</a>
                    </li>
                    <li class="nav-title">
                        Menu
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pencil"></i> Configuracion</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-power"></i> Maquinas</a>
                            </li>
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-puzzle"></i> Varibles</a>
                            </li>
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-ravelry"></i> Eventos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>