@extends('layout.layout')
@section('content')
@section('title',$one_organization->displayName)
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
        <div class="row">
            <div class="col-md-3">
                {{--О оргонизации--}}
                <div class="block org_block">
                    <p><b>{{$one_organization->displayName}}</b></p>
                        <ul>
                            <li><b>ОГРН:</b> {{$one_organization->ogrn}}</li>
                            <li><b>ОКТМО:</b> {{$one_organization->oktmo}}</li>
                        </ul>
                </div>
                {{--Добавить пользователя организации--}}
                <div class="add_block block">
                    <p><b>Добавить работника</b></p>
                    <br>
                    {!! Form::open(['action' => ['WorkerController@save','id'=>$one_organization->id],'method'=>'post']) !!}
                    <div class="form-group">
                        <p>{{Form::label('firstname','Имя: ')}}</p>
                        {{Form::text('firstname','',['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        <p>{{Form::label('middlename','Фамилия: ')}}</p>
                        {{Form::text('middlename','',['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        <p>{{Form::label('lastname','Отчество: ')}}</p>
                        {{Form::text('lastname','',['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        <p>{{Form::label('birthday','Дата рождения: ')}}</p>
                        {{Form::date('birthday','',['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        <p>{{Form::label('inn','ИНН: ')}}</p>
                        {{Form::number('inn','',['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        <p>{{Form::label('snils','СНИЛС: ')}}</p>
                        {{Form::number('snils','',['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::submit('Отправить',['class'=>'btn btn-primary btn-block'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="col-md-9">
                <div class="block">
                    <p><b>Работники</b></p>
                    <ul>
                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th>#</th>
                                <th>Имя</th>
                                <th>Фамилия</th>
                                <th>Отчество</th>
                                <th>ИНН</th>
                                <th>СНИЛС</th>
                                <th>Ещё</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($one_organization->workers as $worker)
                                <tr>
                                    <th scope="row">{{$loop->index+1}}</th>
                                    <td>{{$worker->firstname}}</td>
                                    <td>{{$worker->middlename}}</td>
                                    <td>{{$worker->lastname}}</td>
                                    <td>{{$worker->inn}}</td>
                                    <td>{{$worker->snils}}</td>
                                    <td>
                                        <a href="{{url('worker',[$worker->id])}}" class="view"><i class="fab fa-readme"></i></a>
                                        {!! Form::open(['action' => ['WorkerController@delete',$worker->id,$one_organization->id],'method'=>'post']) !!}
                                        {{Form::submit('',['class'=>'btn trash'])}}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection