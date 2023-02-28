<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>
    @if (Session::has('success'))
        <div class="py-12 bg-green-400 rounded-lg  px-6  text-base text-green-700 mb-3" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i>{{ Session::get('success') }}</h5>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        @hasanyrole('Super-Admin')
                            <a href="{{ route('users.create') }}" class="m-4">Add new user</a>
                        @endhasanyrole
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">STT</th>
                                    <th scope="col" class="py-3 px-6">Họ và tên</th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th scope="col" class="py-3 px-6">Vai trò</th>
                                    @can('manage users')
                                    <th scope="col" class="py-3 px-6">Hành động</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $us)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$user->firstItem() + $loop -> index }}
                                    </th>
                                    <td class="py-4 px-6">{{ $us->name }}
                                    </td>
                                    <td class="py-4 px-6">{{ $us->email }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @foreach ($us->roles as $key => $role)
                                            {{ $role->name }}
                                        @endforeach
                                    </td>
                                    @can('manage users')
                                    <td class="py-4 px-6">
                                        <x-jet-nav-link href="{{ route('users.edit', $us) }}" class="uppercase text-blue-600 dark:text-blue-500 hover:underline">Edit</x-jet-nav-link>
                                        <form method="POST" action="{{ route('users.destroy', $us) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-jet-danger-button
                                                type="submit"
                                                onclick="return confirm('Are you sure?')">Delete
                                            </x-jet-danger-button>
                                        </form>
                                    </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>