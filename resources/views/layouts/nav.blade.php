<nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <div class="d-none d-sm-inline-block mr-auto my-2 my-md-0 mw-100">
        <div class="d-flex">
            <span style="font-size: 16px;">
                <span>Company Name </span><strong id="companyDetails" style="color:red"></strong>
            </span>
            <div class="dropdown">
                <span style="font-size: 16px; margin-left: 30px;">
                    <span>Well Name </span>
                    <a class="dropdown-toggle" id="wellName" style="color:red; font-weight:bold" data-toggle="dropdown" href="#">
                        Select Well
                    </a>
                    <div class="dropdown-menu" id="wellDropdownMenu">
                        <!-- Well options will be populated here -->
                    </div>
                </span>
            </div>
            <span style="font-size: 16px; margin-left: 30px;">
                <span>Rig Name</span><strong id="rigName" style="color:red"></strong>
            </span>
            <span style="font-size: 16px; margin-left: 30px;">
                <span>Rig Activity </span><strong id="rigActivity" style="color:red"></strong>
            </span>
            <span style="font-size: 16px; margin-left: 30px;">
                <span>Date Time </span><strong id="dateTime" style="color:red"></strong>
            </span>
        </div>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                <img class="img-profile rounded-circle" src="{{ asset('import/assets/img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary logout-btn">Logout</button>
                </div>
            </div>
        </div>
    </div>
</nav>