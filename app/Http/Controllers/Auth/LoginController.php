<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //se reescribe el metodo showLoginForm recibiendo un parametro redirect_to
    //que sirve para redirigir al usuario luego que inicie sesion a la pagina que etaba viendo
    public function showLoginForm( Request $request ) {
        if( $request -> has('redirect_to') ) {
            //se crea una variable de session
            session() -> put( 'redirect_to' , $request -> input('redirect_to' ) );
            $notification = 'Debes registrarte para poder continuar con la compra';
            return view('auth.login') -> with( compact('notification') );
        }
        return view('auth.login');
    }

    //metodo que nos  devuelve a donde estabamos antes de iniciarsession
    //por medio de la variable redirect_to que llega de la vista
    public function redirectTo() {
        if( session() -> has('redirect_to') ) {
            return session() -> pull( 'redirect_to' );
        }
        return $this -> redirect_to;
    }

}
