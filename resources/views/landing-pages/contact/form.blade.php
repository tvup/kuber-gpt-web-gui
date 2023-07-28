<form class="form-horizontal" method="POST" action="/contact">
    {{ csrf_field() }}

    <div class="mb-4">
        <label for="name" class="block font-bold">{{ __('contact.name') }}:</label>
        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" id="name" placeholder="{{ __('contact.name') }}" name="name" required>
    </div>
    <div class="mb-4">
        <label for="email" class="block font-bold">{{ __('contact.email') }}:</label>
        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" id="email" placeholder="{{ __('contact.email') }}" name="email" required>
    </div>
    <div class="mb-4">
        <label for="message" class="block font-bold">{{ __('contact.message') }}:</label>
        <textarea class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" id="message" placeholder="{{ __('contact.enter_message') }}" name="message" required></textarea>
    </div>
    <div class="mb-4">
        <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600" value="Send">{{ __('contact.send') }}</button>
    </div>
</form>
