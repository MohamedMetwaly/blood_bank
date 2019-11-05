<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\Client;
use App\Models\Category;
use App\Models\DonationRequest;
use App\Models\Notification;
use App\Models\Token;
use Validator;

class MainController extends Controller
{
    public function governorates(){
    	$governorates = Governorate::all();
    	return responseJson(1,'success',$governorates);
    }



    public function cities(){
    	$cities = City::where(function($query){
    		if (request()->has('governorate_id')) {
    			$query->where('governorate_id',request()->governorate_id);
    		}
    	})->get();
    	return responseJson(1,'success',$cities);
    }



    public function categories()
    {
        $categories = Category::all();

        return responseJson(1,'success', $categories);
    }



    public function searchPosts(){
    	$posts = Post::where(function($query){
    		if (request()->has('category_id')) {
    			$query->where('category_id',request()->category_id);
    		}
            if (request()->has('keyword')) {
                $query->where(function ($q){
                    $q->where('title', 'like', '%' . request()->keyword . '%');
                    $q->orWhere('content', 'like', '%' . request()->keyword . '%');
                });
            }
    	})->paginate(10);
        if ($posts->count() == 0) {
            return responseJson(0, 'Failed');
        }
    	return responseJson(1,'success',$posts);
    }



    public function postDetails(Request $request)
    {
        $post = Post::select('title', 'content', 'image')->where('id', $request->id)->get();

        return responseJson(1,'success', $post);
    }



    public function settings(){
        $settings = Setting::all();
        return responseJson(1,'success',$settings);
    }



    public function contacts(){
        $validator = Validator::make(request()->all(),[
            'name'                 => 'required',
            'email'                => 'required',
            'subject'              => 'required',
            'message'              => 'required',
            'phone'                => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        else{
            $contact = Contact::create(request()->all());
            $contact->save();
            return responseJson(1,'تم التواصل',['contact' => $contact]);
        }
    }



    public function profile(){
        $profile = request()->user();
        return responseJson(1,'success',['profile' => $profile]);
    }



    public function editProfile(){
        $validator = Validator::make(request()->all(),[
            'name'               => 'required',
            'email'              => 'required|unique:clients,email,' .request()->user()->id,
            'd_o_b'              => 'required',
            'city_id'            => 'required',
            'phone'              => 'required|unique:clients,phone,' .request()->user()->id,
            'password'           => 'required|confirmed',
            'blood_type_id'      => 'required',
            'donation_last_date' => 'required'
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
            if(request()->has('password')){
                request()->merge(['password' => bcrypt(request()->password)]);
            }
            $client = request()->user()->update(request()->all());
            return responseJson(1,'تم التعديل',['client' => $client]);
    }



    public function getNotificationSettings(){
        $bloodtypes = request()->user()->bloodtypes()->pluck('blood_types.id')->toArray();
        $governorates = request()->user()->governorates()->pluck('governorates.id')->toArray();
        return responseJson(1,'success',['bloodtypes' => $bloodtypes, 'governorates' => $governorates]);
    }



    public function editNotificationSettings(){
        $validator = Validator::make(request()->all(),[
            'blood_types' => 'required',
            'governorates'    => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $bloodtypes = request()->user()->bloodtypes()->sync(request()->blood_types);
        $governorates = request()->user()->governorates()->sync(request()->governorates);
        return responseJson(1,'success',['bloodtypes' => $bloodtypes, 'governorates' => $governorates]);
    }



    public function getFavourites(){
        $posts = request()->user()->posts()->pluck('posts.id')->toArray();
        if ($posts){
            return responseJson(1,'success',['posts' => $posts]);
        }
        return responseJson(1,'لا يوجد مفضلات');
    }



    public function setFavourites(){
        $validator = Validator::make(request()->all(),[
            'posts'    => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $posts = request()->user()->posts()->toggle(request()->posts);
        return responseJson(1,'success',['posts' => $posts]);
    }



    public function notifications()
    {
        $notifcation = Notification::paginate(10);
        return responseJson(1,'success', $notifcation);

    }



    public function searchDonations(Request $request){
        $donations = DonationRequest::where(function($query)use($request){
            if ($request->has('city_id')) {
                $query->where('city_id',$request->city_id);
            }
            if ($request->has('blood_type_id')) {
                $query->where('blood_type_id',$request->blood_type_id);
            }

        })->paginate(10);
        return responseJson(1,'success',$donations);
    }



    public function donationDetails(Request $request)
    {
        $donationdetails = DonationRequest::where('id', $request->id)->get();

        return responseJson(1,'success',$donationdetails);
    }



    public function donationRequestCreate(){
        $validator = Validator::make(request()->all(),[
            'name'             => 'required',
            'age'              => 'required',
            'bags_num'         => 'required',
            'hospital_name'    => 'required',
            'phone'            => 'required',
            'hospital_address' => 'required',
            'blood_type_id'    => 'required',
            'city_id'          => 'required',
            'notes'            => 'required',
            'latitude'         => 'required',
            'longitude'        => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $donationRequests = request()->user()->donationrequests()->create(request()->all());

        // find clients suitable for this donation request
        $clientsIds = $donationRequests->city->governorate
            ->clients()->whereHas('bloodtypes', function ($q) use ($donationRequests) {
                 $q->where('blood_types.id', $donationRequests->blood_type_id);
            })->pluck('clients.id')->toArray();
        $send = null;
        if (count($clientsIds)) {
            $notification = $donationRequests->notifications()->create([
                'title' => 'احتاج متبرع لفصيله',
                'content' => $donationRequests->blood_type . 'محتاج متبرع لفصيلة ',
            ]);
            $notification->clients()->attach($clientsIds);
            $tokens = Token::whereIn('client_id', $clientsIds)->where('token', '!=', null)->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->body;
                $data = [
                    'donation_request_id' => $donationRequests->name
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }
        }
        return responseJson(1, 'تمت الاضافه بنجاح', $donationRequests);
    }
}
