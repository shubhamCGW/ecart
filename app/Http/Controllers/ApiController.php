<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Otp;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Support\Str;

class ApiController extends Controller
{
    protected $result;

    public function __construct()
    {
        $this->result = [
            'status' => false, 'response' => [], 'error' => "",
        ];
    }

    public function Register(Request $res)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email|max:191',
            'phone' => 'required|digits:10',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ];

        $validator = Validator::make($res->all(), $rules);
        if ($validator->fails()) {
            $this->result['status'] = false;
            $this->result['error'] = $this->formErrorToPlainArray($validator->getMessageBag()->toArray(), true);
            return Response::json($this->result, 200);
        }

        $user = User::create([
            'name' => $res->name,
            'phone' => $res->phone,
            'password' => Hash::make($res->password),
            'email' => $res->email,
        ]);
        $token = $user->createToken('api_token')->plainTextToken;
        $this->result['status'] = !!$user;
        $this->result['response']['token'] = $token;
        $this->result['response']['profile'] = $user;

        return Response::json($this->result, 200);
    }

    public function Login(Request $res)
    {
        $rules = [
            'email' => 'required|string|email|max:191',
            'password' => 'required|string|min:8',
        ];

        $validator = Validator::make($res->all(), $rules);
        if ($validator->fails()) {
            $this->result['status'] = false;
            $this->result['error'] = $this->formErrorToPlainArray($validator->getMessageBag()->toArray(), true);
            return Response::json($this->result, 200);
        }

        $user = User::where('email', $res->email)->first();
        if ($user) {
            if (Hash::check($res->password, $user->password)) {
                $user->tokens()->where('tokenable_id', $user->id)->delete();
                $token = $user->createToken('api_token')->plainTextToken;
                $this->result['status'] = !!$user;
                $this->result['response']['token'] = $token;
                $this->result['response']['profile'] = $user;
            } else {
                $this->result['error'] = "Password does not match.";
            }
        } else {
            $this->result['error'] = "Email not Found";
        }
        // $isLoggedIn = Auth::attempt(['email' => $res->email, 'password' => $res->password]);
        return Response::json($this->result, 200);
    }

    public function me(Request $res)
    {
        $user = $res->user();
        $this->result['status'] = !!$user;
        $this->result['response'] = $user;
        return Response::json($this->result, 200);
    }

    public function logout()
    {
        $user = request()->user();
        $user->tokens()->where('id', auth()->id())->delete();
        $this->result['status'] = true;
        $this->result['response'] = true;
        $this->result['message'] = "You are successfully logged out";

        return Response::json($this->result, 200);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email|max:191',
            'phone' => 'required|digits:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->result['status'] = false;
            $this->result['error'] = $this->formErrorToPlainArray($validator->getMessageBag()->toArray(), true);
            return Response::json($this->result, 200);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = base_path('/public/images/users/');
            $image->move($destinationPath, $filename);
            $imagePath = url('images/users/' . $filename);
            $user->image = $imagePath;

        } else {
            $user->image;
        }
        $user->save();
        $this->result['status'] = !!$user;
        $this->result['response']['profile'] = $user;

        return Response::json($this->result, 200);
    }
    protected function sendResetLinkResponse(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|max:191',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->result['status'] = false;
            $this->result['error'] = $this->formErrorToPlainArray($validator->getMessageBag()->toArray(), true);
            return Response::json($this->result, 200);
        }

        $user = User::where('email', $request->email)->first();
        $otp = random_int(100000, 999999);
        Cache::put([$otp], now()->addSeconds(20));

        if ($user === null) {
            $this->result['status'] = false;
            $this->result['error'] = 'User does not exist with this email';
        } else {
            $userEmail = $user->email;
            $userName = $user->name;
            $data = [
                'user' => $user,
                'otp' => $otp,
            ];
            $response = Otp::create(['user_id' => $user->id, 'otp_no' => $otp]);
            // Mail::to($userEmail)->send(new forgetpassword($otp));
            Mail::send('mail', $data, function ($message) use ($userEmail, $userName) {
                $message->to($userEmail, $userName)->subject
                    ('E-CART Password Reset Verification Code');
                $message->from('ecart@bussinessmail.com', 'E-CART');
            });
            $this->result['response'] = $response;
            $this->result['status'] = true;
            $this->result['message'] = 'Verification mail sent successfully!';
        }
        return Response::json($this->result, 200);
    }

    public function verifyOtp(Request $request)
    {
        // dd($request->all());
        $rules = [
            'otp_no' => 'required|numeric',
            'email' => 'required|string|email',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->result['status'] = false;
            $this->result['error'] = $this->formErrorToPlainArray($validator->getMessageBag()->toArray(), true);
            return Response::json($this->result, 200);
        }
        $user = User::where('email', $request->email)->first();
        $verifyOtp = Otp::where('user_id', $user->id)
            ->where('otp_no', '=', $request->otp_no)->first();

        if ($verifyOtp) {
            $verifyOtp->delete();
            $this->result['status'] = true;
            $this->result['response'] = $user;
            $this->result['message'] = 'your otp is verified';
        } else {
            $this->result['status'] = false;
            $this->result['error'] = "Invalid otp";
        }
        return Response::json($this->result, 200);
    }

    protected function sendResetResponse(Request $request)
    {
        $rules = [
            'user_id' => 'required|numeric',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->result['status'] = false;
            $this->result['error'] = $this->formErrorToPlainArray($validator->getMessageBag()->toArray(), true);
            return Response::json($this->result, 200);
        }

        $user = User::find($request->user_id);
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $this->result['error'] = 'Password already exist, Please use different Password';
            } else {
                $user->password = Hash::make($request->password);
                $user->save();
                $this->result['status'] = !!$user;
                $this->result['message'] = 'Reset password successfully!';
            }
        } else {
            $this->result['status'] = false;
            $this->result['error'] = 'Something went wrong';
        }

        return Response::json($this->result, 200);
    }

    protected function getCategoriesList()
    {
        $category = Category::select('*')->selectRaw('CONCAT("' . url('/') . '/", image) as image')->get();
        $this->result['status'] = !!$category;
        $this->result['response'] = $category;
        return Response::json($this->result, 200);
    }

    protected function getProductsList()
    {

        $products = Product::select('*')->selectRaw('CONCAT("' . url('/') . '/", image) as image')
            ->get();
        // foreach($products as $p => $product){
        //     $products[$p]->image = url('public/'.$product->image);
        // }
        $this->result['status'] = !!$products;
        $this->result['response'] = $products;
        return Response::json($this->result, 200);
    }

    protected function getProductsByCategories(Request $request)
    {
        $categoryID = $request->category_id;
        $productByCat = Product::select('*')->selectRaw('CONCAT("' . url('/') . '/", image) as image')
            ->where('category_id', $categoryID)->get();
        $this->result['status'] = !!$productByCat;
        $this->result['response'] = $productByCat;
        return Response::json($this->result, 200);
    }

    protected function getBannersList()
    {
        $banner = Banner::select('*')->selectRaw('CONCAT("' . url('/') . '/", image) as image')
            ->get();
        $this->result['status'] = !!$banner;
        $this->result['response'] = $banner;
        return Response::json($this->result, 200);
    }

    protected function getProductDetails(Request $request)
    {
        $productDetails = Product::select('*')->selectRaw('CONCAT("' . url('/') . '/", image) as image')
            ->where('id', $request->product_id)->first();
        $userId = $request->user()->id;
        $alreadyInWishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $request->product_id)->first();
        if ($productDetails) {
            $productDetails->favourite = !!$alreadyInWishlist; //?"active":'inactive';
        }

        $this->result['status'] = !!$productDetails;
        $this->result['response'] = $productDetails;
        return Response::json($this->result, 200);
    }

    protected function addToWishListProduct(Request $request)
    {
        $userId = $request->user()->id;
        $removeFromWishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $request->product_id)->delete();
        $product = Product::find($request->product_id);
        if ($product) {
            $productName = $product->name;
        }
        if ($removeFromWishlist) {
            $this->result['message'] = 'Removed from wishlist';
        } else {
            $wishlist = new Wishlist;
            $wishlist->user_id = $userId;
            $wishlist->product_id = $request->product_id;
            $wishlist->save();

            $this->result['status'] = !!$wishlist;
            $this->result['response'] = $wishlist;
            $this->result['message'] = $productName . 'Added in your wishlist ';
        }

        return Response::json($this->result, 200);
    }

    protected function getUserWishList(Request $request)
    {
        $userId = $request->user()->id;

        $userWishlist = Wishlist::select('*')->where('user_id', $userId)
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->selectRaw('CONCAT("' . url('/') . '/", image) as image')
            ->get();
        // $product = Product::whereIn('id', $userWishlist)->get();
        $this->result['status'] = !!$userWishlist;
        $this->result['response'] = $userWishlist;
        return Response::json($this->result, 200);
    }

    protected function removeItemFromUserWishList(Request $request)
    {
        $userId = $request->user()->id;
        $alreadyRemoveFromWishlist = Wishlist::find($request->product_id);
        if ($alreadyRemoveFromWishlist) {
            $removeFromWishlist = Wishlist::where('user_id', $userId)
                ->where('product_id', $request->product_id)->delete();
            $this->result['status'] = !!$removeFromWishlist;
            $this->result['response'] = $removeFromWishlist;
            $this->result['message'] = 'Removed from your wishlist! ';

        } else {
            $this->result['message'] = 'This Item does not exist in your wishlist! ';
        }
        return Response::json($this->result, 200);
    }

    protected function addToCart(Request $request)
    {
        $userId = $request->user()->id;
        $product = Product::where('id', $request->product_id)->first();

        if (!empty($product)) {
            $already_cart = Cart::where('user_id', $userId)->where('product_id', $product->id)->first();
            if (empty($already_cart)) {
                $already_cart = new Cart();
            }
            $already_cart->user_id = $userId;
            $already_cart->product_id = $request->product_id;
            $already_cart->price = $product->price;
            $already_cart->quantity = $request->quantity;
            $already_cart->amount = $product->price * $request->quantity;
            $already_cart->save();
            $this->result['status'] = !!$already_cart;
            $this->result['response'] = $already_cart;
            $this->result['message'] = 'Your Item Added into Cart';
        } else {
            $this->result['message'] = 'Product Not Found!';
        }
        return Response::json($this->result, 200);
    }

    protected function getCartList(Request $request)
    {
        $userId = $request->user()->id;
        $cart = Cart::select('*')->where('user_id', $userId)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->selectRaw('CONCAT("' . url('/') . '/", image) as image')
            ->get();
        $this->result['status'] = !!$cart;
        $this->result['response'] = $cart;
        return Response::json($this->result, 200);
    }

    protected function getExclusiveOffer()
    {
        $product = Product::select('*')->inRandomOrder()->selectRaw('CONCAT("' . url('/') . '/", image) as image')->limit(5)->get();
        $this->result['status'] = !!$product;
        $this->result['response'] = $product;
        return Response::json($this->result, 200);
    }

    protected function getBestSelling()
    {
        $product = Product::select('*')->inRandomOrder()->selectRaw('CONCAT("' . url('/') . '/", image) as image')->limit(5)->get();
        $this->result['status'] = !!$product;
        $this->result['response'] = $product;
        return Response::json($this->result, 200);
    }

    protected function getGroceries()
    {
        $product = Product::select('*')->inRandomOrder()->selectRaw('CONCAT("' . url('/') . '/", image) as image')->limit(5)->get();
        $this->result['status'] = !!$product;
        $this->result['response'] = $product;
        return Response::json($this->result, 200);
    }

}
