<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Model\Page;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\Page\{PageResource,PageCollection};
use App\Http\Requests\Admin\Api\Page\PageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->has('search') AND !empty($request->input('search'))) {
        //
        $search = $request->search;
        return new PageCollection(Page::where('title','like',"%$search%")->paginate(10));
      }
        //Return the pages for the Admin
        return  new PageCollection(Page::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Create the Page
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        //
        $page=new Page();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->metatitle = $request->metatitle;
        $page->metadescription = $request->metadescription;
        $page->status = $request->status;
        $page->save();
        return new PageResource($page);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
        return new PageResource($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        //Update the page
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->metatitle = $request->metatitle;
        $page->metadescription = $request->metadescription;
        $page->status = $request->status;
        $page->save();
        return new PageResource($page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
        $page->delete();
        return response()->json([
        'message' => 'Page deleted successfully'], 200);
    }
}
