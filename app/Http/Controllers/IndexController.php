<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Portfolio;
use App\Service;
use App\Team;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    //
    public function execute(Request $request) {

//        if ($request->isMethod('post')) {
//
//            $messages = [
//                'required' => "Поле :attribute обязательно к заполнению",
//                'email'    => "Поле :attribute должно соответствовать email адресу"
//            ];
//
//            $this -> validate($request, [
//                'name'  => 'required|max:255',
//                'email' => 'required|email',
//                'text'  => 'required'
//            ], $messages);
//
//            $data = $request->all();
//
//            $result = Mail::send('site.email', ['data' => $data], function ($message) use ($data) {
//
//                $message->from($data['email'], $data['name']);
//                $message->to('yanchik777@bk.ru', 'YanaDyukova')->subject('Question');
//            });
//
//            if ($result) {
//                return redirect()->route('home')->with('status', 'Email is send');
//            }
//        }

        $pages = Page::all();
        $portfolio = Portfolio::get(array('name', 'category', 'image'));
        $services = Service::all();
        $team = Team::all();

        $tags = DB::table('portfolio')->distinct()->pluck('category');

        $menu = array();
        foreach ($pages as $page) {
            $item = array('title' => $page->name, 'alias' => $page->alias);
            array_push($menu, $item);
        }

        $item = array('title' => 'Services', 'alias'=>'service');
        array_push($menu, $item);

        $item = array('title' => 'Portfolio', 'alias'=>'Portfolio');
        array_push($menu, $item);

        $item = array('title' => 'Team', 'alias'=>'team');
        array_push($menu, $item);

        $item = array('title' => 'Contact', 'alias'=>'contact');
        array_push($menu, $item);

        return view('site.index', array(
            'menu' => $menu,
            'pages' => $pages,
            'services' => $services,
            'portfolio' => $portfolio,
            'team' => $team,
            'tags' => $tags
        ));
    }
}
