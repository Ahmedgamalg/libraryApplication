<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StorSection;
use App\Section;
use App\Book;
use DB;
class SectionController2 extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = DB::table('section')->paginate(20);
        
        
        return view('site.library')->withsection($section);
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
    public function store(StorSection $request)
    {


        $section_name=$request->section_name;
        $books_total=$request->books_total;
        $file=$request->file('image');
        $destinationPath='website/images';
        $filename = str_random(6).'_'.$file->getClientOriginalName();
        $file->move($destinationPath,$filename);



        
        $new_section= new Section;
        $new_section->section_name=$section_name;
        $new_section->books_total=$books_total;
        $new_section->section_pic=$filename;
        $new_section->save();
        //session()->push('m','success');
        //section()->push('m','section create successfuly');
 
        return redirect('admin');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section =Section::find($id);
        $all_books = Section::find($id)->books;
        /* $section= Section::find($id);
       $all_books = DB::table('section')
            ->join('books', 'section_id', '=', 'books.section_id')
             ->where('books.section_id', '=', $id)
            ->get();
            $all_books=$section->books();*/
            $array_of_authers=[];
            $i=0;
            foreach ($all_books as $book) {
                # code...
$array_of_authers= array_add($array_of_authers,$i,
               /*   DB::table)("books")
                 -> join("books_authors_relationship","book_id","=","books_authors_relationship.book_id")
                 -> join("author","books_authors_relationship.author_id","=","author.id")
                 ->where("books.id",$book->id)
                 ->select("author.first_name","author.id")
                 ->get()*/
                 $book->authors()->select("author.first_name","author.id")->get() );
                  $i++;
                  
            }
       
         return view('site.books')->withall_books($all_books)
                                  ->withsection($section)
                                  ->witharray_of_authers($array_of_authers);   

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
        $section_name=$request->section_name;
        $books_total=$request->books_total;
       $section= Section::find($id);
       $section->section_name=$section_name;
       $section->books_total=$books_total;
    $section->save();
        session()->push('m','success');
        session()->push('m','section update successfuly');
        return redirect('admin');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Section::destroy($id);
        session()->push('m','danger');
        session()->push('m','section delete successfuly');
        return redirect('admin');
        //
    }
    public function adminform()
    {
        $section=section::withTrashed()->get();
        return view('site/admin')->withsection($section);
        //
    }
    public function restored($id)
    {
        $section=section::onlyTrashed()->find($id);
        $section->restore();
        session()->push('m','success');
        session()->push('m','section restore successfuly');
        return redirect('admin');
        //
    }
    public function deleteforever($id)
    {
        $section=section::onlyTrashed()->find($id);
        $section->forceDelete();
        session()->push('m','danger');
        session()->push('m','section delete successfuly');
        return redirect('admin');
        //
    }
    
}
