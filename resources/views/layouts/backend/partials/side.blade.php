<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link main-sidebar__brand text-center">
        HABLEMOS CLARO
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="user-panel__radio">
            {{@$caracter}}
        </div>
        <div class="info user-panel__info">
            <span class="user-panel__nombre">{{@$usuario->name}}</span>

            <a href="/admin" class="d-block user-panel__rol"> Administrador</a>

        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


          <li class="nav-item has-treeview ">
            <a href="/admin" class="nav-link {{{ (Request::is('admin') ? 'active' : '') }}}">

              <p>Usuarios </p>
            </a>
          </li>

          <li class="nav-item has-treeview ">
            <a href="/admin/categories" class="nav-link {{{ (Request::is('admin/Categorias') ? 'active' : '') }}}">

              <p>Categorias </p>
            </a>
          </li>

          <li class="nav-item has-treeview ">
            <a href="/admin/posts" class="nav-link {{{ (Request::is('admin/posts') ? 'active' : '') }}}">

              <p>Publicaciones </p>
            </a>
          </li>

          <li class="nav-item has-treeview ">
            <a href="/admin/media" class="nav-link {{{ (Request::is('admin/media') ? 'active' : '') }}}">

              <p>Media </p>
            </a>
          </li>


        </ul>

      </nav>


      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="mt-3 pb-3 mb-3 d-flex align-items-end sidebar__close">
        <ul class="nav  nav-sidebar sidebar__lista">
            <li class="nav-item sidebar__elemento">

            <a class="nav-link sidebar__link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <span class="icono__salir"><img src="/images/exit.svg" class="img-fluid" >  Cerrar sesión
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            </li>
        </ul>
      </div>
  </aside>
