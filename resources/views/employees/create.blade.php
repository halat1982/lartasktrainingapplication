@extends('layouts.project')
@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Персоны</a></li>
    <li class="breadcrumb-item active" aria-current="page">Добавить персону</li>
@endsection
@section('content')
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
    <form method="POST" action="{{route('employees.store')}}">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Фамилия</label>
            <div class="col-sm-10">
                <input type="text" name="last_name" value="{{old('last_name')}}" id="last_name" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" name="first_name" value="{{old('first_name')}}" id="first_name" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Отчество</label>
            <div class="col-sm-10">
                <input type="text" name="second_name" value="{{old('second_name')}}" id="second_name"
                       class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="start_date" class="col-sm-2 col-form-label">Дата рождения</label>
            <div class="col-sm-6 col-md-6">
                <label for="start_date">Введите дату:</label>
                <input type="date" id="birthday_date" name="birthday_date" value="{{old('birthday_date')}}"
                       class="form-control">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="status" class="col-sm-2 col-form-label">Должность</label>
            <select name="position" id="position" class="form-control">
                <option selected>Выберите статус</option>
                @foreach($positionsList as $pos)
                    <option value='{{$pos->id}}'
                            @if($pos->id == old('position')) selected @endif>{{$pos->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" value="{{old('email')}}" id="email" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Телефон;мобильный</label>
            <div class="col-sm-10">
                <input type="text" name="phone" value="{{old('phone')}}" id="phone" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </form>
@endsection
