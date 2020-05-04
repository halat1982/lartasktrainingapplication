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
    <li class="breadcrumb-item active" aria-current="page">Задачи</li>
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
            <th scope="col"><a href="?sort=alias">Проект</a></th>
            <th scope="col"><a href="?sort=title">Название</a></th>
            <th scope="col"><a href="?sort=start_date">Дата начала</a></th>
            <th scope="col"><a href="?sort=finish_date">Дата окончания</a></th>
            <th scope="col"><a href="?sort=rate_time">Оценочное время (часов)</a></th>
            <th scope="col">Исполнитель</th>{{--Don't sorting--}}
            <th scope="col"><a href="?sort=dh">Количество часов перевыполнения/остатка</a></th>
            <th scope="col"><a href="?sort=stat">Статус</a></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>

        @foreach($res as $i)
            <tr>
                <td>{{$i->reg_num}}</td>
                <td>{{$i->alias}}</td>
                <td>{{$i->title}}</td>
                <td>{{$i->start_date}}</td>
                <td>{{$i->finish_date}}</td>
                <td>{{$i->rate_time}}</td>
                <td>{{$i->last_name}} {{$i->first_name}} {{$i->second_name}}</td>
                <td>{{$i->dh}}</td>
                <td>{{$i->stat}}</td>
                <td>
                    <form method="GET" action="{{route('tasks.edit', $i->id) }}">
                        @csrf
                        <input type="submit" value="Изменить">
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{route('tasks.destroy', $i->id) }}">
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
    <form action="{{route('tasks.create')}}">
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
