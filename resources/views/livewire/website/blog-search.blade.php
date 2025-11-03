<form>
    <div>
        <label for="searchname" class="font-medium text-lg">Search Properties</label>
        <div class="relative mt-2"
             x-data="{
                      search: @entangle('search').live,
                      open: false,
                      items: @entangle('results').live
                     }">
            <i class="uil uil-search text-lg absolute top-[8px] start-3"></i>
            <input x-on:click="open = !open" type="search" x-model="search" name="search" id="searchname" class="form-input border border-slate-100 dark:border-slate-800 ps-10" placeholder="Search">

            <ul x-show="open" x-on:click.outside="open = !open" x-transition:enter="transition ease-out duration-300"
                class="z-10 bg-white divide-y divide-gray-100 shadow-md dark:bg-gray-700"
                x-transition:enter-start="opacity-0 translate"
                x-transition:enter-end="opacity-100 translate"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate"
                x-transition:leave-end="opacity-0 translate">
                <template x-for="item in items" :key="item">
                    <li class="w-full text-gray-700 p-4 mt-2 bg-white">
                        <a x-text="item.title" :href="item.url" class="block"></a>
                    </li>
                </template>
            </ul>

        </div>
    </div>
</form>