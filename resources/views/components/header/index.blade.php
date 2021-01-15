<header class="shadow-md fixed top-0 z-20 h-12 pt-1">
    <div id="header_wrapper" class="w-2/3 mx-auto px-4 sm:px-6 ">
        <div class="flex w-full justify-between items-center md:space-x-10">
            <a href="/" id="logo" class="text-4xl w-1/6">Mint</a>
            <livewire:search class="w-5/12" />
            <div id="user_bar" class="flex justify-between space-x-2.5 w-1/4">
                <img class="user_menu shadow-filter " src="/ico/inFavorite.svg">
                <x-header.notifications></x-header.notifications>
                <x-header.user-menu></x-header.user-menu>
                <span class="text-xl my-auto block">Константин</span>
            </div>
        </div>
    </div>
</header>
