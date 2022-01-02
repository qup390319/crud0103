<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EncryptCookies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exact;

class homeController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table('t_story')->get();

        return view('pages.home', compact('data', $data));
    }

    //新增
    public function create_story(Request $request)
    {
        try {
            $title_story = $request->title_story;
            $content_story = $request->content_story;
            DB::table('t_story')
                ->insert([
                    "title" => $title_story,
                    "content" => $content_story,
                ]);
            return 'success';
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function delete_data(Request $request)
    {
        $id = $request->get('id');
        DB::table('t_story')
            ->where('storyid', $id)
            ->delete();
        return redirect()->route('index');
    }

    public function get_data(Request $request)
    {
        try {
            $id = $request->get('id');
            $data = DB::table('users')->where('storyid', $id)->get();
            return $data;
        } catch (\Exception $exception) {
            $exception;
        }

    }
}
