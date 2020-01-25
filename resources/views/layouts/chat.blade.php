<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<link rel="stylesheet"
href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<div class="container" style="padding-left: 90px; padding-right: 90px;">

<div class="panel panel-info">
    <div class="panel-heading" style="background: -webkit-linear-gradient(left, green , white); color: #ffffff">
        <h3 class="panel-title">Discusión</h3>
    </div>
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
        <ul class="media-list">
           
             @foreach ($messages as $message)
            <li class="media">
                <div class="media-body">
                    <div class="media">
                        <a class="pull-left" href="#" >
                            <img class="media-object img-circle" src="{{ $message->user->avatar_path }}" width="48">
                        </a>
                        <div class="media-body">
                            {{ $message->rdbtmessage }}
                            <br>
                            <small class="text-muted">{{$message->user->rdbtnombre }} | {{ $message->created_at }}</small>
                       <hr>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="panel-footer">
        <form action="/mensajes" method="post">
            {{csrf_field()}}
            <input type="hidden" name="rdbt_asignacion_id" value="{{$incident->id}}" >
            <div class="input-group">
            <input type="text" class="form-coontrol" name="message" style="width: 800px;" placeholder="Escriba su mensaje">
            <span class="input-group-btn">
                <button class="btn btn-dark" type="submit">Enviar</button>
            </span>
        </div>
        </form>
        
    </div>
</div>
</div>