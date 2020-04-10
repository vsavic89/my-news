<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use Illuminate\Validation\Validator;

class AuthorsController extends Controller
{
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
        $validator = \Validator::make($request->all(), AuthorRequest::rules());

        if ($validator->fails()) {
            return view('_error_handler', ['errors' => $validator->errors()]);
        }else{
            $author = ($request->isMethod('put')) ? Author::findOrFail($request->input('id')) : new Author();            
            $author->_save($request->input('first_name'), $request->input('last_name'), $request->input('city'));                                    

            return redirect()->route('authors');
//            return new AuthorResource($author);      
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
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
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
            return response()->json(['error' => 'Can\'t find author!']);
        }
    }
}
