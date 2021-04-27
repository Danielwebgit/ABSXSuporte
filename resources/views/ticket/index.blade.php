@extends('layouts.tincket')

@section('content')

    <div class="container">
        <h1>Lista com todos os chamados</h1>

        <table class="table table-stripe">
            <tr>
                <th>Cliente</th>
                <th>Técnico</th>
                <th> Data</th>
                <th>Status</th>
            </tr>
            @foreach($tickets as $ticket)
                @foreach($ticket['tickets'] as $row)
            <tr>
                <td>{{$row->cliente}}</td>
                <td>{{$ticket->name}}</td>
                <td>{{$row->created_at}}</td>
                <td>
                    @if($row->status == \App\Models\Ticket::STATUS_OPEN)
                    <a href="{{route('accept_call',$row->id)}}">
                        <span >[ Aceitar ]</span>
                    </a>
                    @endif
                        @if($row->status == \App\Models\Ticket::STATUS_IN_PROGRESS)
                            <a href="{{route('ticket_view',$row->id)}}">
                                <span >[ Finalizar ]</span>
                            </a>
                        @endif
                </td>

            </tr>
                @endforeach
            @endforeach
        </table>

        <a href="{{route('welcome')}}"><button  type="submit" class="btn btn-primary">Sair</button></a>
        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Iniciar Chamado</button>

        <div class="modal fade" id="exampleModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Entrar com os dados:</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-content">
                        <div>

                            <!-- Modal body -->
                            <form action="{{route('ticket_create')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" required placeholder="Nome" name="cliente" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" required placeholder="Assunto" name="subject" aria-describedby="basic-addon1">
                                    </div>

                                        <div class="form-group">
                                            <label for="comment">Descrição:</label>
                                            <textarea name="description" class="form-control" rows="5" id="comment"></textarea>

                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info" >Salvar</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


    </div>
@endsection