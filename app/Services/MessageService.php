<?php 

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Message;
use Carbon\Carbon;

class MessageService{



    public function sawMessageWithid($msg_id)
	{
        DB::table('messages')
            ->where('id', $msg_id)
            ->update([
                'seen' => 1
            ]);
	}

    public function getMessageWithid($msg_id)
	{
		$msg = DB::table('messages')->where('id','=',$msg_id)->first();

        $sender = DB::table('users')->where('user_name','=',$msg->sender_id)->first();
        $resiver = DB::table('users')->where('user_name','=',$msg->receiver_id)->first();

        $data =[
            'msg' => $msg,
            'sender' => $sender,
            'resiver' => $resiver,
        ];
        return $data;
	}

     public function sendMessages(Request $request)
	{
		$message = new Message;

        $message->title = $request->smsgtitle;
        $message->message = $request->smsgbody;
        $message->sender_id = $request->smsgsender;
        $message->receiver_id = $request->smsgreceiver;
        $message->save();
	}


    public function deleteMessageWithid($deleter,$msg_id)
	{
        DB::table('messages')
            ->where('id', $msg_id)
            ->update([
                $deleter.'_available' => 0
               
            ]);
	}

}