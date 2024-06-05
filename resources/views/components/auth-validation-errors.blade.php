@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="mt-1 font-medium text-danger">
            <strong>Whoops! Something went wrong.</strong>
        </div>

        <ul class="mt-1 text-sm list-disc list-inside text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
