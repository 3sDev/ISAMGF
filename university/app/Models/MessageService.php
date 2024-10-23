<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MessageService extends Model
{
    use HasFactory;

    // public function userSender()
    // {   //relation user / messageService
    //     return $this->belongsTo('App\Models\User', 'user_sender_id');
    // }

    // public function userReceiver()
    // {   //relation user / messageService
    //     return $this->belongsTo('App\Models\User', 'user_receiver_id');
    // }
    
    // public function messageusers()
    // {
    //     return $this->belongsTo('App\Models\MessageServiceUser');
    // }

    public function users()
    {   //relation user / message
        return $this->belongsToMany('App\Models\User', 'message_service_users', 'message_services_id', 'user_sender_id', 'user_receiver_id')
        ->withPivot('id', 'message_services_id', 'user_sender_id', 'user_receiver_id');
    }
}
// SELECT DISTINCT(u.id), m.id as messageId, m.objet as objet, m.message as message, m.fichier as fichier, m.user_sender_id as senderId, m.user_receiver_id as receiverId, m.created_at as createdMessage, u.name as userName, u.email as userUmail, u.role as userRole, d.departmentLabel as userDepartement FROM users as u inner join message_services as m INNER JOIN departements as d WHERE (u.id = m.user_sender_id or u.id = m.user_receiver_id) and u.departement_id = d.departmentLabel;
