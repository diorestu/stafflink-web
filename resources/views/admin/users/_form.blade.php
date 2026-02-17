@php
    $user = $user ?? null;
@endphp

<div class="grid grid-cols-1 gap-5">
    <div>
        <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Name *</label>
        <input type="text" id="name" name="name" required value="{{ old('name', $user?->name) }}"
            class="w-full rounded-lg border border-gray-200 px-4 py-2.5 focus:border-[#287854] focus:ring-2 focus:ring-[#287854]">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email *</label>
        <input type="email" id="email" name="email" required value="{{ old('email', $user?->email) }}"
            class="w-full rounded-lg border border-gray-200 px-4 py-2.5 focus:border-[#287854] focus:ring-2 focus:ring-[#287854]">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="role" class="mb-2 block text-sm font-medium text-gray-700">Role *</label>
        <select id="role" name="role" required
            class="w-full rounded-lg border border-gray-200 px-4 py-2.5 focus:border-[#287854] focus:ring-2 focus:ring-[#287854] bg-white">
            <option value="super_admin" {{ old('role', $user?->role) === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            <option value="admin" {{ old('role', $user?->role ?? 'admin') === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
            Password {{ $user ? '(optional)' : '*' }}
        </label>
        <input type="password" id="password" name="password" {{ $user ? '' : 'required' }}
            class="w-full rounded-lg border border-gray-200 px-4 py-2.5 focus:border-[#287854] focus:ring-2 focus:ring-[#287854]">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">
            Confirm Password {{ $user ? '(optional)' : '*' }}
        </label>
        <input type="password" id="password_confirmation" name="password_confirmation" {{ $user ? '' : 'required' }}
            class="w-full rounded-lg border border-gray-200 px-4 py-2.5 focus:border-[#287854] focus:ring-2 focus:ring-[#287854]">
    </div>
</div>
