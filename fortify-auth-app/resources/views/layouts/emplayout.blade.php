<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="flex items-center">
        <i class="ti-layout-sidebar-left"></i> Logout
    </button>
</form>