<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks list') }}
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
                    @hasanyrole('writer|Super-Admin')
                        <a href="{{ route('tasks.create') }}" class="m-4">Add new task</a>
                    @endhasanyrole
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Task name</th>
                                @hasanyrole('writer|admin|Super-Admin')
                                    <th scope="col" class="px-6 py-3">Hành Động</th>
                                @endhasanyrole
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($tasks as $task)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $task->name }}
                                </td>
                                @hasanyrole('writer|admin|Super-Admin')
                                <td class=" px-6 py-4">
                                    <a href="{{ route('tasks.edit', $task) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <x-jet-danger-button
                                            type="submit"
                                            onclick="return confirm('Are you sure?')">Delete
                                        </x-jet-danger-button>
                                    </form>
                                </td>
                                @endhasanyrole
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="2"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ __('No tasks found') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>