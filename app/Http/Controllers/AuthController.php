<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\CPU\Helpers;
use App\Models\TripBooking;
use Illuminate\Support\Facades\Redirect;

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
            'password' => 'required|string|confirmed',
            'user_role' => 'required|string',
            'phone_number' => 'required|string',

        ]);




        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone_number'],
            'password' => bcrypt($fields['password']),
            'user_role' => $fields['user_role'],
            'app_user' => 1,

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
        ]);


        // Check email

        $user = User::where('email', $fields['email'])->first();
        if ($user != null) {

            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
        }


        $user = User::where('social_media_id', $request->get("social_media_id"))->first();

        if ($user != null) {

            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
        }



        if ($user == null && $request->has("email")) {
            if ($fields['email'] != null && $fields['email'] != "") {
                $password = Str::random(8);
                $user = User::create([
                    'name' => $fields['name'],
                    'email' => $fields['email'],
                    'password' =>  bcrypt($password),
                    'social_media_id' => $request->get("social_media_id"),
                    'user_role' => "user",
                    'nick_name' => $fields['name'],
                    'app_user' => 1,
                ]);
            }
        } else {

            if ($fields['id'] != null && $fields['id'] != "") {
                $password = Str::random(8);
                $user = User::create([
                    'name' => $fields['name'],
                    'social_media_id' => $fields['social_media_id'],
                    'password' =>  bcrypt($password),
                    'user_role' => "user",
                    'nick_name' => $fields['name'],
                    'app_user' => 1,

                ]);
            }
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
     *  @authenticated
     * login User
     *
     * @bodyParam   email    string  required    The email of the  user.      Example:zeyad.hawash@averotec.sa
     * @bodyParam   password    string  required    The password of the  user.   Example: secret
     */
    public function login(Request $request)
    {

        $fields = $request->validate([
            'email' => 'string',
            'phone' => 'string',
            'password' => 'required|string'
        ]);
        if (empty($fields['email']) && empty($fields['phone'])) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }
        if (!empty($fields['email'])) {
            $user = User::where('email', $fields['email'])->first();
        } else {
            $user = User::where('phone', $fields['phone'])->first();
        }
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
        return Redirect::to("/Admin");
    }



    /**
     * Update in the user by update profile .
     * @authenticated
     * @bodyParam   name    string  required    The name of the  user.      Example: zeyad
     * @bodyParam   email    string  required    The email of the  user.      Example:zeyad.hawash@averotec.sa
     * @bodyParam   user_role    string  required    The role of the  user.      Example: admin
     * @bodyParam   city_id    string      The  birth_date of the  user.   Example:1
     * @bodyParam photo file  The image.
     * @bodyParam birth_date date_format  The .
     * @bodyParam   phone    string      The name of the  user.      Example: 123456789
     * @response {
     *  "user": "{ email:testuser@example.com,name :testuser,passwor:secret }",
     * }
     */


    public function  update(Request $request)
    {
        $fields = $request->validate([
            'email' => 'string|email',
            'name' => 'required|string',
            'phone' => 'numeric|digits_between:9,15',
            'user_role' => 'required|string',


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

        if ($request->has('user_role')) {
            $user->name = $request->get("user_role");
        }

        if ($request->has('birth_date')) {
            $user->name = $request->get("birth_date");
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
            'fcm_token' => 'required',

        ]);

        $user = user::find(Auth()->id());
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


    public function  update_fcm_token_nova(Request $request)
    {
        $fields = $request->validate([
            'fcm_token' => 'required',
            "id" => 'required',

        ]);

        $user = user::find($request->get("id"));
        $user->fcm_token = $request->get("fcm_token");
        $is_save = $user->save();
        if ($is_save) {
            $response = [
                'success' => "true",
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => "false",
            ];
            return response($response, 204);
        }
    }



    public function reset_password_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        }


        DB::table('password_resets')->where('email', 'like', "%{$request['email']}%")->delete();

        $customer = User::Where(['email' => $request['email']])->first();
        if (isset($customer)) {
            $token = rand(1000, 9999);
            DB::table('password_resets')->insert([
                'email' => $customer['email'],
                'token' => $token,
                'created_at' => now(),
            ]);

            Mail::to($customer['email'])->send(new \App\Mail\PasswordResetMail($token));
            return response()->json(['message' => 'Email sent successfully.'], 200);
        }

        return response()->json(['errors' => [
            ['code' => 'not-found', 'message' => 'user not found!']
        ]], 404);
    }

    public function verification_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|min:6',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        }

        $check_token_reset_password = DB::table('password_resets')->where('email', 'like', "%{$request['email']}%")->where('token', $request['token'])->first();

        if ($check_token_reset_password != null) {
            DB::table('password_resets')->where('email', 'like', "%{$request['email']}%")->where('token', $request['token'])->delete();

            return response()->json(['message' => 'successfully token reset password'], 200);
        }
        return response()->json(['errors' => [
            ['code' => 'not-found', 'message' => 'invalid token']
        ]], 404);
    }


    public function  update_password(Request $request)
    {
        $fields = $request->validate([
            'email' => 'string|email',
            'password' => 'required|string',

        ]);

        $customer = User::Where('email', $fields['email'])->first();

        if ($customer != null) {
            $customer->password = bcrypt($fields['password']);
            $customer->save();
            return response()->json(['message' => 'successfully reset password'], 200);
        }


        return response()->json(['errors' => [
            ['code' => 'not-found', 'message' => 'not found email']
        ]], 404);
    }

    /**
     * @authenticated
     *
     */
    public function getInformationUser(Request $request)
    {

        $user = User::where("id", Auth()->id())->with("Donations.Project", "Volunteer.Project")
            ->with(["TripBooking.Project" => function ($query) use ($request) {
                $query->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')->get();
            }])
            ->withCount('Donations as donations_count')
            ->withCount('Volunteer as volunteer_count')
            ->withCount('TripBooking as trip_booking_count')
            ->first();
        $trip_booking = json_decode($user)->trip_booking;
        $trip_booking = collect($trip_booking);

        $trip_booking->map(function ($trip) use ($request) {

            $from_lat = $trip->project->tripfrom->current_location->latitude;
            $from_lng = $trip->project->tripfrom->current_location->longitude;

            $to_lat = $trip->project->tripto->current_location->latitude;
            $to_lng = $trip->project->tripto->current_location->longitude;



            $from_distance = Helpers::distance($request->lat, $request->lng, $from_lat, $from_lng, 'K');
            $trip->project->from_distance = round($from_distance, 2);


            $to_distance = Helpers::distance($request->lat, $request->lng, $to_lat, $to_lng, 'K');
            $trip->project->to_distance = round($to_distance, 2);

            $trip_bokking = TripBooking::where('user_id', Auth()->id())->where('project_id', $trip->project->id)->first();

            if ($trip_bokking != null) {
                if ($trip_bokking->status == 1) {
                    $trip->project->isBooking = 1;
                } else {
                    $trip->project->isBooking = 0;
                }
            } else {
                $trip->project->isBooking = 0;
            }
        });


        $user->custom_trip_booking = $trip_booking;



        $response = [
            'success' => "true",
            'user' => $user
        ];
        return response($response, 200);
    }

    public function delete()
    {

        $user = Auth::user();
        if ($user != null) {
            if ($user->user_role == "user") {
                $user_delete =  User::where("id", $user->id)->delete();
                $response = [
                    'success' => "true",
                    'message' => "Success delete user"
                ];
                return response($response, 200);
            } else {
                $response = [
                    'success' => "false",
                    'message' => "Not Auth"
                ];
                return response($response, 401);
            }
        } else {
            $response = [
                'success' => "false",
                'message' => "Not Auth"
            ];
            return response($response, 401);
        }
    }
}
