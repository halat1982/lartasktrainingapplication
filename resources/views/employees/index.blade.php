@extends('layouts.project')
@section('search_form')
    <form>
        <div class="form-row align-items-center">
            <div class="col-auto">
                <label class="sr-only" for="inlineFormInput">Name</label>
                <input type="text" name="search" class="form-control mb-2" id="inlineFormInput" placeholder="Search">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </div>
        </div>
    </form>
@endsection
@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Персоны</li>
@endsection
@section('content')
    @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{session()->get('success')}}
                </div>
            </div>
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="?sort=reg_num">Идентификатор</a></th>
            <th scope="col"><a href="?sort=last_name">ФИО</a></th>
            <th scope="col"><a href="?sort=position_title">Должность</a></th>
            <th scope="col"><a href="?sort=count_of_tasks">Количество задач</a></th>
            <th scope="col"><a href="?sort=ages">Возраст</a></th>
            <th scope="col"><a href="?sort=email">Email</a></th>
            <th scope="col"><a href="?sort=phone">Телефон</a></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>

        @foreach($res as $i)
            <tr>
                <td>{{$i->reg_num}}</td>
                <td>{{$i->last_name}} {{$i->first_name}} {{$i->second_name}}</td>
                <td>{{$i->position_title}}</td>
                <td>{{$i->count_of_tasks}}</td>
                <td>{{$i->ages}}</td>
                <td>{{$i->email}}</td>
                <td>{{$i->phone}}</td>
                <td>
                    <form method="GET" action="{{route('employees.edit', $i->id) }}">
                        @csrf
                        <input type="submit" value="Изменить">
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{route('employees.destroy', $i->id) }}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Удалить">
                    </form>
                </td>


            </tr>
        @endforeach
        </thead>
        <tbody>

        </tbody>
    </table>
    <form action="{{route('employees.create')}}">
        @csrf
        <button type="submit" class="btn btn-primary btn-lg active">Добавить</button>
    </form>
    <br><br><br>

    @if($res instanceof Illuminate\Pagination\LengthAwarePaginator && $res->total() > $res->count())
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div clas="card">
                    <div class="card-body">
                        {{$res->links()}}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
