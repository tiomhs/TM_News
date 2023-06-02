<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class PageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $page = Page::all();
        // $page = DB::select("SELECT COUNT('featured') FROM pages WHERE featured = 1 ");
        $featured = DB::table('pages')
        ->selectRaw('featured')
        ->where('featured', '=', 1)
        ->get();
        
        return view('admin.page.create',[
            'categories' => Category::all(),
            'num' => $featured->count(),
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
        // $featured = DB::table('pages')
        // ->selectRaw('featured')
        // ->where('featured', '=', 1)
        // ->get();
        // // dd($featured->count());

        // // if ($featured->count() < 5) {
        // //     echo "<script>
        // //             alert('true');
        // //         </script>";
        // // }return false;

        $validatedData = $request->validate([
            'title' => 'required|max:200',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'featured' => 'required',
            'body' => 'required',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['slug'] = SlugService::createSlug(Page::class, 'slug', $request->title);
        $validatedData['user_id'] = auth()->user()->id;

        Page::create($validatedData);
        toast('Page Added Successfully','success');
        return redirect('/admin/pages ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $pages = Page::all();
        $page = $pages->where('slug',$slug);
        return view('admin.page.show',[
            'page' => $page
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $featured = DB::table('pages')
        ->selectRaw('featured')
        ->where('featured', '=', 1)
        ->get();

        $pages = Page::all();
        $page = $pages->where('slug',$slug);
        return view('admin.page.edit',[
            'page' => $page,
            'categories' => Category::all(),
            'num' => $featured->count(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:200',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required',
            'featured' => 'required',
        ]);

        if($request->file('image')){
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // $validatedData['slug'] = SlugService::createSlug(Page::class, 'slug', $request->title);
        Page::where('id', $request->id)->update($validatedData);
            toast('Page Edited Successfully','success');
        return redirect('/admin/pages ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$slug)
    {
        $page = Page::where('slug',$slug);
        if ($request->image) {
            Storage::delete($request->image);
        }
        $page->delete();
        return response()->json(['status' => 'Page Berhasil di hapus!']);
    }

    // public function checkSlug(Request $request){
    //     $slug = SlugService::createSlug(Page::class, 'slug', $request->title);
    //     return response()->json(['slug' => $slug]);
    // }
}
