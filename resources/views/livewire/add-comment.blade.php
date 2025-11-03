@php use App\Helpers\DateHelper; @endphp
<div class="p-6 rounded-md shadow dark:shadow-gray-800 mt-8">
    @auth()
        <h5 class="text-lg font-semibold">Leave A Comment:</h5>
        <form class="mt-8" wire:submit="submit">
            <div class="grid grid-cols-1">
                <div class="mb-5">
                    <div class="text-start">
                        <label for="comments" class="font-semibold">Your Comment:</label>
                        <div class="form-icon relative mt-2">
                            <i data-feather="message-circle" class="w-4 h-4 absolute top-3 start-4"></i>
                            <textarea wire:model="comment" id="comments" class="form-input ps-11 h-28" placeholder="Message :"></textarea>
                            <span class="text-red-600 text-sm">@error('comment') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($message))
                <p class="text-green-600">{{$message}}</p>
            @endif
            <input type="submit"
                   wire:loading.attr="disabled"
                   wire:loading.="disabled"
                   wire:loading.class="cursor-not-allowed bg-gray-50 border-gray-50 text-black hover:bg-gray-50 hover:border-gray-50 hover:text-gray-400"
                   wire:loading.class.remove="bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white"
                   value="Send Message"
                   class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md w-full"/>
        </form>
    @else
        <a href="{{route('auth.login',['locale'=>app()->getLocale()])}}" class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md w-full">Login to comment</a>
    @endauth

    <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
        <div class="max-w-2xl mx-auto">
            @foreach($comments as $item)
                <article @class([
                                'p-6 text-base bg-white rounded-lg dark:bg-gray-900',
                                'mb-3'=>!$loop->last,
                                'border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900'=>!$loop->first,
                            ])>
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center me-3 rtl:ms-3 text-sm text-gray-900 dark:text-white font-semibold">
                                <img
                                    class="me-2 rtl:ms-2 w-6 h-6 rounded-full"
                                    src="{{loadMedia($item->user,'image','thumb')}}"
                                    alt="Michael Gough">{{$item->user->full_name}}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span>{{DateHelper::format($item->created_at)}}</span>
                            </p>
                        </div>

                    </footer>
                    <p class="text-gray-500 dark:text-gray-400">{{$item->comment}}</p>
                    <div class="flex items-center mt-4 space-x-4 hidden">
                        <button type="button"
                                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                            </svg>
                            Reply
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</div>