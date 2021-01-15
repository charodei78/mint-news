<div class="flex flex-col space-y-1 {{ $class ?? '' }}">
    <x-sidebar.button selected="true" image="/ico/feed.svg" class="font-extrabold space-x-2 pl-3 text-2xl">Лента</x-sidebar.button>
    <hr class="opacity-40 border-1 rounded">
    <x-sidebar.button>Наука</x-sidebar.button>
    <x-sidebar.button selected="true">Культура</x-sidebar.button>
    <x-sidebar.button>Развлечения</x-sidebar.button>
    <x-sidebar.button>Технологии</x-sidebar.button>
    <x-sidebar.button>Музыка</x-sidebar.button>
    <hr class="opacity-40"><br>
</div>