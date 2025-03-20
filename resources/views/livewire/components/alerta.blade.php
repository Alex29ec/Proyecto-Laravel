@if ($mensaje)
    <div class="alert alert-{{ $tipo }} d-flex justify-content-between align-items-center" style="padding: 10px; border-radius: 5px;">
        <span>{{ $mensaje }}</span>
    </div>
@endif
