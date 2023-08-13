@extends('frontend.layouts.master')

@section('content')
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        a {
            text-decoration: none;
        }

        button {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font: 1em sans-serif;
        }
    </style>

    <h1>Danh sách Story</h1>
    <button><a href="story/add">Thêm truyện</a></button> <br><br>
    <table id="customers">
        <thead>
            <tr>
                <th>ID</th>
                <th>Story name</th>
                <th>Author ID</th>
                <th>Author</th>
                <th>Category</th>
                <th>Thumbnail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($story as $row)
                <tr>
                    <td>{{ $row->story_id }}</td>
                    <td>{{ $row->story_name }}</td>
                    <td>{{ $row->author_id }}</td>
                    <td>{{ $row->author_name }}</td>
                    <td>{{ $row->category }}</td>
                    <td>{{ $row->thumb }}</td>
                    <td><span><a href="/story/detail/{{ $row->story_id }}">Details</a></span>
                        <span><form action="/story/delete/{{$row->story_id}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit">Delete</button>
                        </form></span>
                    </td>
                </tr>
            @endforeach

            {{ $story->links() }}
        </tbody>


    </table>
@endsection
