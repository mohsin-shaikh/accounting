<a {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-success-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-success-500 focus:outline-none focus:border-success-700 focus:ring focus:ring-success-200 active:bg-success-600 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</a>
