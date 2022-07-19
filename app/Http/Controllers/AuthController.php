<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * @group  Auth management
 *
 * APIs for managing   Auth users
 *
 *
 */
class AuthController extends Controller
{


    /**
     * Register in the user.
     *
     * @bodyParam   name    string  required    The name of the  user.      Example: zeyad
     * @bodyParam   email    string  required    The email of the  user.      Example:zeyad.hawash@averotec.sa
     * @bodyParam   password    string  required    The password of the  user.   Example: secret
     * @bodyParam   password_confirmation    string  required    The password_confirmation of the  user.   Example: secret
     * @bodyParam   user_role    string  required    The role of the  user.      Example: admin
     * @bodyParam   city_id    string      The  birth_date of the  user.   Example:1
     * @bodyParam photo file  The image.
     * @bodyParam birth_date date_format  The .
     * @bodyParam   phone    string      The name of the  user.      Example: 123456789
     *
     * @response {
     *  "user": "{ email:testuser@example.com,name :testuser,passwor:secret }",
     *  "token": "...re@23ds&f",
     * }
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'phone' => 'numeric|digits_between:9,15',
            'password' => 'required|string|confirmed',
            'user_role' => 'required|string'  ,
                  'birth_date' => 'date_format:Y-m-d',


        ]);
        $city_id = "";
        $photo = "";
        $birth_datep = "";
        $phone ="";


        if ($request->has('city_id')) {
            $city_id = $request['city_id'];
        }
        if ($request->has('photo')) {
        $photo = $request['photo'];
        }
        if ($request->has('birth_date')) {
            $birth_datep = $request['birth_date'];
        }
        if ($request->has('phone')) {
            $phone = $request['phone'];
        }



        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'password' => bcrypt($fields['password']),
            'user_role' => $fields['user_role'],
            'city_id' => $request['city_id'],
            'photo' => $request['photo'],
            'birth_datep' => $request['birth_datep'],
            'phone' => $request['phone'],

        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Register in the user by social_media .
     *
     * @bodyParam   email    string  required    The email of the  user.      Example:zeyad.hawash@averotec.sa
     * @bodyParam   id    string  required    The email of the  user.      Example:2
     * @bodyParam   name    string  required    The name of the  user.      Example: zeyad
     * @bodyParam   password    string  required    The password of the  user.   Example: secret
     * @bodyParam   password_confirmation    string  required    The password_confirmation of the  user.   Example: secret
     * @response {
     *  "user": "{ email:testuser@example.com,name :testuser,passwor:secret }",
     *  "token": "...re@23ds&f",
     * }
     */
    public function register_login_social_media(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'string|email',
            'id' => 'string|required'

        ]);


        // Check email
        $user = User::where('social_media_id', $fields['id'])->first();

        if ($user != null) {

            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
        }
        if ($request->has('email')) {

            $password = Str::random(8);
            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' =>  bcrypt($password),
                'social_media_id' => $fields['id'],
                'role' => "user",
                'nick_name' => $fields['name'],
            ]);
        } else {
            $password = Str::random(8);
            $user = User::create([
                'name' => $fields['name'],
                'social_media_id' => $fields['id'],
                'password' =>  bcrypt($password),
                'role' => "user",
                'nick_name' => $fields['name'],
            ]);
        }


        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);




        return response([
            'success' => 'false',
            'message' => 'please send email or id'

        ], 401);
    }

    /**
     *
     *  login User socil media
     *
     * @bodyParam   email    string  required    The email of the  user.      Example:zeyad.hawash@averotec.sa
     *
     */
    public function login_social_media(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    /**
     *
     * login User
     *
     * @bodyParam   email    string  required    The email of the  user.      Example:zeyad.hawash@averotec.sa
     * @bodyParam   password    string  required    The password of the  user.   Example: secret
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    /**
     * logout a user
     *
     *
     * @authenticated
     *
     */
    public function logout(Request $request)
    {

        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return [
            'message' => 'Logged out'
        ];
    }



    /**
     * Update in the user by update profile .
     * @authenticated
     * @bodyParam   email    string  required    The email of the  user.      Example:zeyad.hawash@averotec.sa
     * @bodyParam   name    string  required    The name of the  user.      Example: zeyad
     * @bodyParam   phone    string  required    The password of the  user.   Example: secret
     * @response {
     *  "user": "{ email:testuser@example.com,name :testuser,passwor:secret }",
     * }
     */


    public function  update(Request $request)
    {
        $fields = $request->validate([
            'email' => 'string|email',
            'phone' => 'numeric|digits_between:9,15',


        ]);

        $user = Auth::user();


        if ($request->has('name')) {
            $user->name = $request->get("name");
        }

        if ($request->has("phone")) {
            $user->phone = $request->get("phone");
        }
        if ($request->has("email")) {
            $user->email = $request->get("email");
        }


        $is_save = $user->save();


        if ($is_save) {
            $response = [
                'success' => "true",
                'user' => $user
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => "false",
                'user' => $user
            ];
            return response($response, 204);
        }
    }


    /**
     * Update  update_fcm_token .
     *
     * @bodyParam    id    string  required    The id of the  user.      Example:1
     * @bodyParam    fcm_token    integer  required    The fcm token of the  user.      Example:391826

     * }
     */

    public function  update_fcm_token(Request $request)
    {
        $fields = $request->validate([
            'id' => 'required',
            'fcm_token' => 'required',

        ]);

        $user = user::find($fields['id']);
        $user->fcm_token = $request->get("fcm_token");
        $is_save = $user->save();
        if ($is_save) {
            $response = [
                'success' => "true",
                'user' => $user
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => "false",
                'user' => $user
            ];
            return response($response, 204);
        }
    }
}
