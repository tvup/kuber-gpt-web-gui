<x-register-layout>
    <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
        <x-validation-errors class="mb-4" />

        <form class="bg-white" method="POST" action="{{ route('register') }}">
            @csrf
            <h1 class="text-gray-800 font-bold text-2xl mb-1">Register now!</h1>
            <p class="text-sm font-normal text-gray-600 mb-7">Free trial!</p>

            <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                          clip-rule="evenodd"/>
                </svg>
                <input id="name" class="pl-2 outline-none border-none" type="text" name="name" :value="old('name')" required  autocomplete="name"  placeholder="Full name" />
            </div>

            <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                </svg>
                <input id="email" class="pl-2 outline-none border-none" type="email" name="email" :value="old('email')" required autocomplete="email"  placeholder="Email Address" />
            </div>

            <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                          clip-rule="evenodd"/>
                </svg>
                <input id="password" class="pl-2 outline-none border-none" type="password" name="password" required autocomplete="new-password"  placeholder="Password"/>
            </div>

            <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                          clip-rule="evenodd"/>
                </svg>
                <input id="password_confirmation" class="pl-2 outline-none border-none" type="password" name="password_confirmation" required autocomplete="new-password"  placeholder="Confirm password"/>
            </div>



            <button class="block w-full bg-indigo-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">
                {{ __('Register') }}
            </button>
            <span class="text-sm ml-2 hover:text-blue-500 cursor-pointer"><a href="{{route('login')}}">{{ __('Already registered?') }}</a></span>
        </form>
    </div>
</x-register-layout>
