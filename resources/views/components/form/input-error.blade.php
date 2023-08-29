@if ($messages)
    <div {{ $attributes->merge(['class'=>"text-danger"]) }} >
        @foreach ($messages as $message)
            <p class="mb-0">{{ $message }}</p>
        @endforeach
    </div>
@endif