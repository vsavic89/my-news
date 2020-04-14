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
    public function _returnCreateView($model = null, $validated = null)
    {
        return view('articles.create', ['model' => $model, 'authors' => $this->_getAuthors(), 'tags' => $this->_getTags(), 'errors' => (!empty($validated) ? $validated->errors() : $validated)]);
    }
    
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
        return $this->_returnCreateView();
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
            $article->_save($request->all());                        

            return redirect()->route('articles'); //new ArticleResource($article);                    
        }else{            
            $article = new Article();
            $article->fill($request->all());
            if(!empty($request->tags))
            {
                for($i=0;$i<count($request->tags);$i++)
                {
                    $array[] = (object)['id' => $request->tags[$i]];
                }

                $article->tags = $array;
            }
            return $this->_returnCreateView($article, $validated); //view('articles.create', ['errors' => $validated->errors()]) ;
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
        
        return $this->_returnCreateView($article, null);
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
            $article->_save($request->all());                        

            return redirect()->route('articles'); //new ArticleResource($article);                    
        }else{
            return $this->_returnCreateView($article, $validated);
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
