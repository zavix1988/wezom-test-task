<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    /**
     * /**
     * Display a listing of the resource.
     *
     * @param string $sort
     * @param string $direction
     * @return \Illuminate\Http\Response
     */
    public function index($sort='created_at', $direction='desc')
    {
        if(Str::contains(url()->current(), 'admin')) {
            return response()->view('admin.news.index', ['news' => News::paginate(10)]);
        } else {
            return response()->view('common.news.all', [
                'news' => News::where('published', true)->orderBy($sort, $direction)->paginate(10),
                'direction' => ($direction == 'asc')?'desc':'asc'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.news.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'header' => 'required | string | max:255',
            'body' => 'required | string',
            'image' => 'image',
            'published' => 'required | in:Yes,No'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $imageName = (!is_null($request->file('image'))) ? $this->createImage($request->file('image')) : '';

        $news = new News();

        $news->header = $request->input('header');
        $news->body = $request->input('body');
        $news->image = $imageName;
        $news->published = ($request->input('published') == 'Yes') ? true : false;
        $news->views = 0;
        $news->save();

        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        $news->views++;
        $news->save();

        return response()->view('common.news.one', ['news' => $news]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $news = News::find($id);
        $news->published = !$news->published;
        $news->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);
        return redirect()->back();
    }


    protected function createImage($image)
    {
        if(is_null($image))
            return '';


        $name = uniqid('img_').'.'.$image->getClientOriginalExtension();

        $img = Image::make($image->path())->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('jpg', 40);

        Storage::put("public/newsImg/{$name}", $img);


        return $name;
    }
}
