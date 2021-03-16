<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if ($errors->any())
                            <div class="text-red-600">
                            <ul>
                                 @foreach ($errors->all() as $error)
                                    <li>{{ __('Error: ').$error }}</li>
                                @endforeach
                            </ul>
                            </div>
                        @endif
                <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <x-input id="file" class="block mt-1 w-full" type="file" name="file"  required />
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3">
                            {{ __('Submit') }}
                        </x-button>
                    </div>
                </form>

               
               
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
