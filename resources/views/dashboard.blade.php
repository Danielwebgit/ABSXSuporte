@extends('layouts.tincket')

<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="#">Olá, {{Auth::user()->name}}, Seja bem vindo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

    <table class="table table-stripe">
        <tr>
            <th>Cliente</th>
            <th>Data</th>
            <th>Status</th>
            <th>Iniciar</th>
        </tr>
        @foreach($tickets as $ticket)

                <tr>
                    <td>{{$ticket->cliente}}</td>
                    <td>{{$ticket->created_at}}</td>
                    <td><span style="">{{$ticket->status}}</span></td>
                    <td>
                        @if($ticket->status == \App\Models\Ticket::STATUS_OPEN)
                            <a href="{{route('accept_call',$ticket->id)}}">
                                <span >[ Aceitar ]</span>
                            </a>
                        @endif
                        @if($ticket->status == \App\Models\Ticket::STATUS_IN_PROGRESS)
                            <a href="{{route('finish_call',$ticket->id)}}">
                                <span >[ Finalizar ]</span>
                            </a>
                        @endif
                    </td>

                </tr>

        @endforeach
    </table>
    <a href="{{route('welcome')}}"><button  type="submit" class="btn btn-primary">Sair</button></a>
</div>


