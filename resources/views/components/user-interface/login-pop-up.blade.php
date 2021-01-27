<div {{ $attributes->merge(['class' => 'text-green-100 bg-green-100 login-pop-up fixed top-24 rounded-lg pb-3 z-30']) }}>
    <div class="w-full rounded-t-md flex flex-row h-12 justify-between bg-green-600 items-center p-3 text-xl">
        <div>{{ __('Приветствую!') }}</div>
        <div class="rounded-full w-7 h-7 bg-green-100 text-green-600 cursor-pointer">
            <div class="text-5xl absolute top-0 right-3">
                &times;
            </div>
        </div>
    </div>
    <div class="p-3">
        <div class="w-full space-y-3">
            <div class="flex flex-row">
                <div class="w-10 h-10 mt-5">
                    <img src="/ico/mocki.svg">
                </div>
                <div class="w-3/4 flex flex-col">
                    <div class="w-full h-6 overflow-hidden overflow-ellipsis text-green-500 ml-4">
                        Mocki
                    </div>
                    <div class="py-2 px-4 ml-8 bg-green-600 rounded-xl rounded-bl-3xl rounded-tr-2xl">
                        Привет, странник! <br>
                        Мы знакомы?
                    </div>
                </div>
            </div>
{{--        TODO: avatar element--}}
            <div class="flex flex-row">
                <div class="ml-12 w-3/4 flex flex-row">
                    <div class="p-2 font-medium cursor-pointer text-center mx-2 bg-green-600 w-1/2 rounded-xl">
                        Да
                    </div>
                    <div class="p-2 font-medium cursor-pointer text-center mx-2 bg-green-600 w-1/2 rounded-xl">
                        Нет
                    </div>
                </div>
                <div class="w-10 h-10">
                    <img src="/ico/mocki.svg">
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-10 h-10 mt-5">
                    <img src="/ico/mocki.svg">
                </div>
                <div class="w-3/4 flex flex-col">
                    <div class="w-full h-6 overflow-hidden overflow-ellipsis text-green-500 ml-4">
                        Mocki
                    </div>
                    <div class="p-2 px-4 ml-8 bg-green-600 rounded-xl rounded-bl-3xl rounded-tr-2xl">
                        Напомни свое имя
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col px-4">
            <div class="flex justify-between my-5">
                <div class="text-black">Регистрация</div>
                <div class="text-black">Авторизация</div>
            </div>
            <div class="w-full flex flex-col justify-center space-y-3">
                <input type="text" placeholder="Логин / e-mail" class="outline-green rounded-md">
                <input type="password" placeholder="Пароль" class="outline-green rounded-md">
            </div>
            <div class="text-green-500 ml-auto mr-4 mt-2 mb-3">Забыли пароль?</div>
            <div class="flex justify-between">
                <div class="flex h-10 space-x-2">
                    <a href="#">
                        <img src="/ico/vk.svg" class="h-full" alt="vk.com login">
                    </a>
                    <a href="#">
                        <img src="/ico/google.svg" class="h-full" alt="google.com login">
                    </a>
                </div>
                <button class="rounded bg-green-500 px-2 mr-4">Отправить</button>
            </div>
        </div>
    </div>
</div>