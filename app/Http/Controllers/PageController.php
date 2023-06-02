<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function __construct()
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pages = Page::where('featured',false)->latest()->paginate(9);
        $feat = Page::where('featured',true)->get();
        return view('homepage.index',['pages' => $pages,'feats' => $feat]);
    }
    public function search(Request $request){
        // dd($request->search);
        $cari = $request->search;
        $pages = Page::where('title','like',"%".$cari."%")
		->paginate(9);
        return view('homepage.search',['search' => $cari,'pages' => $pages,'categories' => Category::latest()->get()]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // $show = Page::where('slug', $page->slug);
        // return "halo";
        // // return view('page',['pages' => $show]);
        $categories = Category::all();
        $pages = Page::all();
        $singlePage = $pages->where('slug',$slug);
        // foreach ($pages as $p) {
        //     if($p->slug === $slug) {
        //         $page = $p;
        //     }
        // }
        return view('Homepage.page',[
            'singlePage' => $singlePage,
            'categories' => $categories
        ]);
    }

    // public function showCategory($slug){
    //     $categories = Category::all();
    //     $category = $categories->where('slug', $slug);
    //     // dd($category);
    //     return view('Homepage.category',['category' => $category]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
