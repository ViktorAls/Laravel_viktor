@extends('layout.layout')
@section('title','Все организации')
@section('content')
    <style>
        .trash{
            background: url('https://img.icons8.com/ios-glyphs/30/000000/close-window.png') top left no-repeat;
            background-size: 1.4em;
        }

        .view{
            background-size: 1.4em;
            float: left;
        }


    </style>
    <div class="container">
        <br>
        <div class="row">
            {{--XML ЗАГРУЗКА--}}
            <div class="col-md-1 offset-md-10">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-md">Загрузка файлов XML</button>

                <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-dialog modal-md">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Загрузка данных через XML</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        {!! Form::open(['action' => ['CompanyController@index'],'method'=>'post','files' => true]) !!}
                                        {{ Form::file('file',['name'=>'file','class'=>'btn btn-primary btn-sm btn-block']) }}
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <span>{{ Form::radio('option', 'db', true)}}Проверка базой</span>
                                        <span class="float-right">{{ Form::radio('option', 'array', false)}}Проверка массивом</span>
                                    </div>
                                    <div class="col-md-12">
                                        {{ Form::submit('Обработать файл',['class'=>'btn btn-primary btn-block btn-sm','name'=>'ok'])}}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                   </div>
                </div>

            </div>
            <div class="col-md-12">
                <br>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Название фирмы</th>
                <th>ОГРН</th>
                <th>ОКТМО</th>
                <th>Рабочие</th>
                <th>Функции</th>
            </tr>
            </thead>
            <tbody>
            @foreach($all as $one)
            <tr>
                <th scope="row">{{$one->id}}</th>
                <td>{{$one->displayName}}</td>
                <td>{{$one->ogrn}}</td>
                <td>{{$one->oktmo}}</td>
                <td>{{count($one->workers)}}</td>
                <td>
                    <a href="{{url('organization',[$one->id])}}" class="view"><i class="fab fa-readme"></i></a>
                    {!! Form::open(['action' => ['CompanyController@delete','id'=>$one->id],'method'=>'post']) !!}
                    {{Form::submit('',['class'=>'btn trash'])}}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        </div>
        </div>
        {{$all->links()}}
    </div>
@endsection