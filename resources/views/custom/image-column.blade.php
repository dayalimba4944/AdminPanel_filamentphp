{{-- custom/image-column.blade.php --}}
@if ($record->profile_picture)
    <img src="{{ asset('path/to/storage/' . $record->profile_picture) }}" alt="Profile Picture" style="max-width: 50px; max-height: 50px;">
@else
    No Image
@endif
