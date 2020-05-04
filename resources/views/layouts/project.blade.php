<!DOCTYPE html >
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <title>PROJECT test</title>
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Test project Q</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('projects.index')}}">Проекты <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tasks.index')}}">Задачи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('employees.index')}}">Персоны</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('positions.index')}}">Справочники</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('statistics')}}">Общая статистика</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page">
        <div id="content">
            <div class="box">
                @yield('search_form')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @section('breadcrumbs')
                            <li class="breadcrumb-item"><a href="{{route('projects.index')}}">Главная</a></li>
                        @show
                    </ol>
                </nav>
                @yield('content')
            </div>
            <br class="clearfix"/>
        </div>
        <br class="clearfix"/>
    </div>
</div>
<div id="footer">

</div>
</body>
</html>
