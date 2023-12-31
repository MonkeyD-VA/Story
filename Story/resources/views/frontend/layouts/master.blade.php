<!DOCTYPE html>
<html lang="en">

<head>
  <title> Monkey Story Project</title>
  <style>
    /* Add a black background color to the top navigation */
    .topnav {
      background-color: #333;
      overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
      float: left;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
      background-color: #04AA6D;
      color: white;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="topnav">
      <a class="active" href="/">Home</a>
      <a href="/story">Story</a>
      <a href="#">News</a>
      <a href="#">Contact</a>
      <a href="/about">About</a>
    </div>
  </div>

  @yield('content')
</body>

</html>