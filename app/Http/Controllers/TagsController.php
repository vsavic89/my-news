<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    
    public function _validate(Request $request)
    {
        $validator = \Validator::make($request->all(), TagRequest::rules());                
        
        return $validator;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(30);
        
        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                
        $validated = $this->_validate($request);                
        if(!$validated->fails())
        {                
            $tag = new Tag();
            $tag->_save($request->input('name'));

            return redirect()->route('tags'); //new ArticleResource($article);                    
        }else{
            return view('tags.create', ['errors' => $validated->errors()]) ;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        
        return new TagResource($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        
        return view('tags.create', ['model' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $this->_validate($request);                
        $tag = Tag::findOrFail($request->route('id'));
        if(!$validated->fails())
        {                                                       
            $tag->_save($request->input('name'));

            return redirect()->route('tags'); //new ArticleResource($article);                    
        }else{
            return view('tags.create', [
                'errors' => $validated->errors(),
                'model' => $tag
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if($tag){
            if($tag->delete()){
                return redirect()->route('tags'); //new ArticleResource($article);
            }
        }else{
            return response()->json(['errors' => 'Desired article not found!']);
        }
    }
}
