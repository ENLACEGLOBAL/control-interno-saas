@if ($errors->any())
    <x-alert type="error" {{ $attributes }}>
        <p class="font-semibold">Revisa la información antes de continuar:</p>
        <ul class="mt-1 list-inside list-disc space-y-0.5 font-normal">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif
