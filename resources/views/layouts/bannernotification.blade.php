@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@else
<!-- Código a ejecutar si no hay mensaje de éxito -->
@endif