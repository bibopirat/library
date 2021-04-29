<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Book;
class BookController extends Controller
{
  public function all(){

     $booksArr = Book::all();

   return $booksArr;

  }
  public function add(Request $request){
      $book = new Book;
$book->title = $request->title;
$book->author = $request->author;
$book->avialibility = 1;
$book->save();
  return "ok";

 }
 public function delete($id){
Book::destroy($id);
  return "ok";

 }
 public function changeAvailabilty($id){

$book = Book::find($id);
$book->avialibility = !$book->avialibility;
$book->save();

  return $booksArr;

 }
 public function all(){

    $booksArr = Book::all();

  return $booksArr;

 }
}
