@props(['conductor'])

@foreach($conductor as $cond)
    <div class="text-inherit text-md leading-snug mt-0.5">
        {{ $cond['name'] }} {{ $cond['surname']  }}
    </div>
@endforeach
