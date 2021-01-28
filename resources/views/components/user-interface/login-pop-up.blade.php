<div
        x-data="{show: false, formType: ''}"
        x-show.transition.scale="show"
        @open-login.window="show=true; $dispatch('blackout-show')"
        @click.away="$dispatch('blackout-hide'); show=false"
        {{ $attributes->merge(['class' => 'text-green-100 bg-green-100 login-pop-up fixed top-24 rounded-lg pb-3 z-30']) }}
        style="display:none"
>
    <div class="w-full rounded-t-md flex flex-row h-12 justify-between bg-green-600 items-center p-3 text-xl">
        <div>{{ __('Приветствую!') }}</div>
        <div class="rounded-full w-7 h-7 bg-green-100 text-green-600 cursor-pointer">
            <a class="text-5xl absolute top-0 right-3" @click="show = false; $dispatch('blackout-hide')">
                &times;
            </a>
        </div>
    </div>
    <div x-ref="scrollable" class="p-4 overflow-auto max-h-96 sm:max-h-full">
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
                    <div
                            class="p-2 font-medium cursor-pointer text-center mx-2 bg-green-600 w-1/2 rounded-xl"
                            @click="formType='auth'; setTimeout(() => $refs.scrollable.scrollTo({top: 400, behavior: 'smooth'}), 300)"
                    >
                        Да
                    </div>
                    <a
                            class="p-2 font-medium cursor-pointer text-center mx-2 bg-green-600 w-1/2 rounded-xl"
                            @click="formType='registration'; setTimeout(() => $refs.scrollable.scrollTo({top: 400, behavior: 'smooth'}), 300)"
                    >
                        Нет
                    </a>
                </div>
                <div class="w-10 ml-auto h-10">
                    <img src="/ico/mocki.svg">
                </div>
            </div>
            <div x-show.transition.origin.top.duration.800ms="formType.length > 0" class="flex flex-row">
                <div class="w-10 h-10 mt-5">
                    <img src="/ico/mocki.svg">
                </div>
                <div class="w-3/4 flex flex-col">
                    <div class="w-full h-6 overflow-hidden overflow-ellipsis text-green-500 ml-4">
                        Mocki
                    </div>
                    <div class="p-2 px-4 ml-8 bg-green-600 rounded-xl rounded-bl-3xl rounded-tr-2xl"
                        x-text="formType == 'auth' ? 'Напомни свое имя?' : 'Тогда давай познакомимся!'"
                    ></div>
                </div>
            </div>
        </div>
        <div x-show.transition.origin.top.duration.1200ms="formType.length > 0" class="flex flex-col px-3">
            <div class="flex justify-between my-3">
                <div
                        x-bind:class="formType == 'registration' ? 'text-green-500 font-medium':'text-black' +
                        ' cursor-pointer'"
                        @click="formType='registration'"
                >Регистрация</div>
                <div
                        x-bind:class="formType == 'auth' ? 'text-green-500 font-medium':'text-black' +
                        ' cursor-pointer'"
                        @click="formType='auth'"
                >Авторизация</div>
            </div>
            <div class="w-full flex flex-col justify-center space-y-3">
                <input type="text" placeholder="Логин / e-mail" class="outline-green rounded-md">
                <input type="password" placeholder="Пароль" class="outline-green rounded-md">
            </div>
            <a href="#" class="text-green-500 ml-auto mr-4 mt-2 mb-2">Забыли пароль?</a>
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