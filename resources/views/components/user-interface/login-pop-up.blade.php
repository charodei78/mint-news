<div
        x-data="{
        show: false,
        formType: '',
        password: '',
        passwordConfirm: '',
        get passwordEqual() {
            return (this.formType == 'registration') && (this.password != this.passwordConfirm)}
        }"
        x-show.transition.scale="show"
        @open-login.window="show=true; $dispatch('blackout-show')"
        @mousedown.away="$dispatch('blackout-hide'); show=false"
        {{ $attributes->merge(['class' => 'text-green-100 bg-green-100 shadow-lg login-pop-up fixed top-24 rounded-lg pb-3 z-30 flex flex-col']) }}
        style="display:none"
>
    <div class="w-full rounded-t-md flex flex-row h-12 justify-between bg-green-600 items-center p-3 text-xl shadow-lg">
        <div>{{ __('Приветствую!') }}</div>
        <div class="rounded-full w-7 h-7 bg-green-100 text-green-500 cursor-pointer">
            <a class="text-5xl absolute top-0 right-3" @click="show = false; $dispatch('blackout-hide')">
                &times;
            </a>
        </div>
    </div>
    <div x-ref="scrollable" class="p-4 overflow-auto invert-scrollbar max-h-96 flex flex-col sm:max-h-full">
        <div class="w-full space-y-3">
            <div class="flex flex-row">
                <div class="w-10 h-10 mt-5">
                    <img src="/ico/mocki.svg">
                </div>
                <div class="w-3/4 flex flex-col">
                    <div class="w-full h-6 overflow-hidden overflow-ellipsis text-green-500 ml-4">
                        {{ __('Mocki') }}
                    </div>
                    <div class="py-2 px-4 ml-8 bg-green-500 rounded-xl rounded-bl-3xl rounded-tr-2xl">
                        {!! __('Привет, странник! <br> Мы знакомы?') !!}
                    </div>
                </div>
            </div>
{{--        TODO: avatar element--}}
            <div class="flex flex-row">
                <div class="ml-12 w-3/4 flex flex-row">
                    <div
                            class="p-2 font-medium cursor-pointer text-center mx-2 bg-green-500 w-1/2 rounded-xl"
                            @click="formType='auth'; setTimeout(() => $refs.scrollable.scrollTo({top: 400, behavior: 'smooth'}), 300)"
                    >
                        {{ __('Да') }}
                    </div>
                    <a
                            class="p-2 font-medium cursor-pointer text-center mx-2 bg-green-600 w-1/2 rounded-xl"
                            @click="formType='registration'; setTimeout(() => $refs.scrollable.scrollTo({top: 400, behavior: 'smooth'}), 300)"
                    >
                        {{ __('Нет') }}
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
                        {{ __('Mocki') }}
                    </div>
                    <div class="p-2 px-4 ml-8 bg-green-600 rounded-xl rounded-bl-3xl rounded-tr-2xl"
                        x-text="formType == 'auth' ? '{{ __('Напомни свое имя?') }}' : '{{ __('Тогда давай познакомимся!') }}'"
                    ></div>
                </div>
            </div>
        </div>
        <div x-show.transition.origin.top.duration.1200ms="formType.length > 0" class="flex flex-col px-3">
            <div class="flex justify-between my-3">
                <div
                        :class="formType == 'registration' ? 'text-green-500 font-medium':'text-black'"
                        class="cursor-pointer"
                        @click="formType='registration'"
                >{{ __('Регистрация') }}</div>
                <div
                        :class="formType == 'auth' ? 'text-green-500 font-medium':'text-black'"
                        class="cursor-pointer"
                        @click="formType='auth'"
                >{{ __('Авторизация') }}</div>
            </div>
            <form method="post">
                @csrf
                <div class="w-full flex flex-col justify-center space-y-3 mb-3 text-green-500">
                    <template x-if="formType == 'auth'">
                        <input type="text" required name="login" placeholder="nick / e-mail" class="outline-green rounded-md">
                    </template>
                    <template x-if="formType == 'registration'">
                        <div class="flex flex-col space-b-3">
                            <input type="text" required name="nickname" max="12" placeholder="nick" class="outline-green rounded-md mb-3">
                            <input type="text" required name="name" max="255" placeholder="{{ __('Имя') }}" class="outline-green rounded-md mb-3">
                            <input type="text" required name="email" max="255" placeholder="e-mail" class="outline-green rounded-md">
                        </div>
                    </template>
                    <input type="password" required name="password" x-model="password" min="8" placeholder="{{ __('Пароль') }}" class="outline-green rounded-md">
                    <template x-if="formType == 'registration'">
                        <input type="password" required name="password_confirmation" x-model="passwordConfirm" min="8" placeholder="{{ __('Повторите пароль') }}" class="outline-green rounded-md">
                    </template>
                    <a href="#" class="text-green-500 ml-auto mr-4 mt-2 mb-2">{{ __('Забыли пароль?') }}</a>
                </div>
                <div class="flex justify-between items-end">
                    <div class="flex h-10 space-x-2">
                        <a href="#">
                            <img src="/ico/vk.svg" class="h-full" alt="vk.com login">
                        </a>
                        <a href="#">
                            <img src="/ico/google.svg" class="h-full" alt="google.com login">
                        </a>
                    </div>
                    <button class="rounded bg-green-500 p-2 mr-4"
                            :formaction="formType == 'auth' ? '{{ route('login') }}' : '{{ route('register') }}'"
                            :disabled="passwordEqual"
                    >{{ __('Отправить') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>