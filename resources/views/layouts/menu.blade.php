<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Főoldal</p>
    </a>
</li>

<li class="nav-header">E-DÖK</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
            Események
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="/events" class="nav-link">
                <i class="far fa-calendar-plus nav-icon"></i>
                <p>Jelentkezés</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/own" class="nav-link">

                <i class="far fa-calendar-check nav-icon"></i>
                <p>
                    Saját események
                </p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="/blog" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>
            Faliújság
        </p>
    </a>
</li>


<li class="nav-header">Adminisztrácíó</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
            Események
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="/event_create" class="nav-link"> 
                <i class="nav-icon far fa-calendar-plus"></i>
                <p>
                    Hozzáadás
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin_own" class="nav-link">

                <i class="far fa-calendar-times nav-icon"></i>
                <p>
                    Saját események
                </p>
            </a>
        </li>
    </ul>
</li>



<li class="nav-item">
    <a href="/blog" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>
            Faliújság
        </p>
    </a>
</li>
@if (Auth::user()->can('dok admin'))
@endif
