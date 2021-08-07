<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin-index') }}">
        <div class="sidebar-brand-text mx-3">TMS</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ count(request()->segments()) == 1 ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin-dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Admin
    </div>

    <li class="nav-item {{ in_array(UrlSegment::ADMIN, request()->segments()) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminIndexData" aria-expanded="true" aria-controls="adminIndexData">
            <i class="fas fa-fw fa-users"></i>
            <span>Admin Data</span>
        </a>
        <div id="adminIndexData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Admin:</h6>
                <a class="collapse-item" href="{{ route('admin-index') }}">Show List</a>
            </div>
        </div>
    </li>

    <div class="sidebar-heading">
        Manage Participant
    </div>

    <li class="nav-item {{ in_array(UrlSegment::PARTICIPANT, request()->segments()) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Participant Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Participants:</h6>
                <a class="collapse-item" href="{{ route('participant-index') }}">Show List</a>
                <a class="collapse-item" href="{{ route('participant-create') }}">Add Single Participant</a>
                <a class="collapse-item" href="{{ route('participant-create-bulk') }}">Create Bulk Participant</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ in_array(UrlSegment::REGISTRATION, request()->segments()) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#registrationData" aria-expanded="true" aria-controls="registrationData">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Registration Data</span>
        </a>
        <div id="registrationData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Registration:</h6>
                <a class="collapse-item" href="{{ route('registration-index') }}">Show List</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ in_array(UrlSegment::COMPANY, request()->segments()) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-building"></i>
            <span>Company Data</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Companies:</h6>
                <a class="collapse-item" href="{{ route('company-index') }}">Show List</a>
                <a class="collapse-item" href="{{ route('company-create') }}">Create Company Data</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Training
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Training Schedule</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Trainings:</h6>
                <a class="collapse-item" href="{{ route('training-schedule-index') }}">Schedule List</a>
                <a class="collapse-item" href="{{ route('training-schedule-create') }}">Add New Training</a>
                <a class="collapse-item" href="{{ route('training-timeline-index') }}">Training Timeline</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#trainingData" aria-expanded="true" aria-controls="trainingData">
            <i class="fas fa-fw fa-folder"></i>
            <span>Training Data</span>
        </a>
        <div id="trainingData" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Trainings:</h6>
                <a class="collapse-item" href="{{ route('training-index') }}">Master Training List</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#trainersData" aria-expanded="true" aria-controls="trainersData">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Trainer Data</span>
        </a>
        <div id="trainersData" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Trainers:</h6>
                <a class="collapse-item" href="{{ route('trainer-index') }}">Trainer List</a>
                <a class="collapse-item" href="">Create Trainer Data</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
