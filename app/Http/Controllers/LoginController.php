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
    public function index(Request $request)
    {
        if ($request->user == "adm@gmail.com") {
            //$request->session()->regenerate();
            return route();
        }

        $data = [
            'email'=>$request->user,
            'password'=>$request->password
        ];

        $userValidator = $this->validadorCred($data['email'],$data['password']);
        
        if($userValidator[0] == '1'){            
            return ['falha',$userValidator[1]];
        }
        $check = $userValidator[1];
        
        //$check = User::where('email',$data['email'])->first();
        if(empty($check)){
            
            return ['falha','Email e/ou Senha incorretos'];
        }else{     
            if(Hash::check($data['password'], $check->password)){       
                if(Auth::attempt($data)){
                    //dd(['email' => $data['email'], 'password' => $data['password']]);
                    $request->session()->regenerate();                        
                    return ['sucesso',route('inicio')];
                }  
            }    
        }
    }

    public function logout(){        
        Auth::logout();
        return redirect()->route('login');
    }

    protected function validadorCred($email,$senha){        
        $check = User::where('email',$email)->first();         
        $msg[0]='0';       
        $msg[1]=$check;
        //caso nao ache o  email
        if(empty($check)){
            $msg[0]='1';
            $msg[1] = 'Email não encontrado';
        }
        //caso nao ache a senha
        if(!empty($senha)){
            if(strlen($senha) < 6){
                $msg[0]='1';
                $msg[1] = 'É necessário no mínimo 6 caracteres na senha!';
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
