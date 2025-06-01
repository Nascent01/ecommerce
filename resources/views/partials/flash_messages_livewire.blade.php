@if (session('livewire-success'))
    <x-flash-message :message="session('livewire-success')" type="success" icon="<i class='fa-solid fa-circle-check'></i>"
        color="alert-success" />
@endif

@if (session('livewire-error'))
    <x-flash-message :message="session('livewire-error')" type="danger" icon="<i class='fa-solid fa-circle-exclamation'></i>"
        color="alert-danger" />
@endif