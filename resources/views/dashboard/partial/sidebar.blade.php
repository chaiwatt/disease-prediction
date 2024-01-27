<div class="cs_sidebar">
    <div class="cs_sidebar_item widget_categories">
        <h2 class="cs_sidebar_widget_title">Menu</h2>
        <ul>
            <li>
                <a href="{{route('dashboard')}}">Disease</a>
            </li>
            <li>
                <a href="{{route('dashboard.symptom')}}">Symptom</a>
            </li>
            {{-- <li>
                <a href="#">Intent</a>
            </li> --}}
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

</div>