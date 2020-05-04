@extends('layouts.project')
@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item"><a href="{{route('positions.index')}}">Справочники</a></li>
    <li class="breadcrumb-item active" aria-current="page">Добавить должность</li>
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
    <form method="POST" action="{{route('positions.store')}}">
        @csrf
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Наименование должности</label>
            <div class="col-sm-10">
                <input type="text" name="title" value="{{old('title')}}" id="description" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </form>
@endsection
