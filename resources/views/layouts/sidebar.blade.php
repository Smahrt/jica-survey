<div class="sidebar" data-color="orange" data-image="{{ asset('assets/img/sidebar-1.jpg') }}">
    <div class="logo">
        <a href="{{ url() }}" class="simple-text">
            JICA DC
        </a>
    </div>

    <div class="sidebar-wrapper">
        <ul id="main-nav" class="nav">
            <li>
                <a href="{{ url('/dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/contacts') }}">
                    <i class="material-icons">account_box</i>
                    <p>Contacts</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/surveys') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Surveys</p>
               </a>
            </li>
            <li class="active-pro">
                <a href="#" data-toggle="modal" data-target="#callModal">
                    <p>START SURVEY</p>
                </a>
            </li>
        </ul>
    </div>
</div>