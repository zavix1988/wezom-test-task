<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Str::contains(url()->current(), 'admin')) {
            return response()->view('admin.reviews.index', ['reviews' => Review::paginate(10)]);
        } else {
            return response()->view('common.reviews.all', [
                'reviews' => Review::where('published', true)->paginate(10),
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
        return response()->view('common.reviews.add');
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
            'name' => 'required | regex:/^\w+$/ | max:255',
            'email' => 'required | email | ',
            'text' => 'required | string',
            'captcha' => 'required | captcha'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $review = new Review();

        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->text = $request->input('text');
        $review->published =  false;
        $review->save();

        return redirect()->route('common.reviews.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->view('admin.reviews.edit', ['review' => Review::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required | regex:/^\w+$/ | max:255',
            'email' => 'required | email | ',
            'text' => 'required | string',
            'published' => 'required | in:Yes,No'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $review = Review::find($id);
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->text = $request->input('text');
        $review->published = ($request->input('published') == 'Yes') ? true : false ;
        $review->save();

        return redirect()->route('admin.reviews.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Review::destroy($id);
        return redirect()->back();
    }

    public function publish(Request $request, $id)
    {
        $review = Review::find($id);
        $review->published = !$review->published;
        $review->save();
        return redirect()->back();
    }
}
