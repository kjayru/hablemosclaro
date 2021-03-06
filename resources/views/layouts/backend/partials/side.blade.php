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
            A
        </div>
        <div class="info user-panel__info">
            <span class="user-panel__nombre">&nbsp;</span>

            <a href="/admin" class="d-block user-panel__rol"> Administrador</a>

        </div>
      </div>
      <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item has-treeview ">
                    <a href="/admin" class="nav-link {{{ (Request::is('admin') ? 'active' : '') }}}">
                    <p>Dashboard </p>
                    </a>
                </li>


            <li class="nav-item has-treeview ">
                <a href="/admin/users" class="nav-link {{{ (Request::is('admin/users') ? 'active' : '') }}}">
                <p>Usuarios </p>
                </a>
            </li>

            <li class="nav-item has-treeview ">
                <a href="/admin/categories" class="nav-link {{{ (Request::is('admin/Categorias') ? 'active' : '') }}}">
                <p>Categorías </p>
                </a>
            </li>

            <li class="nav-item has-treeview ">
                <a href="/admin/posts" class="nav-link {{{ (Request::is('admin/posts') ? 'active' : '') }}}">
                <p>Publicaciones </p>
                </a>
            </li>

            <li class="nav-item has-treeview ">
                <a href="/admin/authors" class="nav-link {{{ (Request::is('admin/authors') ? 'active' : '') }}}">
                <p>Autores </p>
                </a>
            </li>

            <li class="nav-item has-treeview ">
                <a href="/admin/tags" class="nav-link {{{ (Request::is('admin/tags') ? 'active' : '') }}}">
                <p>Tags </p>
                </a>
            </li>


            <li class="nav-item has-treeview ">
                <a href="/admin/media" class="nav-link {{{ (Request::is('admin/media') ? 'active' : '') }}}">
                <p>Media </p>
                </a>
            </li>

            <li class="nav-item has-treeview ">
                <a href="/admin/register" class="nav-link {{{ (Request::is('admin/register') ? 'active' : '') }}}">
                <p>Suscripciones </p>
                </a>
            </li>

            <li class="nav-item has-treeview ">
                <a href="/admin/quizzes" class="nav-link {{{ (Request::is('admin/quizzes') ? 'active' : '') }}}">
                <p>Cuestionarios </p>
                </a>
            </li>

            <li class="nav-item has-treeview ">
                <a href="/admin/configuration" class="nav-link {{{ (Request::is('admin/configuration') ? 'active' : '') }}}">
                <p>Configuración </p>
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
