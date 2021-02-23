<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-yellow-700 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-yellow-500 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>