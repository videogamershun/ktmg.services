<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Főoldal</p>
    </a>
</li>
<li class="nav-header">E-DÖK</li>
<li class="nav-item">
    <a href="/events" class="nav-link">
        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
            Események
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="/blog" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>
            Faliújság
        </p>
    </a>
</li>

@if(Auth::user()->can('dok admin'))

<li class="nav-header">Adminisztrácíó</li>
<li class="nav-item">
    <a href="/events" class="nav-link">
        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
            E-DÖK
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="/blog" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>
            Faliújság
        </p>
    </a>
</li>
@endif