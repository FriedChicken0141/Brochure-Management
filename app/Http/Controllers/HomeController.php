<?php

namespace App\Http\Controllers;
use App\Models\brochure;
use App\Models\Notification;

class HomeController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->id();

        $notifications = Notification::where('notifiable_id',$userId)
            ->where('read_at',null)
            ->get();

        $groupNotifications = $notifications->groupBy(function ($notification){
            return $notification->type .'_'. $notification->notifiable_id;
        });


        // パンフレットの新規登録があった場合、情報を取得
        $newBrochures = Brochure::where('created_at','>=',now()->subWeek(2))->take(5)->get();

        return view('home',compact('notifications','newBrochures','groupNotifications'));
    }
}
