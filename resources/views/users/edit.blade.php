<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <h3 class="px-8 py-4 block mb-2 text-2xl font-medium text-gray-900 dark:text-white">Sửa thông tin người dùng</h3>
                <form  action="{{ route('users.update',['user'=>$user->id]) }}" method="post">
                @method('PUT')
                    @csrf
                    <div class="px-8 py-4">
                        <label for="name" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Họ và tên</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" placeholder="Nhập họ và tên" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
                    </div>
                    <div class="px-8 py-4">
                        <label for="email" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" value="{{ $user->email }}" name="email" placeholder="Nhập email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
                    </div>
                    <div class="px-8 py-4">
                        <label for="select" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Vai trò</label>
                        <select name="role" id="select" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  p-2.5 ">
                                @foreach ($role as $u)
                                    @foreach ($user->roles as $key => $role)
                                <option value="{{ $u->id }}" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 "
                                        @if ($u->id===$role->id) selected 
                                        @endif>
                                        {{ $u->name }}</option>
                                    @endforeach
                                @endforeach
                        </select>
                    </div>
                    <div class="px-8 py-4">
                        <x-jet-button name="submit" >Cập nhật</x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>