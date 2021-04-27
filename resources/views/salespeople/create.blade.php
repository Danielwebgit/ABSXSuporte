@extends('layouts.tincket')

@section('content')
    <div class="container">
        <h1>Editando o vendedor</h1>
        <form action="{{route('sales_update',$sales->id)}}" method="POST">
            @csrf
            <div class="form-group">
                <br>
                <input  type="text" class="form-control" value="{{$sales->name}}" name="name" placeholder="Nome">

            </div>
            <div class="form-group">
                <br>
                <input  type="email" class="form-control"  value="{{$sales->email}}" name="email" placeholder="Email">

            </div>
            <div class="form-group">
                <br>
                <input  type="cel" class="form-control"  value="{{$sales->phone}}" name="phone" placeholder="Telefone">

            </div>

            <div class="form-group">
                <br>
                <input  type="checkbox"  name="status" value="1" @if(isset($sales) &&  $sales->status == '1') checked @endif >
                Status:
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Voltar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>

        </form>


@endsection