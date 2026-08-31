@props([
    'fullWidth' => false,
    'size' => 'lg'
])

<div class="card-header card-header--{{$size}} {{$fullWidth ? 'card-header--full' : ''}}">
    <p>
        {!! $slot !!}
    </p>
</div>
