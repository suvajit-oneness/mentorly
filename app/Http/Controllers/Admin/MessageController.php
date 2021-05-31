<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageLog;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function allMessages(){
        $messages = MessageLog::with('user', 'mentor')->get();
        // dd($messages->first()->mentor);
        return view('admin.messages',compact('messages'));
    }

    public function delete($id){
        $deleteMessage = MessageLog::find($id)->delete();
        if (!$deleteMessage) {
            return $this->responseRedirectBack('Error occurred while deleting message.', 'error', true, true);
        }
        return $this->responseRedirect('admin.message.index', 'Message deleted successfully' ,'success',false, false);
    }
}
