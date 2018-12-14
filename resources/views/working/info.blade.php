@extends('layout.layout')
@section('title',$one_user->firstname.' '.$one_user->middlename)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="block org_block">
                    <a href="{{url('worker/delete',[$one_user->id,$one_user->organization->id])}}" title="Удалить работника?" class="close">х</a>
                    <p><b>Просмотр данных работника организации {{$one_user->organization->name}}</b></p>
                     <ul>
                         <li><b>Фамилия: </b> {{$one_user->firstname}}</li>
                         <li><b>Имя: </b> {{$one_user->middlename}}</li>
                         <li><b>Отчество: </b> {{$one_user->lastname}}</li>
                         <li><b>Дата рождения: </b> {{$one_user->birthday}}</li>
                         <li><b>ИНН: </b> {{$one_user->inn}}</li>
                         <li><b>СНИЛС: </b> {{$one_user->snils}}</li>
                     </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block org_block">
                    <p><b>Предприятие</b></p>
                    <ul>
                        <li><b>Название:</b> {{$one_user->organization->name}}</li>
                        <li><b>ОГРН:</b> {{$one_user->organization->ogrn}}</li>
                        <li><b>ОКТМО:</b> {{$one_user->organization->oktmo}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

