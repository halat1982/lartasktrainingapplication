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
    <li class="breadcrumb-item active" aria-current="page">Справочники</li>
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
    @if($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{$errors->first()}}
                </div>
            </div>
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="?sort=title">Наименование должности</a></th>
            <th scope="col"><a href="?sort=emcount">Количество сотрудников</a></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>

        @foreach($res as $i)
            <tr>
                <td>{{$i->title}}</td>
                <td>{{$i->emcount}}</td>
                <td>
                    <form method="GET" action="{{route('positions.edit', $i->id) }}">
                        @csrf
                        <input type="submit" value="Изменить">
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{route('positions.destroy', $i->id) }}">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{$i->id}}">
                        <input type="submit" value="Удалить">
                    </form>
                </td>


            </tr>
        @endforeach
        </thead>
        <tbody>

        </tbody>
    </table>
    <form action="{{route('positions.create')}}">
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
