@extends('frontend.layouts.master')

@section('content')

  <h3>The story: {{$story->story_name}}</h3>
  <p>Author: {{$story->author_name}}</p>
  <p>Category: {{$story->category}}</p>


  

@endsection
