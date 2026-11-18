<x-guest-layout>
    <x-slot name="title">Verificar correo</x-slot>
    <x-slot name="heading">Verifica tu correo</x-slot>
    <x-slot name="subheading">Te enviamos un enlace de verificación. Revísalo para activar tu cuenta.</x-slot>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            Se envió un nuevo enlace de verificación al correo que registraste.
        </div>
    @endif

    <p class="mb-6 text-sm text-slate-500">
        ¿No recibiste el correo? Podemos enviarte otro enlace de verificación.
    </p>

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-auth-button>Reenviar correo de verificación</x-auth-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-900/10">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>
