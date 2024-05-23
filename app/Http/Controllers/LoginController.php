<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Redirect;
use Hash;
class LoginController extends Controller
{
    public function login(Request $request)
    {        

        $data = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        $userValidator = $this->validadorCred($data['email'],$data['password']);
        
        if($userValidator[0] == '1'){         
            return back()->with('error', $userValidator[1]);   
            // return ['falha',$userValidator[1]];
        }
        $check = $userValidator[1];
        
        $check = User::where('email',$data['email'])->first();
        if(empty($check)){
            
            return ['falha','Email e/ou Senha incorretos'];
        }else{     
            //dd(['email' => $data['email'], 'password' => $data['password']]);
            if(Hash::check($data['password'], $check->password)){       
                if(Auth::attempt($data)){
                    $request->session()->regenerate();                        
                    return redirect()->intended('inicio');
                }  
            }    
        }
    }

    public function logout(){        
        Auth::logout();
        return redirect()->route('index');
    }
    
    public function index()
    {        
        return view('login');
    }

    protected function validadorCred($email,$senha){        
        $check = User::where('email',$email)->first();         
        $msg[0]='0';       
        $msg[1]=$check;
        //caso nao ache o  email
        if(empty($check)){
            $msg[0]='1';
            $msg[1]='Email não encontrado';
        }
        //caso nao ache a senha
        if(!empty($senha)){
            if(strlen($senha) < 3){
                $msg[0]='1';
                $msg[1] = 'É necessário no mínimo 3 caracteres na senha!';
            }else if(strlen($senha) > 6){
                $msg[0]='1';
                $msg[1] = 'É no máximo 6 caracteres no senha!';
            }           
        }else{
            $msg[0]='1';
            $msg[1] = 'O campo Senha é obrigatorio';
        }
        return $msg;
    }

}
