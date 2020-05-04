@extends('layouts.project')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Общая статистика</li>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="?sort=PROJ_REG">Обозначение проекта</a></th>
            <th scope="col"><a href="?sort=PROJECT_TITLE">Наименование</a></th>
            <th scope="col"><a href="?sort=COUNT_TASKS">Количество задач</a></th>
            <th scope="col"><a href="?sort=COUNT_EMPLOYEE">Количество сотрудников</a></th>
            <th scope="col"><a href="?sort=MANAGER_FAM">ФИО менеджера</a></th>
            <th scope="col"><a href="?sort=RATE_TIME">Планируемое количество часов</a></th>
            <th scope="col"><a href="?sort=DIF_HOURS">Реальное количество часов по закрытым задачам</a></th>
            <th scope="col"><a href="?sort=END_TASK">Всего закрыты задач</a></th>
        </tr>
        </thead>
        <tbody>
        @foreach($res as $row)
            <tr>
                <th scope="row">{{$row->PROJ_REG}}</th>
                <td>{{$row->PROJECT_TITLE}}</td>
                <td>{{$row->COUNT_TASKS}}</td>
                <td>{{$row->COUNT_EMPLOYEE}}</td>
                <td>{{$row->MANAGER_FAM}} {{$row->MANAGER_NAME}} {{$row->MANAGER_PATRO}}</td>
                <td>{{$row->RATE_TIME}}</td>
                <td>{{$row->DIF_HOURS}}</td>
                <td>{{$row->END_TASK}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <form method="post" action="{{route('csv')}}">
        @csrf
        <button type="submit" class="btn btn-primary btn-lg active">CSV</button>
    </form>
    <br><br><br>
@endsection
