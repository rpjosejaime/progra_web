<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'RFC' => ['required', 'string', 'max:13'],
            'nombre' => ['required', 'string', 'max:255'],
            'ap_paterno' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'RFC' => $data['RFC'],
            'nombre' => $data['nombre'],
            'ap_paterno' => $data['ap_paterno'],
            'ap_materno' => $data['ap_materno'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function createUser(Request $request)
    {
        $data = $request->all();
        return $data;
        $password = Hash::make($request->txtpassword);

        try {
            $sql = DB::insert("insert into users (RFC, nombre, ap_paterno, ap_materno, email, password)values(?,?,?,?,?,?) ", [
                $request->txtrfc,
                $request->txtnombre,
                $request->txtapepaterno,
                $request->txtapematerno,
                $request->txtemail,
                $password

            ]);

            $user = User::where('RFC', $request->txtrfc)->first();
            DB::table('model_has_roles')->insert([
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => $user->id,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        $datos = User::all();
        $correcto = '';
        $incorrecto = '';
        if ($sql) {
            return back()->with("Correcto", "Prefecto registrado correctamente");
            //$mensaje = 'Prefecto registrado correctamente';
            //return view('prefectura.prefectos', compact('datos','correcto'));
        } else {
            return back()->with("Incorrecto", "Error al registrar");
            //$mensaje = 'Error al registrar';
            //return view('prefectura.prefectos', compact('datos','incorrecto'));
        }
    }

    public function updatePrefecto(Request $request, $RFC)
    {
        //$data = $request->all();
        //return $data;
        try {
            $sql = DB::table('users')
                ->where('RFC', $request->txtRFC)
                ->update([
                    'nombre' => $request->txtnombre,
                    'ap_paterno' => $request->txtap_paterno,
                    'ap_materno' => $request->txtap_materno,
                    'email' => $request->txtEmail
                    //'password' => Hash::make($request->txtpassword)
                ]);

            //return $sql;

            if ($sql) {
                return back()->with("Correcto", "Prefecto modificado correctamente");
            } else {
                return back()->with("Incorrecto", "Error al modificar, verifique los datos a actualizar");
            }
        } catch (\Throwable $th) {
            return back()->with("Incorrecto", "Error al modificar entro al try");
        }
    }

    public function delete($RFC)
    {
        try {
            $sql = DB::table('users')->where('RFC', $RFC)->delete();
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("Correcto", "Prefecto eliminado correctamente");
        } else {
            return back()->with("Incorrecto", "Error al eliminar");
        }
    }
}
