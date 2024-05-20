@php
    use App\Models\RolePermission;

    $user_role = auth()->user()->userRole->role_id;
    $rolePermissionSpeaker = RolePermission::where([
        'role_id' => $user_role,
        'permission_id' => 6,
        'confirmed' => '1',
    ])->exists();

    $rolePermissionRole = RolePermission::where([
        'role_id' => $user_role,
        'permission_id' => 7,
        'confirmed' => '1',
    ])->exists();

    $rolePermissionTicket = RolePermission::where([
        'role_id' => $user_role,
        'permission_id' => 4,
        'confirmed' => '1',
    ])->exists();

    $rolePermissionEmail = RolePermission::where([
        'role_id' => $user_role,
        'permission_id' => 5,
        'confirmed' => '1',
    ])->exists();

    $rolePermissionContent = RolePermission::where([
        'role_id' => $user_role,
        'permission_id' => 1,
        'confirmed' => '1',
    ])->exists();

    $rolePermissionreporting = RolePermission::where([
        'role_id' => $user_role,
        'permission_id' => 9,
        'confirmed' => '1',
    ])->exists();

@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" style="background-image: url({{ asset('') }})" class="brand-link">
        <img src="{{ asset('dist/img/WhatsApp Image 2024-03-04 at 14.45.04_8161d7d7.jpg') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">NAHRAWAND</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if ($rolePermissionreporting)
                    <li class="nav-item menu-open">

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route('dashboard.index') }}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reporting</p>
                                </a>
                            </li>
                        </ul>


                    </li>
                @endif

                <li class="nav-header">Gestion Acteur</li>

                @if ($rolePermissionRole || auth()->user()->userRole->role_id == 1)
                    <li class="nav-item">
                        <a href="{{ Route('dashboard.roles.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Rôles

                            </p>
                        </a>
                    </li>
                @endif



                @if (auth()->user()->userRole->role_id === 1 || auth()->user()->userRole->role_id == 2)
                    <li class="nav-item">
                        <a href="{{ Route('dashboard.admin.create') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Admin

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ Route('dashboard.manager.create') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Managers

                            </p>
                        </a>
                    </li>
                @endif


                @php

                @endphp

                @if ($rolePermissionSpeaker || auth()->user()->userRole->role_id === 1)
                    <li class="nav-item">
                        <a href="{{ Route('dashboard.speaker.create') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Speakers

                            </p>
                        </a>
                    </li>
                @endif


                <li class="nav-item">
                    <a href="{{ Route('dashboard.client.show') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Client

                        </p>
                    </a>
                </li>

                {{-- <li class="nav-header">Gestion Achats</li>

                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fa fa-credit-card"></i>
                        <p>
                            Abonnements

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fa fa-credit-card"></i>
                        <p>
                            Achats

                        </p>
                    </a>
                </li> --}}

                <li class="nav-header">Filter management</li>

                <li class="nav-item">
                    <a href="{{ Route('dashboard.category.create') }}" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ Route('dashboard.souscategorie.create') }}" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Subcategory

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('dashboard.program.create') }}" class="nav-link">
                        <i class="nav-icon fa fa-tasks"></i>
                        <p>
                            Program
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ Route('dashboard.goals.create') }}" class="nav-link">
                        <i class="nav-icon fa fa-bullseye" aria-hidden="true"></i>
                        <p>
                            Objectives

                        </p>
                    </a>
                </li>

                <li class="nav-header">Content Management</li>

                @if ($rolePermissionContent || auth()->user()->userRole->role_id === 1)
                    <li class="nav-item">
                        <a href="{{ Route('dashboard.cours.create') }}" class="nav-link">

                            <img class="nav-icon rounded-circle" src="{{ asset('asset/contentIcon.jpg') }}"
                                alt="">
                            <p>
                                Content
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ Route('dashboard.cours.index') }}" class="nav-link">
                        <img class="nav-icon rounded-circle" src="{{ asset('asset/contentIcon.jpg') }}" alt="">
                        <p>
                            View Content
                        </p>
                    </a>
                </li>

                @if ($rolePermissionContent || auth()->user()->userRole->role_id === 1)
                    <li class="nav-item">
                        <a href="{{ Route('dashboard.create.short') }}" class="nav-link">

                            <i class="nav-icon fa fa-desktop" aria-hidden="true"></i>
                            <p>
                                Quickly
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ Route('dashboard.show.short') }}" class="nav-link">

                        <i class="nav-icon fa fa-desktop" aria-hidden="true"></i>
                        <p>
                            View quickly
                        </p>
                    </a>
                </li>



                @if ($rolePermissionTicket || auth()->user()->userRole->role_id === 1)
                    <li class="nav-header">Ticket Management</li>

                    <li class="nav-item">
                        <a href="{{ Route('dashboard.tickets.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-ticket-alt" aria-hidden="true"></i>

                            <p>
                                Ticket
                            </p>
                        </a>
                    </li>
                @endif




                <li class="nav-header">Settings</li>

                <li class="nav-item">
                    <a href="{{ Route('dashboard.FAQ.edite') }}" class="nav-link">
                        <i class="nav-icon fa fa-question-circle" aria-hidden="true"></i>

                        <p>
                            FAQ
                        </p>
                    </a>
                </li>
                @if ($rolePermissionEmail || auth()->user()->userRole->role_id === 1)
                    <li class="nav-item">
                        <a href="{{ Route('dashboard.create.email') }}" class="nav-link">
                            <i class="nav-icon fa fa-envelope" aria-hidden="true"></i>

                            <p>
                                Emails
                            </p>
                        </a>
                    </li>
                @endif


                <li class="nav-item">
                    <a href="{{ Route('dashboard.cours.history') }}" class="nav-link">
                        <i class="nav-icon fa fa-history" aria-hidden="true"></i>

                        <p>
                            History
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
