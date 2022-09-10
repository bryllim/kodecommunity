<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-3 py-12 px-12 gap-10">
        <div class="col-span-2">
            @if (Session::has('success'))
            <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 mb-5" role="alert">
                <div class="flex">
                    <p class="text-sm text-center">{{ Session::get('success') }}</p>
                </div>
            </div>
            @endif
            @foreach($posts->reverse() as $post)
            <div class="w-full shadow h-auto bg-white rounded-md mb-3">
                <div class="flex items-center space-x-2 p-2.5 px-4">
                    <div class="w-10 h-10"><img src="https://cdn-icons-png.flaticon.com/512/1803/1803671.png"
                            class="w-full h-full rounded-full" alt="dp"></div>
                    <div class="flex-grow flex flex-col">
                        <p class="font-semibold text-sm text-gray-700">{{ $post->user->name }}</p><span
                            class="text-xs font-thin text-gray-400">{{ $post->updated_at->diffForHumans() }}</span>
                    </div>
                    @if($post->user_id == Auth::user()->id)
                    <div class="w-8 h-8"><button
                            class="w-full h-full hover:bg-red-100 rounded-full text-red-400 focus:outline-none">✖</button>
                    </div>
                    @endif
                </div>
                <div class="mb-1">
                    <p class="text-gray-700 px-3 text-sm">{{ $post->content }}</p>
                </div>
                <div class="w-full flex flex-col space-y-2 p-2 px-4">
                    <div class="flex items-center justify-between pb-2 border-b border-gray-300 text-gray-500 text-sm">
                        <div class="flex items-center space-x-2"><button>52 Comments</button>
                        </div>
                    </div>
                    <div class="flex space-x-3 text-gray-500 text-sm font-thin"><button
                            class="flex-1 flex items-center h-8 focus:outline-none focus:bg-gray-200 justify-center space-x-2 hover:bg-gray-100 rounded-md">
                            <div><i class="fas fa-comment"></i></div>
                            <div>
                                <p class="font-semibold">Comment</p>
                            </div>
                        </button></div>
                </div>
            </div>
            @endforeach
        </div>
        <div>
            <div class="w-full shadow h-auto bg-white rounded-md">
                <div class="flex items-center space-x-2 p-2.5 px-4">
                    <div class="w-10 h-10"><img src="https://cdn-icons-png.flaticon.com/512/1803/1803671.png"
                            class="w-full h-full rounded-full" alt="dp"></div>
                    <div class="flex-grow flex flex-col">
                        <p class="font-semibold text-sm text-gray-700">{{ Auth::user()->name }}</p><span
                            class="text-xs font-thin text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                </div>
                <hr class="mt-4">
                <form method="POST" action="{{ route('createpost') }}">
                    @csrf
                    <div class="w-full flex flex-col space-y-2 p-2 px-4">
                        <textarea class="border-2 rounded-md focus:outline-none p-3" rows="10"
                            name="content"></textarea>
                        <div class="flex space-x-3 rounded-md bg-blue-500 text-white text-sm font-thin"><button
                                type="submit" class="flex-1 flex items-center h-8 space-x-200 rounded-md">
                                <div>
                                    <p class="font-semibold pl-5"><i class="fa-regular fa-pen-to-square"></i>Create Post
                                    </p>
                                </div>
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>