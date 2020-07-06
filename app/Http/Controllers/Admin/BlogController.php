<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog.blog_list')->with([
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_categories = BlogCategory::all()->sortBy('name');
        return view('admin.blog.blog_add')->with([
            'blog_categories' => $blog_categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = $request->blog;

        // dd($price);
        $blog_files = [];
        if ($request->hasFile('blog_file')) {
            foreach ($request->file('blog_file') as $file) {
                $path = $file->store('storage/blogs', 'public');
                array_push($blog_files, $path);
            }
        }

        $blog['price'] = json_encode($request->price);
        $blog['images'] = implode(',', $blog_files);
        $blog['user_id'] = Auth::id();

        $blog_id = Blog::create($blog)->id;

        return redirect()->route('admin.blog.edit', $blog_id)->withSuccess('Blog Added');
    }

    /**
     * Display the specified resource.
     *blog_id
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
        $blog = Blog::find($id);
        $blog_categories = BlogCategory::all()->sortBy('name');


        return view('admin.blog.blog_edit')->with([
            'blog' => $blog,
            'blog_categories' => $blog_categories
        ]);
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
        $blog = $request->blog;
        $blog_files = explode(',', Blog::find($id)->images);
        if ($request->hasFile('blog_file')) {
            foreach ($request->file('blog_file') as $file) {
                $path = $file->store('storage/blogs', 'public');
                array_push($blog_files, $path);
            }
        }

        $blog['price'] = json_encode($request->price);
        $blog['images'] = implode(',', $blog_files);

        blog::find($id)->update($blog);
        return redirect()->back()->withSuccess('Blog updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BLog::destroy($id);
        return redirect()->back()->withSuccess('Blog deleted');
    }


    /**
     * image delete function
     *
     * @param Request $request
     * @return json
     */

    public function image_delete(Request $request)
    {
        $image = $request->image;
        $blog = BLog::find($request->id);
        $images = explode(',', $blog->images);
        $pos = array_search($image, $images);
        unset($images[$pos]);
        unlink(public_path('storage/' . $image));

        $blog->update(['images' => implode(',', $images)]);
        return response()->json(['success', 'image deleted']);
    }
}