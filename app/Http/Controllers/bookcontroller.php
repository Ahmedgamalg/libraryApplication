<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddNewBook;
use App\Book;
use App\Section;
use DB;
use App\Http\Requests;

class bookcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewBook $request)
    {
        //
        DB::transaction(function() use($request){
        $auther_id = 1;
        $anather_auther=$request->anather_auther;
        $auther2=DB::table("author")
                 ->where("first_name",$anather_auther)
                 ->select("id")
                 ->first();
        
       



        $book_title=$request->book_title;
        $book_edition=$request->book_edition;
        $book_discrebtion=$request->book_discrebtion;  
        $section_id=$request->section_id;
       $ID_Book= DB::table("books")
            ->insertGetId(["book_title"=>$book_title,
            "book_edition"=>$book_edition,
            "book_discrebtion"=>$book_discrebtion,
            "section_id"=>$section_id]);
        /*$new_book= new Book;
        $new_book->book_title=$book_title;
        $new_book->book_edition=$book_edition;
        $new_book->book_discrebtion=$book_discrebtion;
        $new_book->section_id=$section_id;
        $new_book->save();*/

        if ( $auther2 !=null) {
            $auther2_id=$auther2->id;
            DB::table("books_authors_relationship")
            ->insert([
                ["book_id"=>$ID_Book,"author_id"=>$auther_id],
                ["book_id"=>$ID_Book,"author_id"=>$auther2_id]

               ] );
        }
            
        
        else{
            DB::table("books_authors_relationship")
             ->insert(["book_id"=>$ID_Book,"author_id"=>$auther_id]);
        }
        });
        $section_id=$request->section_id;
        return redirect('library/'.$section_id);
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
        //
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
        $book_title=$request->book_title;
        $book_edition=$request->book_edition;
        $book_discrebtion=$request->book_discrebtion;
        $section_id=$request->section_id;
        $book= Book::find($id);
        $book->book_title=$book_title;
        $book->book_edition=$book_edition;
        $book->book_discrebtion=$book_discrebtion;
        $book->save();
        return redirect('library/'.$section_id);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $section_id=$request->section_id;
       Book::destroy($id);
     return redirect('library/'.$section_id);
        //
    }
    public function summery(){

        
        $resultes=Book::with('authors')->with('Section')->get();
        
        return view('site.summery')->withresultes($resultes);

    }
}
