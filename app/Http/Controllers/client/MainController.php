<?php

namespace App\Http\Controllers\client;

use App\Models\Client;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $donations = DonationRequest::paginate(4);
        return view('front.home', compact('posts','donations'));
    }

    public function AllPost()
    {
        $details = Post::orderBy('id', 'desc')->paginate(3);
        return view('front.articles', compact('details'));
    }

    public function ArticleDetail($id)
    {
        $detail = Post::find($id);
        $posts = Post::where('category_id', $detail->category_id)->get();
        return view('front.article',compact('detail','posts'));
    }

    public function TogglePost()
    {
        $toggle = request()->user()->posts()->toggle(request()->post_id);
        return responseJson(1,'success', $toggle);
    }

    public function Donations()
    {
        $donations = DonationRequest::paginate(6);
        return view('front.donations', compact('donations'));
    }

    public function DonationDetail($id)
    {
        $detail = DonationRequest::find($id);
        return view('front.donation-details', compact('detail'));
    }

    public function AboutUs()
    {
        return view('front.how-we-are');
    }

    public function GetContact()
    {
        $about = Setting::all();
        return view('front.contact-us',compact('about'));
    }

    public function PostContact()
    {
        $this->validate(request(),[
            'name'                 => 'required|string',
            'email'                => 'required|email',
            'subject'              => 'required|string',
            'message'              => 'required|string',
            'phone'                => 'required|numeric|digits:11',
        ]);
        Contact::create(request()->all());
        flash()->success('تم التواصل');
        return back();
    }

    public function GetDonation()
    {
        return view('front.donation-request');
    }

    public function DonationRequest()
    {
        $this->validate(request(),[
            'name'             => 'required|string',
            'age'              => 'required|numeric',
            'bags_num'         => 'required|numeric',
            'hospital_name'    => 'required|string',
            'phone'            => 'required|numeric|digits:11',
            'hospital_address' => 'required|string',
            'blood_type_id'    => 'required',
            'city_id'          => 'required',
            'notes'            => 'required',
        ]);
        $donate = DonationRequest::create(request()->all());
        $donate->client_id = auth('client')->user()->id;
        $donate->save();
        flash()->success('تم عمل طلب تبرع');
        return back();
    }
}
