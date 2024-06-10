

<textarea 
{{ $attributes->merge(['class' => "py-1 border-b-2 border-slate-700 bg-gray-100 focus:outline-none focus:border-sky-600 invalid:border-red-500 disabled:opacity-50 disabled:cursor-not-allowed"]) }}>
{{ $slot }}
</textarea>