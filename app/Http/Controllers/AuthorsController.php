<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;

class AuthorsController extends Controller
{
    
    public function _validate(Request $request)
    {
        $validator = \Validator::make($request->all(), AuthorRequest::rules());

        return $validator;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::latest()->paginate(30);
        
        return view('authors.index', [
            'authors' => AuthorResource::collection($authors),            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
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
            $author = new Author();            
            $author->_save($request->input('first_name'), $request->input('last_name'), $request->input('city'));                                    

            return redirect()->route('authors');
        }else{
            return view('authors.create', ['errors' => $validated->errors()]) ;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        
        return view('authors.create', ['model' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {                                        
        $validated = $this->_validate($request);                
        $author = Author::findOrFail($request->route('id'));                    
        if(!$validated->fails())
        {                    
            $author->_save($request->input('first_name'), $request->input('last_name'), $request->input('city'));                                    

            return redirect()->route('authors');
        }else{
            return view('authors.create', ['errors' => $validated->errors(), 'model' => $author]) ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        if($author)
        {
            if($author->delete()){
              return redirect()->back(); //new AuthorResource($author);  
            }
        }else{
            return response()->json(['errors' => 'Can\'t find author!']);
        }
    }
}
