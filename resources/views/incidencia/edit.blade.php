@extends('layouts.app')
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<link rel="stylesheet"
href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@section('content')
<div class="container" style="padding-left: 90px; padding-right: 90px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background: -webkit-linear-gradient(left, #3366cc , white); color: #ffffff">Dashboard</div>

        <div class="panel-body">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="" method="POST">
                {{ csrf_field() }}
                @if(auth()->user()->rdbtrol ==0)
                <div class="form-group">
                    <div class="form-group">
                        <select class="form-control" id="select-user" name="user_id">
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->rdbtnombre}}&nbsp; {{$user->rdbtapellido}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
@endif
                <div class="form-group">
                    <label for="equipo">EQUIPO</label>
                    <select name="equipo" class="form-control" id='equipo' readonly="readonly">
                        @foreach($equipos as $equipo)
                        <option value="{{$equipo->id}}" @if($incident->equipo_id==$equipo->id) selected @endif  >{{$equipo->rdbtEquipo->rdbtnombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="severity">Severidad</label>
                    <select name="severity" class="form-control" readonly="readonly">
                        <option value="M" @if($incident->severity=='M') selected @endif >Menor</option>
                        <option value="N" @if($incident->severity=='N') selected @endif>Normal</option>
                        <option value="A" @if($incident->severity=='A') selected @endif>Alta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title',$incident->title) }}" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" class="form-control" readonly="readonly">{{ old('description',$incident->description) }}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
