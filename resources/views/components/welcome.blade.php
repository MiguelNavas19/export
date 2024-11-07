
@session('status')
<div class="font-medium text-sm text-lime-600">
    {{ $value }}
</div>
@endsession

<form action="{{ route('imports') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">

        <div>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="file_input" name="file" type="file">
        </div>
        <div>
            <button
                class="inline-flex items-center px-4 py-2 bg-white dark:bg-white border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
                Subir
            </button>

        </div>

</div>
</form>

<div class="grid grid-cols-1  gap-6 lg:gap-8 p-6 lg:p-8">
<livewire:export-table  />
</div>
