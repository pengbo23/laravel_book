<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 14:03
 */

namespace App\Http\Controllers\Backend;


use App\Eloquent\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        echo json_encode($arr);
        die();
    }


    public function add()
    {
        return view('backend.book.add');
    }

    public function addOp(Request $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->introduction = $request->introduction;
        $book->publish_date = $request->publish_date;
        $res = $book->save();
        echo json_encode($res);
        die();
    }

    public function edit($id)
    {
        $book = new Book();
        return view('backend.book.edit', ['book' => $book->findOrFail($id)]);
    }

    public function update(Request $request)
    {
        $book = Book::find($request->id);
        $book->title = $request->title;
        $book->introduction = $request->introduction;
        $book->publish_date = $request->publish_date;
        $res = $book->save();
        echo json_encode($res);
        die();
    }

    public function delete(Request $request)
    {

       $res =  Book::destroy($request->id);
        echo json_encode($res);
        die();
    }
}