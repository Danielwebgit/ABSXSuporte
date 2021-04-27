@extends('layouts.tincket')

@section('content')

    <div class="container">
        <h1>Lista de vendedores</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($success->all() as $msg)
                        <li>{{$msg}}</li>
                @endforeach
                </ul>
            </div>
            @endif
        <table class="table table-stripe">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Status</th>
                <th width="100px">Ações</th>
            </tr>
            @foreach($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->name}}</td>
                        <td>{{$ticket->email}}</td>
                        <td>{{$ticket->phone}}</td>
                        <td>{{$ticket->status}}</td>
                        <td>
                            <a href="{{url('sales_destroy',$ticket->id)}}">
                                <span  >[ - ]</span>
                            </a>
                            <a href="{{url('sales_edit',$ticket->id)}}">
                                <span >[ ! ]</span>
                            </a>
                        </td>
                    </tr>
            @endforeach
        </table>

        <a href="{{route('welcome')}}"><button  type="submit" class="btn btn-primary">Sair</button></a>
        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Cadastrar</button>

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
                            <form action="{{route('sales_create')}}" method="POST">
                                @csrf
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required placeholder="Nome" name="name" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" required placeholder="Email" name="email" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required placeholder="Telefone" name="phone" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <label for="">Status: Ativo / Inativo
                                <div class="input-group mb-3">

                                    <input type="checkbox" name="status" value="1" >
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