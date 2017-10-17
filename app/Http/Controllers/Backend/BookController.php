<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 14:03
 */

namespace App\Http\Controllers\Backend;


use App\Eloquent\Book;
use App\Eloquent\BookIsTag;
use App\Eloquent\BookTag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        return view('backend.book.index');
    }

    public function getBook(Request $request)
    {
        $where = array();
        if($request->title){
            $where[] = array('title', 'like', '%' . $request->title . '%');
        }
        $list = Book::where($where)
            ->simplePaginate($request->limit)
            ->toArray();
        /*if ($request->title) {
            $list = Book::where('title', 'like', '%' . $request->title . '%')
                ->simplePaginate($request->limit)
                ->toArray();
        } else {
            $list = Book::simplePaginate($request->limit)->toArray();
        }*/
        foreach ($list['data'] as $key => $val) {
            $list['data'][$key]['editUrl'] = route('book.edit', $val['id']);
        }
        $arr = array(
            'code' => 0,
            'count' => Book::all()->count(),
            'data' => $list['data'],
            'msg' => '',
        );
        return response()->json($arr);

    }


    public function add()
    {
        $bookTag = BookTag::all();
        return view('backend.book.add',['bookTag'=>$bookTag]);
    }

    public function addOp(Request $request)
    {

        $book = new Book();
        $book->title = $request->title;
        $book->introduction = $request->introduction;
        $book->publish_date = $request->publish_date;
        $res = $book->save();
        if($request->tag){
            foreach ($request->tag as $key=>$val){
                $bookIsTag = new BookIsTag();
                $bookIsTag->book_tag_id = $key;
                $bookIsTag->book_id = $book->id;
                $res = $bookIsTag->save();
            }
        }
        return response()->json($res);

    }

    public function edit($id)
    {
        $book = new Book();
        $bookItem = $book->findOrFail($id);
        $tagAll = BookTag::all()->toArray();
        $tagIds = DB::table('book_is_tag')->where('book_is_tag.book_id','=',$bookItem->id)
           ->select('book_tag.id')
           ->join('book_tag','book_is_tag.book_tag_id','book_tag.id')
           ->get()->toArray();
        $tempIds = array();
        foreach ($tagIds as $val){
            $tempIds[$val->id] = 1;
        }
        foreach ($tagAll as $key=>$val){
             if(isset($tempIds[$val['id']])){
                 $tagAll[$key]['check'] = 1;
             }else{
                 $tagAll[$key]['check'] = 0;
             }
        }
       return view('backend.book.edit', ['book' => $bookItem,'bookTag'=>$tagAll]);
    }

    public function update(Request $request)
    {
        $book = Book::find($request->id);
        $book->title = $request->title;
        $book->introduction = $request->introduction;
        $book->publish_date = $request->publish_date;
        $res = $book->save();
        if($request->tag){
            BookIsTag::where('book_id',$book->id)->delete();
            foreach ($request->tag as $key=>$val){
                $bookIsTag = new BookIsTag();
                $bookIsTag->book_tag_id = $key;
                $bookIsTag->book_id = $book->id;
                $res = $bookIsTag->save();
            }
        }
        return response()->json($res);

    }

    public function delete(Request $request)
    {
       $res =  Book::destroy($request->id);
        return response()->json($res);
    }
}