<div class="grid grid-cols-2">
    <div class="mt-2 mx-1">
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
@error('firstName') ring ring-red-500 ring-opacity-50 @enderror" disabled>

        @error('firstName')
        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
    <div class="mt-2 mx-1">
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
            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 @error('lastName') ring ring-red-500 ring-opacity-50 @enderror"
            disabled>

        @error('lastName')
        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
    <div class="mt-2 cols-span-2 lg:col-span-6 mx-1">
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
            value="{{ old('email')}}@isset($user){{$user->email}}@endisset"
            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 @error('email') ring ring-red-500 ring-opacity-50 @enderror"
            disabled>

        @error('email')
        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
    <div class="mt-2 cols-span-12 lg:col-span-6 mx-1">
        <label
            for="phoneNumber"
            class="text-gray-700">
            {{ __('Phone Number') }}</label>
        <input
            type="tel"
            autocomplete="phoneNumber"
            name="phoneNumber"
            id="phoneNumber"
            value="{{ old('phoneNumber') }}@isset($user){{$user->phoneNumber}}@endisset"
            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 @error('phoneNumber') ring ring-red-500 ring-opacity-50 @enderror"
            disabled>
        @error('phoneNumber')
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
            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
         focus:ring-opacity-50 @error('username') ring ring-red-500 ring-opacity-50 @enderror"
            disabled>
        @error('username')
        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
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
            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror"
            disabled>

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
            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror"
            disabled>

        @error('password')
        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
@endisset
