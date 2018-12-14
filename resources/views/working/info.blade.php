@extends('layout.layout')
@section('title',$oneUser->firstname.' '.$oneUser->middlename)
@section('content')
    <style>
        .trash{
            background: url('https://img.icons8.com/ios-glyphs/30/000000/close-window.png') top left no-repeat;
            background-size: 1.4em;
            float: right;
            margin-top:-25px;
            margin-left: -10px;

        }

        .view{
            background-size: 1.4em;
            float: left;
        }

    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="block org_block">
                    <p>
                        <b>Просмотр данных работника организации {{$oneUser->organization->name}}</b>
                        {!! Form::open(['action' => ['WorkerController@delete',$oneUser->id,$oneUser->organization->id],'method'=>'post']) !!}
                        {{Form::submit('',['class'=>'btn trash '])}}
                        {!! Form::close() !!}
                    </p>
                     <ul>
                         <li><b>Фамилия: </b> {{$oneUser->firstname}}</li>
                         <li><b>Имя: </b> {{$oneUser->middlename}}</li>
                         <li><b>Отчество: </b> {{$oneUser->lastname}}</li>
                         <li><b>Дата рождения: </b> {{$oneUser->birthday}}</li>
                         <li><b>ИНН: </b> {{$oneUser->inn}}</li>
                         <li><b>СНИЛС: </b> {{$oneUser->snils}}</li>
                     </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block org_block">
                    <p><b>Предприятие</b></p>
                    <ul>
                        <li><b>Название:</b> {{$oneUser->organization->name}}</li>
                        <li><b>ОГРН:</b> {{$oneUser->organization->ogrn}}</li>
                        <li><b>ОКТМО:</b> {{$oneUser->organization->oktmo}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

