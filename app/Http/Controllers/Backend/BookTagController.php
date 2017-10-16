<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16
 * Time: 10:30
 */

namespace App\Http\Controllers\Backend;


use App\Eloquent\BookTag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookTagController extends Controller
{
    /**
     * 书籍标签
     */
    public function index()
    {
        return view('backend.bookTag.index');
    }

    public function getBookTag(Request $request)
    {
        $where = array();
        if($request->title){
            $where[] = array('tag', 'like', '%' . $request->title . '%');
        }
        $list = BookTag::where($where)
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
            $list['data'][$key]['editUrl'] = route('bookTag.edit', $val['id']);
        }
        $arr = array(
            'code' => 0,
            'count' => BookTag::all()->count(),
            'data' => $list['data'],
            'msg' => '',
        );
        echo json_encode($arr);
        die();
    }


    public function add()
    {
        return view('backend.bookTag.add');
    }

    public function addOp(Request $request)
    {
        $book = new BookTag();
        $bookTag= $book->where('tag',$request->tag)->first();

        if($bookTag){
            return response()->json('标签不能重复');
        }
        $book->tag = $request->tag;
        $res = $book->save();
        return response()->json($res);

    }

    public function edit($id)
    {
        $book = new BookTag();
        return view('backend.bookTag.edit', ['book' => $book->findOrFail($id)]);
    }

    public function update(Request $request)
    {
        $book = BookTag::find($request->id);
        $book->tag = $request->tag;
        $res = $book->save();
        return response()->json($res);

    }

    public function delete(Request $request)
    {

        $res =  BookTag::destroy($request->id);
        return response()->json($res);

    }
}