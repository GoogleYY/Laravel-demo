<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Collection;
use App\Models\Comment;
use App\Models\CommentForward;
use App\Models\Affair;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * 前台控制器.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {

    }

    public function index()
    {
        return view('home');
    }

    // 图片上传
    public function imageUpload()
    {
    	$file = request()->file('Filedata');

    	if($file -> isValid()) {
            //$tmpName = $file->getRealPath(); //上传后临时文件的绝对路径
            $extension =  $file->getClientOriginalExtension(); //文件后缀
            $newName = date('YmdHis').'.'.$extension;
            $file->move(base_path().'/resources/assets/img', $newName); //移动文件并重命名
            $filePath = 'resources/assets/img/'.$newName;
            return $filePath;
        }
    }

    public function articleList()
    {
    	$sql = \DB::table('articles as a')
			->join('categorys as b', 'b.category_id', '=', 'a.category_id')
			->leftJoin('dict_provinces as c' ,'a.province_id', '=', 'c.province_id')
			->leftJoin('dict_cities as d' ,'a.city_id', '=', 'd.city_id')
			->leftJoin('dict_areas as e' ,'a.area_id', '=', 'e.area_id')
			->orderBy('a.article_id', 'desc');

        $articles = null;

        // $comments = [];
        // foreach($sql->where('a.article_status', 1)->get() as $article) {
        //     $comment = \DB::table('comments as a')
        //         ->where('a.article_id', $article->article_id)
        //         ->get();
        //     array_push($comments, $comment);
        // }
        // // dd($comments);
        $category_id = null;
        if ($category_id = request()->category_id) {
            // 按分类查看
            $articles = $sql
                ->where('a.article_status', 1)
                ->where('a.category_id', $category_id)
                ->paginate(10);
        } elseif (!request()->search_text) {
            // 全部
            $articles = $sql
                ->where('a.article_status', 1)
                ->paginate(10);

            // 主页
            return view('home', compact('articles'));
        }
        // 搜索
        if ($search_text = request()->search_text) {
            $articles = $sql
                ->where([
                    ['a.article_status', 1],
                    ['a.article_title', 'like', '%'.$search_text.'%']
                ])
                ->orWhere([
                    ['a.article_status', 1],
                    ['a.article_content', 'like', '%'.$search_text.'%']
                ])->paginate(10);
        }

        // 其它情况 分类页
		return view('articles', compact('articles', 'category_id'));
    }

    public function articleDetail($id)
    {
    	$sql = \DB::table('articles as a')->where('a.article_id', $id);

		if ($sql->first()) {
			// 记录查看次数
			$current_view_counts = $sql->first()->article_view_counts;

			$sql->update(['article_view_counts' => $current_view_counts + 1]);

			$article = $sql
				->join('categorys as b', 'b.category_id', '=', 'a.category_id')
				->leftJoin('dict_provinces as c' ,'a.province_id', '=', 'c.province_id')
				->leftJoin('dict_cities as d' ,'a.city_id', '=', 'd.city_id')
				->leftJoin('dict_areas as e' ,'a.area_id', '=', 'e.area_id')
				->first();

			// 上一篇
			$prev_id = \DB::table('articles')
				->where('article_id', '<', $id)
				->max('article_id');
			// 下一篇
        	$next_id = \DB::table('articles')
				->where('article_id', '>', $id)
				->min('article_id');

			// 更新查看评论时间
			if(auth()->check()) {
			\DB::table('comments')
				->where([
					['user_id', auth()->user()->id],
					['article_id', $id]
				])->update([
					'comment_viewed_at' => Carbon::now()
				]);
			}
            // 是否收藏
            $isCollected = null;
            $collection_id = null;
            if (auth()->check()) {
                $collection_id = \DB::table('collections')
                    ->where([
                        ['article_id', $id],
                        ['user_id', auth()->user()->id],
                    ])->first(['collection_id']);
            }

			$isCollected = $collection_id ? 1 : 0;

			$isArticleDetail = true;

			return view('article', compact('article', 'prev_id', 'next_id', 'isCollected', 'isArticleDetail'));
		} else {
			abort(404);
		}
    }

    public function commentRedirect($id)
    {
    	return redirect('article/'.$id);
    }

    public function commentList($id)
    {
        $field = 'comments.comment_updated_at';
        if(request()->field == 'comment_created_at') {
            $field = 'comments.comment_created_at';
        }
    	$comments =  Comment::where('article_id', $id)
    		->rightJoin('users as b', 'b.id', '=', 'comments.user_id')
    		->select('comments.*', 'b.name', 'b.avatar')
    		->orderBy($field, 'desc')
    		->get();
		// $commentForwards = [];
		foreach ($comments as $comment) {
			$forwards = CommentForward::where('comment_id', $comment->comment_id)
				->rightJoin('users as b', 'b.id', '=', 'comment_forwards.user_id')
				->select('comment_forwards.*', 'b.name')
				->orderBy('comment_forwards.forward_created_at', 'desc')
				->get();
			if($forwards) {
				$comment->forwards = $forwards;
			}
		}

		return $comments;
    }

    public function commentPost()
    {
    	$req = request()->except('_token');

    	$req['user_id'] = auth()->user()->id;
    	$req['comment_created_at'] = Carbon::now();
    	$req['comment_updated_at'] = Carbon::now();
    	$req['comment_viewed_at'] = Carbon::now();

    	$result = Comment::create($req);

    	if ($result) {
	    	$res = $req;
            $res['name'] = auth()->user()->name;
    		$res['avatar'] = auth()->user()->avatar;
    		$res['comment_created_at'] = Carbon::now()->toDateTimeString();
    		$res['comment_updated_at'] = Carbon::now()->toDateTimeString();
    		$res['comment_viewed_at'] = Carbon::now()->toDateTimeString();
    		return ['code' => 0, 'msg' => '评论成功', 'comment' => $res];
    	} else {
    		return ['code' => -1, 'msg' => '评论失败'];
    	}
    }

	// 回复评论
    public function commentForwardPost()
    {
    	$req = request()->except('_token');

    	$req['user_id'] = auth()->user()->id;
    	$req['forward_created_at'] = Carbon::now();
    	$req['forward_updated_at'] = Carbon::now();

    	$result = CommentForward::create($req);

    	if ($result) {
            Comment::where('comment_id', $req['comment_id'])
            ->update([
                'comment_updated_at' => Carbon::now()
            ]);

	    	$res = $req;
    		$res['name'] = auth()->user()->name;
    		$res['forward_created_at'] = Carbon::now()->toDateTimeString();
    		$res['forward_updated_at'] = Carbon::now()->toDateTimeString();

    		return ['code' => 0, 'msg' => '回复成功', 'forward' => $res];
    	} else {
    		return ['code' => -1, 'msg' => '回复失败'];
    	}
    }

	// 文章收藏
    public function articleCollect()
    {
    	$isCollected = Collection::where([
    		['article_id', request()->article_id],
			['user_id', auth()->user()->id],
		]);
		if (!$isCollected->first()) {
			$result = Collection::create([
				'article_id' => request()->article_id,
				'user_id' => auth()->user()->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			]);
			return $result ? [
				'code' => 0,
				'msg' => '收藏成功'
			] : [
				'code' => -1,
				'msg' => '收藏失败'
			];
		} else {
			$result = Collection::where([
				['article_id', request()->article_id],
				['user_id', auth()->user()->id],
			])->delete();

			return $result ? [
				'code' => 0,
				'msg' => '取消成功'
			] : [
				'code' => -1,
				'msg' => '取消失败'
			];
		}
    }

}
