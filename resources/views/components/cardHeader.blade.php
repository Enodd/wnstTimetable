@props([
    'fullWidth' => false,
    'size' => 'lg'
])

<div class="text-{{$size}} border-[1px] p-1 border-blue-100 {{$fullWidth ? 'w-full' : 'w-fit'}} rounded">
    <p>
        {!! $slot !!}
    </p>
</div>
