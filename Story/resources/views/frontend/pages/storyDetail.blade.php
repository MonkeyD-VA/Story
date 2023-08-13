@extends('frontend.layouts.master')

@section('content')
    <style>
        #form {
            display: none;
        }
    </style>

    <h1>The story: {{ $story->story_name }}</h1>
    <p>Story ID: {{ $story->story_id }}</p>
    <p>Author: {{ $story->author_name }}</p>
    <p>Author ID: {{ $story->author_id }}</p>
    <p>Category: {{ $story->category }}</p>
    <p>Thumbnail: {{ $story->thumb }}</p>

    <button id="btn">Edit infomation</button>

    <div id="form"><br>
        <button id='hide'>
            Hide form
        </button>

        <form action="/story/update/{{$story->story_id}}" method="post">
            @method('PATCH')
            @csrf

            <input type="hidden" name="story_id" value="{{ $story->story_id }}">

            <p>
                <label for="story_name">Story Name</label><br>
                <input type="text" name="story_name" value="{{ $story->story_name }}">
            </p>

            <p>
                <label for="author_id">Author ID</label><br>
                <input type="text" name="author_id" value="{{ $story->author_id }}">
            </p>

            <p>
                <label for="author_name">Author Name</label><br>
                <input type="text" name="author_name" value="{{ $story->author_name }}">
            </p>

            <p>
                <label for="category">Category</label><br>
                <input type="text" name="category" value="{{ $story->category }}">
            </p>

            <p>
                <label for="thumb">Thumb</label><br>
                <input type="text" name="thumb" value="{{ $story->thumb }}">
            </p>

            <p>
                <button type="submit">Submit</button>
            </p>

        </form>
    </div>

    <script>
        const showBtn = document.querySelector('#btn')
        const hideBtn = document.querySelector('#hide')
        const div = document.querySelector('#form')
        showBtn.addEventListener('click', () => {
            div.style.display = 'block'
        })
        hideBtn.addEventListener('click', () => {
            div.style.display = 'none'
        })
    </script>
@endsection
