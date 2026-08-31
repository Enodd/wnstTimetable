@props(['conductor'])

@foreach($conductor as $cond)
    <div class="conductor-name">
        {{ $cond['name'] }} {{ $cond['surname']  }}
    </div>
@endforeach
