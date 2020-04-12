<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Author;
use App\Tag;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    public function _getAuthors()
    {
        $authors = Author::all()->sortBy('full_name');
        
        return $authors;
    }        
    
    public function _getTags()
    {
        $tags = Tag::all()->sortBy('name');
        
        return $tags;
    }        
    
    public function _validate(Request $request)
    {
        $validator = \Validator::make($request->all(), ArticleRequest::rules());

        return $validator;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(30);                
        
        return view('articles.index', ['articles' => ArticleResource::collection($articles)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('articles.create', ['authors' => $this->_getAuthors(), 'tags' => $this->_getTags()]);
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
            $article = new Article();
            $article->_save($request->input('title'), $request->input('body'), $request->input('author_id'), $request->input('tags'));                        

            return redirect()->route('articles'); //new ArticleResource($article);                    
        }else{
            return view('articles.create', ['errors' => $validated->errors()]) ;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        
        return view('articles.create', ['model' => $article, 'authors' => $this->_getAuthors(), 'tags' => $this->_getTags()]);
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
        $article = Article::findOrFail($request->route('id'));
        $validated = $this->_validate($request);    
        if(!$validated->fails())
        {                                        
            $article->_save($request->input('title'), $request->input('body'), $request->input('author_id'), $request->input('tags'));                        

            return redirect()->route('articles'); //new ArticleResource($article);                    
        }else{
            return view('articles.create', ['errors' => $validated->errors(), 'model' => $article]) ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if($article){
            if($article->delete()){
                return redirect()->route('articles'); //new ArticleResource($article);
            }
        }else{
            return response()->json(['errors' => 'Desired article not found!']);
        }
    }
}
