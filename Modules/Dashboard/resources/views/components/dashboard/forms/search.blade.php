@props([
    'data',
    'route',
])

{{-- Only show the search box if data collection not an empty collection OR user search for something and no data for whatever he looking for so we need the search box --}}

@if($data->isNotEmpty() || request()->filled('q'))
    <!-- Begin Search Section -->
    <form action="{{ route($route) }}" method="GET" id="searchForm">
        <div class='justify-start'>
            <input type='text' name='q' placeholder="{{ __('dashboard::dashboard.search') }}" class="px-4 py-2 focus:outline-none mr-2" value="{{ request('q') }}">

            <!-- This maybe help to push a hidden inputs  -->
            {{ $slot }}

            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md">
                <i class="fa fa-search"></i>
                {{ __('dashboard::dashboard.search') }}
            </button>

            <button href="#" class="px-4 py-2 bg-yellow-500 text-white rounded-md" onclick="resetSearch()" id="reset_simple_search">
                {{ __('dashboard::dashboard.reset') }}
            </button>
        </div>
    </form>
    <!-- End Search Section -->

    @push('js')
        <script>
            function resetSearch() {
                let form = document.getElementById('searchForm');

                clearQueryInputValue(form);

                clearHiddenInputsValue(form)

                form.submit();
            }

            function clearQueryInputValue(form)
            {
                form.querySelector('input[name="q"]').value = '';
            }

            function clearHiddenInputsValue(form)
            {
                let hiddenInputs = form.querySelectorAll('input[type="hidden"]');

                // Clear the values of all hidden inputs
                hiddenInputs.forEach((input) => {
                    input.value = '';
                });
            }
        </script>
    @endpush
@endif