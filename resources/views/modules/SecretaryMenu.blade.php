<aside class="main-sidebar fixed-menu">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ url('Start') }}">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li>
                <a href="{{ url('Pets') }}">
                    <i class="fa fa-paw"></i>
                    <span>Mascotas</span>
                </a>
            </li>
            {{-- Menu Mantenimiento con "Sub Opciones" --}}
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-chevron-down"></i>
                    <span>Mantenimiento</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ url('Breeds') }}" class="submenu-item">
                            <i class="fa fa-wrench"></i>
                            <span>Razas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('Colors') }}" class="submenu-item">
                            <i class="fa fa-wrench"></i>
                            <span>Colores</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('Medicines') }}" class="submenu-item">
                            <i class="fa fa-wrench"></i>
                            <span>Medicamentos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('Species') }}" class="submenu-item">
                            <i class="fa fa-wrench"></i>
                            <span>Especies</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('Pets-Inactive') }}" class="submenu-item">
                            <i class="fa fa-paw"></i>
                            <span>Mascotas (Inactivas)</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
