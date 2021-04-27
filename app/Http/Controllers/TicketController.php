<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form_login()
    {
        $erro = session('erro');

        $data = [];

        if(!empty($error)){
            $data=[
                'erro' => $erro];
        }

        return view('login.index',compact('erro'));
    }

    /**
     * Display the specified resource.
     *@param  \Illuminate\Http\Request  $request
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function submit_login(Request $request)
    {

        $dataForm = $request->except('_token');


        $user=User::where('id',$dataForm['id'])->first();

        if($user == null){
           session()->flash('erro','Não existe o cadastro desse funcionário');
           return redirect()->route('acessar');
        }

        $email =$user['email'];


        if (Auth::attempt(['email' => $email, 'password' => '12345678']))
        {
            return redirect()->intended('dashboard');
        }

        if(!$user){
            session()->flash('erro',['Funcionários inativo']);
            return redirect()-route('acesso');
        }

        return view('login.index');

    }
    
    public function index()
    {

        $dataAtual = new \DateTime("UTC");


        $tickets  = User::with('tickets')->get();


        return view('ticket.index',compact('tickets'));

    }

    public function dashboard()
    {

        $idUser = Auth::user()->id;

        $tickets=Ticket::where('user_id',$idUser)->get();


        return view('dashboard',compact('tickets'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status=['Aberto', 'Em andamento', 'Atrasado', 'Resolvido'];
        return view('ticket.create',compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {

        $data = new \DateTime("UTC");
        $data=Carbon::parse($data)->format(' H:i:s');

        $data = (strtotime($data) + strtotime('24'));
        $sls=date('Y-m-d H:i:s',$data);

        $dataForm = $request->except('_token');

        Ticket::create([
           'subject' => $dataForm['subject'],
            'user_id' => $this->in_min_call(),
           'sla' => $sls,
           'cliente' => $dataForm['cliente'],
           'description' => $dataForm['description'],
           'status' => Ticket::STATUS_OPEN,
        ]);
        return redirect()->route('call_lists');

    }

    /*
     * Método que vai recebe todos os técnicos com menor chamado em
     * aberto
     * */

    public function in_min_call(){

        $qtd_calls = User::select("qtdy_tickets_open")->where('profile',Ticket::TECNICO)
            ->min('qtdy_tickets_open');


        $tecnico=User::where('qtdy_tickets_open', $qtd_calls)->orderBy('updated_at', 'desc')->first();


        $total = $qtd_calls + 1;

         $update=User::find($tecnico['id']);
         $update->qtdy_tickets_open = $qtd_calls + 1;
         $update->save();


        return $tecnico['id'];

    }

    public function accept_call($id)
    {

        $ticket = Ticket::find($id);

        $ticket->update([
            'status' => Ticket::STATUS_IN_PROGRESS
        ]);

        $tecnico = User::find(Auth::user()->id)->first();

        $user=User::find($tecnico['id']);
        $user->qtdy_tickets_open = $tecnico['qtdy_tickets_open'] - 1;
        $user->qtdy_tickets_progress = $tecnico['qtdy_tickets_progress'] + 1;
        $user->update();

        return redirect()->route('dashboard');

    }


    public function finish_call($id)
    {


        $ticket=Ticket::where('id',$id)->first();


        $ticket->update([
            'status' => Ticket::STATUS_CLOSED
        ]);

        $tecnico = User::where('id',Auth::user()->id)->first();

        $user=User::find($tecnico['id']);
        $user->qtdy_tickets_progress = $tecnico['qtdy_tickets_progress'] - 1;
        $user->qtdy_tickets_close = $tecnico['qtdy_tickets_close'] + 1;
        $user->update();


        return redirect()->route('dashboard');

    }

    public function delayed_call($id)
    {

        //Esse método é para criar o sla

    }


    /**
     * Display the specified resource.
     *@param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $calls=Ticket::find($id);
        return view('ticket.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataform=User::find($id);
        dd($dataform);
        return view('ticket.create');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
