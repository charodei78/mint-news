<div class="w-full bg-green-100 rounded py-4 px-8 post-wrapper relative"
        x-data="{
            image: null,
        }"
>
    <form class="flex flex-col">
        <div class="pr-2" contenteditable="true">

            <textarea name="title"
                      maxlength="80"
                      @input="$event.target.style.height = 'auto'; $event.target.style.height = $event.target.scrollHeight - 25 + 'px'"
                      placeholder="{{ __('Заголовок') }}"
                      @keydown.enter.prevent=""
                      class="transparent-textarea w-full h-10 text-2xl font-bold"></textarea>
        </div>
        <div class="flex space-x-2 my-3">
            <div class="text-green-500">
                {{ ucfirst(Auth::User()->nickname) }}
            </div>
            <div class="font-medium">
                {{  now()->format('d.m.Y') }}
            </div>
        </div>
        <div class="h-96 my-3 relative">
            <div
                    x-show="image"
                    class="rounded-full w-7 h-7 bg-red-500 cursor-pointer  text-xl text-center text-white absolute top-2 right-2"
                    @click="$refs.preview.value = ''; image = null"
            >
                    x
            </div>
            <div x-show="!image">
                <input type="file"
                       x-ref="preview"
                       name="preview"
                       accept="image/*"
                       class="h-full w-full"
                       @change="image = URL.createObjectURL($event.target.files[0])"
                >
            </div>
            <template x-if="image">
                <img class="post-image rounded object-cover h-full w-full"
                     :src="image">
            </template>
        </div>

        <textarea name="synopsis"
                  @keydown.enter.prevent=""
                  @input="$event.target.style.height = 'auto'; $event.target.style.height = $event.target.scrollHeight - 22 + 'px'"
                  maxlength="160"
                  placeholder="{{ __('Краткое содержание') }}"
                  class="transparent-textarea font-medium"
        ></textarea>
        <textarea name="post_data" id="editor"></textarea>
    </form>
    <script>
      let script = document.querySelector('script[src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"]');
      if (!script) {
        script = document.createElement('script');
        script.src = "https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js";
        document.body.appendChild(script);
        script.onload = () => {
          ClassicEditor
              .create(document.querySelector('#editor'))
              .catch(error => {
                console.error(error);
              });
        }
      }
      else
      {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
              console.error(error);
            });
      }


    </script>
</div>




@push('scripts')

@endpush
