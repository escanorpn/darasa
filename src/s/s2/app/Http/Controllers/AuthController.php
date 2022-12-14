<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            
        return response()->json(['val' => '3','msg'=>'User not Authorised please check email and password and try again']);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            // return response()->json(['error' => 'Unauthorized1'], 401);
            
        return response()->json(['val' => '3','msg'=>'User not Authorised please check email and password and try again']);
        }
        return response()->json(['val' => '22','token'=>$this->createNewToken($token)]);
        // return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        return response()->json([
            'message' => 'User successfully registered',
            "val" => "2",
            'user' => $user
        ], 201);
    }
    
    public function signup(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                "val" => "3",
                // $validator->errors()->toJson()
            ], 201);
        }
        $code=$request->code;
        $role="student";
        if($code=="F-Dtech"){
            $role="finance";
        }else if($code=="H-Dtech"){
            $role="hod";
        }else if($code=="L-Dtech"){
            $role="lib";
        }else if($code=="G-Dtech"){
            $role="gown";
        }else if($code=="R-Dtech"){
            $role="rec";
        }
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->code=$code;
        $user->role=$role;
        $user->password=bcrypt($request->password);

        $user->save();
        
        // $user = User::create(array_merge(
        //             $validator->validated(),
        //             ['password' => bcrypt($request->password)]
        //         ));
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized1'], 401);
        }
        return response()->json([
            'message' => 'User successfully registered',
            "val" => "2",
            'token'=>$this->createNewToken($token),
            'user' => $user
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        //  if (! $token = auth()->attempt($validator->validated())) {
        //     return response()->json(['error' => 'Unauthorizedz'], 401);
        // }
        return response()->json(auth()->user());
    }
    
    public function getAuthenticatedUser()
    {
            try {

                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                    return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                    return response()->json(['token_absent'], $e->getStatusCode());

            }

            return response()->json("haha");
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}