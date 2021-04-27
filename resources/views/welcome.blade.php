@extends('layouts.tincket')
@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <!--<a href="{{ route('register') }}">Register</a>--->
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            ABSX Suporte
        </div>

        <div class="links">
            <a href="https://github.com/Danielwebgit"><button type="button" class="btn btn-xs btn-primary">GitHub</button></a>
            <a href="{{route('salespeople')}}"><button type="button" class="btn btn-xs btn-primary">Vendedor</button></a>
            <a href="{{route('call_lists')}}"><button type="button" class="btn btn-xs btn-primary">Chamados</button></a>
            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal">Informações</button>
            <a href="{{url('acessar')}}"><button type="button" class="btn btn-xs btn-primary">Iniciar</button></a>
        </div>
    </div>

        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Informações:</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-content">
                        <div class="modal-header">
                            Funcionários: felipe | marcos | joao
                        </div>
                        <div>

                    <!-- Modal body -->
                        <div class="modal-body">
                            No total são 20 usuários cadastrados no sistema,
                            cada usuário possui seu próprio papel.
                            São três funcionários, Felipe, Marcos e João. Os outros
                            usuários são clientes da empresa.
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
@endsection

