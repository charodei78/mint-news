<header class="shadow-md fixed z-20">
    <div id="header_wrapper" class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex w-full justify-between items-center md:space-x-10">
            <a href="/" id="logo">Mint</a>
            <livewire:search  />
            <div id="user_bar" class="flex justify-between space-x-2.5">
                <img class="user_menu shadow-filter" src="/ico/inFavorite.svg">
                <x-notifications></x-notifications>
                <x-user-menu></x-user-menu>
            </div>
        </div>
    </div>
</header>
