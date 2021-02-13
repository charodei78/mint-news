<div
        x-data="{
            show: false,
            formType: '',
            password: '',
            error: {},
            passwordConfirm: '',
            passwordEqual() {
                return (this.formType != 'registration') || (this.password == this.passwordConfirm)
            },
            sendForm (e) {
                this.error = {};
                if (!this.passwordEqual()) {
                    this.error.password_confirmation = '{{ __('Пароли не совпадают') }}'
                    return false;
                }
                let form = new FormData();
                for (let i = 0; i < e.target.length; i++) {
                    let input = e.target[i];
                    if (input.name)
                        form.append(input.name, input.value);
                }
                axios.post(this.formType == 'auth' ? '{{ route('login', absolute: false) }}' : '{{ route('register', absolute: false) }}', form)
                    .then(response => { location.href = '/' })
                    .catch(error => {
                    this.error = error.response.data.errors })
            }
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
                    <div
                            class="p-2 font-medium cursor-pointer text-center mx-2 bg-green-600 w-1/2 rounded-xl"
                            @click="formType='registration'; setTimeout(() => $refs.scrollable.scrollTo({top: 400, behavior: 'smooth'}), 300)"
                    >
                        {{ __('Нет') }}
                    </div>
                </div>
                <div class="w-10 ml-auto h-10 text-3xl rounded-full bg-gray-800 text-white">
                    <div class="w-4 m-auto">
                        ?
                    </div>
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
                        :class="formType == 'auth' ? 'text-green-500 font-medium':'text-black'"
                        class="cursor-pointer"
                        @click="formType='auth'"
                >{{ __('Авторизация') }}</div>
                <div
                        :class="formType == 'registration' ? 'text-green-500 font-medium':'text-black'"
                        class="cursor-pointer"
                        @click="formType='registration'"
                >{{ __('Регистрация') }}</div>
            </div>
            <form @submit.prevent="sendForm">
                @csrf
                <div class="w-full flex flex-col justify-center mb-3 text-green-500">
                    <x-elements.error-message x-show="error.register"
                                              x-text="error.register"
                    ></x-elements.error-message>
                    <x-elements.error-message x-show="error.auth"
                                              x-text="error.auth"
                    ></x-elements.error-message>
                    <template x-if="formType == 'auth'">
                        <x-input.with-error required name="login" placeholder="nick / e-mail" class="input-popup"></x-input.with-error>
                    </template>
                    <template x-if="formType == 'registration'">
                        <div class="flex flex-col">
                            <x-input.with-error required name="nickname" max="12" placeholder="nick" class="input-popup"></x-input.with-error>
                            <x-input.with-error required name="name" max="255" placeholder="{{ __('Имя') }}" class="input-popup"></x-input.with-error>
                            <x-input.with-error type="email" required name="email" max="255" placeholder="e-mail" class="input-popup"></x-input.with-error>
                        </div>
                    </template>
                    <x-input.with-error type="password" required x-model="password" name="password" min="8" placeholder="{{ __('Пароль') }}" class="input-popup"></x-input.with-error>
                    <template x-if="formType == 'registration'">
                        <x-input.with-error type="password" required name="password_confirmation" x-model="passwordConfirm" min="8" placeholder="{{ __('Повторите пароль') }}" class="input-popup"></x-input.with-error>
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
                    <button class="send-button"
                            :formaction="formType == 'auth' ? '{{ route('login', absolute: false) }}' : '{{ route('register', absolute: false) }}'"
                            x-text="formType == 'auth' ? '{{ __('Войти') }}' : '{{ __('Зарегистрироваться') }}'"
                    ></button>
                </div>
            </form>
        </div>
    </div>
</div>