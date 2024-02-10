<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function home()
    {
        $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderBy('id', 'DESC')->limit('5')->get();
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->get();

        return view('frontend.index', compact(['banners', 'categories']));
    }

    // product category
    public function productCategory(Request $request, $slug)
    {
        $categories = Category::with('products')->where('slug', $slug)->first();

        $sort = "";
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        if ($categories == null) {
            return view('errors/404');
        } else {
            if ($sort == "priceAsc") {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'ASC')->paginate(12);
            }
            elseif ($sort == "priceDesc") {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'DESC')->paginate(12);
            }
            elseif ($sort == "discAsc") {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'ASC')->paginate(12);
            }
            elseif ($sort == "discDesc") {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'ASC')->paginate(12);
            }
            elseif ($sort == "titleAsc") {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'ASC')->paginate(12);
            }
            elseif ($sort == "titleDesc") {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'DESC')->paginate(12);
            }
            else {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->paginate(12);

            }
        }
        $route = 'product-category';
        if ($request->ajax()) {
            $view=view("frontend.layouts._single-product", compact("products"))->render();
            return response()->json(["html"=>$view]);
        }
        return view('frontend.pages.product.product-category', compact(['categories', "route", "products"]));
    }

    // product detail
    public function productDetail($slug)
    {
        $product = Product::with('rel_prods')->where('slug', $slug)->first();
        if ($product) {
            return view('frontend.pages.product.product-detail', compact(['product']));
        } else {
            return 'Product detail not found';
        }
    }

    // user auth
    public function userAuth()
    {
        return view('frontend.auth.auth');
    }

    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:4'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => "active"])) {
            Session::put("user", $request->email);

            if (Session::get("url.intended")) {
                return Redirect::to(Session::get("url.intended"));
            } else {
                return redirect()->route('home')->with('success', "Successfully Login");;
            }
        } else {
            return back()->with('error', "Invalid email & password!");
        }
    }

    public function registerSubmit(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string',
            'username' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:4|required|confirmed'
        ]);
        $data = $request->all();
        $check = $this->create($data);
        Auth::login($check);
        if ($check) {
            Session::put("user", $data['email']);
            return redirect()->route('home')->with('success', "Successfully Registered");;
        } else {
            return back()->with('error', "Invalid email & password!");
        }
    }

    private function create(array $data)
    {
        return User::create([
            'full_name' => $data['full_name'],
            'username' => $data['username'],
            'email' =>   $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function userLogout()
    {
        Session::forget("user");
        Auth::logout();
        return redirect()->home()->with('success', "Successfullt loggedout!");
    }

    public function userDashboard()
    {
        $user = Auth::user();
        return view("frontend.user.dashboard", compact("user"));
    }

    public function userOrder()
    {
        $user = Auth::user();
        return view("frontend.user.order", compact("user"));
    }

    public function userAddress()
    {
        $user = Auth::user();
        return view("frontend.user.address", compact("user"));
    }

    public function userAccount()
    {
        $user = Auth::user();
        return view("frontend.user.account", compact("user"));
    }
}
