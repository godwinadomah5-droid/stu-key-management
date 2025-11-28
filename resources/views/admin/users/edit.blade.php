<div class="w-full">
    <form id="editUserForm" action="{{ route('admin.update-user', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="edit_name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                <input type="text" name="name" id="edit_name" value="{{ $user->name }}" required
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="edit_email" class="block text-sm font-medium text-gray-700">Email Address *</label>
                <input type="email" name="email" id="edit_email" value="{{ $user->email }}" required
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="edit_phone" class="block text-sm font-medium text-gray-700">Phone Number *</label>
                <input type="text" name="phone" id="edit_phone" value="{{ $user->phone }}" required
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="edit_password" class="block text-sm font-medium text-gray-700">New Password (leave blank to keep current)</label>
                <input type="password" name="password" id="edit_password"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="edit_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="edit_password_confirmation"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Roles *</label>
                <div class="space-y-2">
                    @foreach($roles as $role)
                    <div class="flex items-center">
                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" 
                               id="edit_role_{{ $role->id }}" 
                               {{ $user->hasRole($role->name) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="edit_role_{{ $role->id }}" class="ml-2 text-sm text-gray-700">
                            {{ ucfirst($role->name) }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" onclick="hideEditUserModal()"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Cancel
            </button>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                Update User
            </button>
        </div>
    </form>
</div>
