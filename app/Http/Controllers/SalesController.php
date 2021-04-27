<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # O método aqui consiste basicamente em mostrar apenas os usuários
        # que são vendedores por isso buscamos diretamente no profile desse usuário

        $tickets  = User::with('tickets')
            ->where('profile',Ticket::CLIENTE)
            ->get();

        $success = session('success');

        $data = [];

        if(!empty($success)){
            $data=[
                'success' => $success
            ];
        }

        return view('salespeople.index',compact('tickets','data'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('salespeople.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dataForm=$request->except('_token');

        if(!isset($dataForm['status'])){ $dataForm['status'] = '0';}

        $user=User::create([
            'name' => $dataForm['name'],
            'email' => $dataForm['email'],
            'phone' => $dataForm['phone'],
            'status' => $dataForm['status'],
            'profile' =>Ticket::CLIENTE,
            'password' => md5('12345678')
        ]);

        return redirect()->route('salespeople');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sales=User::find($id);

        return view('salespeople.create',compact('sales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataformForm = $request->except('_token');

        $update=User::find($id);

        $update->update($dataformForm);

        return redirect()->route('salespeople');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id)->delete();

        session()->flash('success','Usuário excluido com sucesso');

        return redirect()->route('salespeople');

    }


}
