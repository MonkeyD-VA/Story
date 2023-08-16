@extends('frontend.layouts.master')



@section('content')
<style> 
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    input[type=text],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }

    input[type=submit] {
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .containerForm {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>
    <h2>Create new Story</h2>

    <div class="containerForm">
        <form action="/story/store" method='post'>
          @method('PATCH')
          @csrf
            <label for="story_name">Story Name</label>
            <input type="text" id="" name="story_name" placeholder="Name of the Story..">

            <label for="author_id">Author ID</label>
            <input type="text" id="" name="author_id" placeholder="ID author..">

            <label for="author_name">Author Name</label>
            <input type="text" id="" name="author_name" placeholder="Name of author..">

            <label for="category">Category</label>
            <select id="" name="category">
                <option value="Truyện tĩnh">Truyện tĩnh</option>
                <option value="Truyện icon ">Truyện icon</option>
                <option value="Truyện animation">Truyện animation</option>
            </select>

            <label for="thumb">Thumblenail</label>
            <input type="text" id="" name="thumb" placeholder="The url...">

            <input type="submit" value="Submit">
        </form>
    </div>
@endsection
