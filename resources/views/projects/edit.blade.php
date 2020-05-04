@extends('layouts.project')
@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Изменить проект</li>
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
    <form method="POST" action="{{route('projects.update', $project->id)}}">
        @method('PATCH')
        @csrf

        <div class="form-group row">
            <label for="reg_num" class="col-sm-2 col-form-label">Номер проекта</label>
            <div class="col-sm-10">
                {{$project->reg_num}}
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" name="title" id="title" value="{{old('title', $project->title)}}"
                       class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="alias" class="col-sm-2 col-form-label">Сокращенное название</label>
            <div class="col-sm-10">
                <input type="text" name="alias" value="{{old('alias', $project->alias)}}" id="alias"
                       class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-10">
                <input type="text" name="description" value="{{old('description', $project->description)}}"
                       id="description" class="form-control">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="manager_id">Менеджер</label>
            <select name="manager_id" id="manager_id" class="form-control">
                <option>Выберите менеджера</option>
                @foreach($employeesList as $em)
                    <option value="{{$em->id}}" @if($em->id == old('manager_id', $project->manager_id)) selected @endif>
                        {{$em->last_name}} {{$em->first_name}} {{$em->second_name}}
                    </option>
                @endforeach

            </select>
        </div>
        <div class="form-group row">
            <label for="register_date" class="col-sm-2 col-form-label">Дата регистрации</label>
            <div class="col-sm-10">
                {{$project->register_date}}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Изменить</button>
            </div>
        </div>
    </form>
@endsection
