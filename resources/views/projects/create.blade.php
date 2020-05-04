@extends('layouts.project')
@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Создать проект</li>
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
    <form method="POST" action="{{route('projects.store')}}">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" name="title" value="{{old('title')}}" id="title" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="alias" class="col-sm-2 col-form-label">Сокращенное название</label>
            <div class="col-sm-10">
                <input type="text" name="alias" id="alias" value="{{old('alias')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-10">
                <input type="text" name="description" id="description" value="{{old('description')}}"
                       class="form-control">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="manager_id">Менеджер</label>
            <select name="manager_id" id="manager_id" class="form-control">
                <option>Выберите менеджера</option>
                @foreach($employeesList as $em)
                    <option value="{{$em->id}}" @if($em->id == old('manager_id')) selected @endif>
                        {{$em->last_name}} {{$em->first_name}} {{$em->second_name}}
                    </option>
                @endforeach

            </select>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </form>
@endsection
