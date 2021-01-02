<header class="shadow-md">
    <div id="header_wrapper" class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex w-full justify-between items-center md:space-x-10">
            <a href="/" id="logo">Mint</a>
            <livewire:search  :class="'w-1/2'"/>
            <div id="user_bar" class="flex justify-between space-x-2.5">
                <img class="user_menu shadow-filter" src="/ico/favorite.svg">
                <img class="user_menu shadow-filter" src="/ico/notifications.svg">
                <img class="user_menu shadow-filter" src="/user/avatar.png">
            </div>
        </div>
    </div>
</header>
