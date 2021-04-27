<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- Styles -->
<link rel="stylesheet" href="{{url('site/css/style.css')}}">

<div class="content">

        <p>Iniciar a sessão com</p>
    <br>
    @if($errors->any())

        <div class="alert-danger" >
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
            </ul>
        </div>

        @endif

    {{--Erros de específicos de login--}}

    @if(isset($erro))
        <p style="color: red;">{{$erro}}</p>
        @endif

    <form action="{{ url('submit_login')}}" method="POST">
        @csrf
    <div class="links">
        <button type="input" value="19" name="id" class="btn btn-xs btn-primary">Felipe</button>

        <button type="input" value="20" name="id" class="btn btn-xs btn-primary">Marcos</button>

        <button type="input" value="21" name="id" class="btn btn-xs btn-primary">João</button>

        <button type="input" value="10" name="id" class="btn btn-xs btn-primary">Maria</button>

    </div>
    </form>
    <a href="{{route('welcome')}}"><button type="button"  class="btn btn-xs btn-info">Voltar</button></a>
</div>