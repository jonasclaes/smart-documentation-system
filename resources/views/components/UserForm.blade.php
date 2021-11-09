@csrf
<div class="mt-2">
    <label
        for="firstName"
        class="text-gray-700">
        {{ __('First Name') }}</label>
    <input
        type="text"
        autofocus
        required
        autocomplete="firstName"
        name="firstName"
        id="firstName"
        value="{{ old('firstName') }}@isset($user){{$user->firstName}}@endisset"
        class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
@error('firstName') ring ring-red-500 ring-opacity-50 @enderror">

    @error('firstName')
    <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
    @enderror
</div>
<div class="mt-2">
    <label
        for="lastName"
        class="text-gray-700">
        {{ __('Last Name') }}</label>
    <input
        type="text"
        required
        autocomplete="lastName"
        name="lastName"
        id="lastName"
        value="{{ old('lastName') }}@isset($user){{$user->lastName}}@endisset"
        class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('lastName') ring ring-red-500 ring-opacity-50 @enderror">

    @error('lastName')
    <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
    @enderror
</div>
<div class="mt-2">
    <label
        for="email"
        class="text-gray-700">
        {{ __('E-Mail Address') }}</label>
    <input
        type="email"
        required
        autocomplete="email"
        name="email"
        id="email"
        value="{{ old('email') }}@isset($user){{$user->email}}@endisset"
        class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('email') ring ring-red-500 ring-opacity-50 @enderror">

    @error('email')
    <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
    @enderror
</div>
<div class="mt-2">
    <label
        for="username"
        class="text-gray-700">
        {{ __('Username') }}</label>
    <input
        type="text"
        autofocus
        required
        autocomplete="Username"
        name="username"
        id="username"
        value="{{ old('username') }}@isset($user){{$user->username}}@endisset"
        class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('username') ring ring-red-500 ring-opacity-50 @enderror">

    @error('username')
    <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
    @enderror
</div>
@isset($create)
    <div class="mt-2">
        <label
            for="password"
            class="text-gray-700">
            {{ __('Password') }}</label>
        <input
            type="password"
            required
            autocomplete="new-password"
            name="password"
            id="password"
            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror">

        @error('password')
        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
    <div class="mt-2">
        <label
            for="password-confirm"
            class="text-gray-700">
            {{ __('Confirm Password') }}</label>
        <input
            type="password"
            required
            autocomplete="new-password"
            name="password_confirmation"
            id="password-confirm"
            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror">

        @error('password')
        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
@endisset
<div class="grid grid-cols-1 mt-2 justify-end">
    <button
        type="submit"
        class="text-base font-medium rounded-lg p-3 text-white bg-teal-600 w-1/3">
        @isset($create)
            {{ __('Register') }}
        @endisset
        @isset($edit)
            {{ __('Update Information') }}
        @endisset
    </button>
</div>
