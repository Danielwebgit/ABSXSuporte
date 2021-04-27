@extends('layouts.tincket')

@section('content')
<div class="container">
    <h1>Editando o chamado</h1>
    <form  method="POST" action="{{url('sales_update',$idSale->id)}}">
        @csrf
        <div class="form-group">
            <br>
            <input  type="text" class="form-control" name="name" placeholder="nome">

        </div>
        <div class="form-group">
            <br>
            <input  type="text" class="form-control" name="subject" placeholder="Assunto">

        </div>
        <br>
        <div class="form-group">
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" id="" cols="30" rows="10"></textarea>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Salvar</button>

        <a href="#"><button type="button" class="btn btn-primary">Voltar</button></a>

    </form>

    @endsection