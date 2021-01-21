@extends('layouts.base')

@section('content')
<livewire:feed></livewire:feed>
    {{--    <form action="/test">--}}
{{--        <textarea name="post_data" id="editor"></textarea>--}}
{{--        <input type="submit">--}}
{{--    </form>--}}
@endsection
@section('script')
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>--}}
{{--    <script>--}}
{{--        ClassicEditor--}}
{{--            .create( document.querySelector( '#editor' ) )--}}
{{--            .catch( error => {--}}
{{--                console.error( error );--}}
{{--            } );--}}
{{--    </script>--}}
@endsection
