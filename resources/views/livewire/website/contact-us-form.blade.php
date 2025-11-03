<form wire:submit="submit">
    <p class="mb-0" id="error-msg"></p>
    <div id="simple-msg"></div>
    @if(!auth()->check())
        <div class="grid lg:grid-cols-12 lg:gap-6">
            <div class="lg:col-span-6 mb-5">
                <label for="name" class="font-medium">Your Name:</label>
                <input wire:model="name" id="name" type="text" class="form-input mt-2" placeholder="Name :">
                @error('name') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
            </div>

            <div class="lg:col-span-6 mb-5">
                <label for="email" class="font-medium">Your Email:</label>
                <input wire:model="email" id="email" type="email" class="form-input mt-2" placeholder="Email :">
                @error('email') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1">
        <div class="mb-5">
            <label for="subject" class="font-medium">Your Question:</label>
            <input wire:model="subject" id="subject" class="form-input mt-2" placeholder="Subject :">
            @error('subject') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
        </div>

        <div class="mb-5">
            <label for="comments" class="font-medium">Your Comment:</label>
            <textarea wire:model="comment" id="comments" class="form-input mt-2 textarea" placeholder="Message :"></textarea>
            @error('comment') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
        </div>
    </div>
    <button type="submit" id="submit" name="send" class="btn bg-green-600 hover:bg-green-700 text-white rounded-md">Send Message</button>
    <p class="text-green-600">{{$result_message}}</p>
</form>