@extends('layouts.project')
@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item"><a href="{{route('tasks.index')}}">Задачи</a></li>
    <li class="breadcrumb-item active" aria-current="page">Изменить задачу</li>
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
    <form method="POST" action="{{route('tasks.update', $task->id)}}">
        @method('PATCH')
        @csrf
        <div class="form-group row">
            <label for="reg_num" class="col-sm-2 col-form-label">Идентификатор</label>
            <div class="col-sm-10">
                {{$task->reg_num}}
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="project_id" class="col-sm-2 col-form-label">Проект</label>
            <select name="project_id" id="project_id" class="form-control">
                <option value="" selected>Выберите проект</option>
                @foreach($projectsList as $proj)
                    <option value='{{$proj->id}}'
                            @if($proj->id == old('project_id', $task->project_id)) selected @endif>{{$proj->alias}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" name="title" value="{{old('title', $task->title)}}" id="title" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description" id="description"
                          placeholder="Описание задачи">{{old('description', $task->description)}}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="start_date" class="col-sm-2 col-form-label">Дата начала</label>
            <div class="col-sm-6 col-md-6">
                <label for="start_date">Введите дату:</label>
                <input type="date" id="start_date" name="start_date" value="{{old('start_date', $task->start_date)}}"
                       class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="finish_date" class="col-sm-2 col-form-label">Дата окончания</label>
            <div class="col-sm-6">
                {{$task->finish_date}}
            </div>
        </div>
        <div class="form-group row">
            <label for="rate_time" class="col-sm-2 col-form-label">Оценочное время</label>
            <div class="col-sm-10">
                <input type="number" name="rate_time" value="{{old('rate_time', $task->rate_time)}}" id="rate_time"
                       class="form-control">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="status" class="col-sm-2 col-form-label">Статус</label>
            <select name="status" id="status" class="form-control">
                <option selected>Выберите статус</option>
                @foreach($statusesList as $stat)
                    <option value='{{$stat->id}}'
                            @if($stat->id == old('status', $task->status)) selected @endif>{{$stat->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="manager_id">Исполнитель</label>
            <select name="employee_id[]" multiple id="employee_id" class="form-control">

                @foreach($employeesList as $em)
                    <option value="{{$em->id}}"
                            @foreach(old('employee_id', $emplIDs) as $oldID)
                            @if($em->id == $oldID) selected break;@endif
                        @endforeach
                    >
                        {{$em->last_name}} {{$em->first_name}} {{$em->second_name}}
                    </option>
                @endforeach

            </select>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" @if($task->status == 3) disabled @endif>Изменить</button>
            </div>
        </div>
    </form>
@endsection
