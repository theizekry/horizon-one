@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-5" role="alert">
        <strong class="font-bold">{{ __('dashboard::dashboard.whoops') }}</strong>
        <span class="block sm:inline">{{ __('dashboard::dashboard.errors-block-message') }}</span>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif