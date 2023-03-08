<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class AiController extends Controller
{
    function index(){
        $messages = collect(session('messages', []))->reject(fn ($message) => $message['role'] === 'system');

    return view('welcome', [
        'messages' => $messages
    ]);

    }

    function search(Request $request){
        $messages = $request->session()->get('messages', [
            ['role' => 'system', 'content' => 'You are LaravelGPT - A ChatGPT clone. Answer as concisely as possible.']
        ]);
    
        $messages[] = ['role' => 'user', 'content' => $request->input('message')];
    
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages
        ]);
    
        $messages[] = ['role' => 'assistant', 'content' => $response->choices[0]->message->content];
    
        $request->session()->put('messages', $messages);
    
        return redirect('/');
    }

    function reset(Request $request){
        $request->session()->forget('messages');
    return redirect('/');
    }
}
