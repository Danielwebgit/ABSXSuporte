<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jamesh\Uuid\HasUuid;

class Ticket extends Model
{
    const STATUS_OPEN = 'Aberto';
    const STATUS_IN_PROGRESS = 'Em andamento';
    const STATUS_DELAYED = 'Atrasado';
    const STATUS_CLOSED = 'Fechado';

    const CLIENTE= '1';
    const VENDEDOR= '2';
    const TECNICO= '3';

    private $tecnico;

    use HasFactory;

    protected $fillable=['user_id','cliente','subject','description','status','sla'];

    protected $table = "tickets";


    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['cliente']);
    }
}
