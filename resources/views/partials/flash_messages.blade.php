@if (session('success'))
    <x-flash-message :message="session('success')" type="success" icon="<i class='fa-solid fa-circle-check'></i>"
        color="alert-success" />
@endif

@if (session('error'))
    <x-flash-message :message="session('error')" type="danger" icon="<i class='fa-solid fa-circle-exclamation'></i>"
        color="alert-danger" />
@endif
