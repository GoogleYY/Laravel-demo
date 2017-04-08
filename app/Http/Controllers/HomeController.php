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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function personal()
    {
    	$user = auth()->user();

		$userInfo = [
			'name' => $user->name,
			'email' => $user->email,
			'avatar' => $user->avatar,
			'created_at' => $user->created_at
		];

		// 我的收藏
		$collections = \DB::table('collections as a')
			->where('a.user_id', $user->id)
			->leftJoin('articles as b', 'b.article_id', 'a.article_id')
			->get();

		return view('auth.user', compact('userInfo', 'collections'));
    }

    public function articleList()
    {
    	$articles = \DB::table('articles as a')
			->join('categorys as b', 'b.category_id', '=', 'a.category_id')
			->leftJoin('dict_provinces as c' ,'a.province_id', '=', 'c.province_id')
			->leftJoin('dict_cities as d' ,'a.city_id', '=', 'd.city_id')
			->leftJoin('dict_areas as e' ,'a.area_id', '=', 'e.area_id')
			->orderBy('a.article_id', 'desc')
			->paginate(10);

		return view('home', compact('articles'));
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

			// 是否收藏
			$isCollected = null;
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
    	$comments =  Comment::where('article_id', $id)
    		->rightJoin('users as b', 'b.id', '=', 'comments.user_id')
    		->select('comments.*', 'b.name')
    		->orderBy('comments.comment_created_at', 'desc')
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

    	$result = Comment::create($req);

    	return $result ? [
				'code' => 0,
				'msg' => '评论成功'
			] : [
				'code' => -1,
				'msg' => '评论失败'
			];
    }

	// 回复评论 
    public function commentForwardPost()
    {
    	$req = request()->except('_token');

    	$req['user_id'] = auth()->user()->id;
    	$req['forward_created_at'] = Carbon::now();
    	$req['forward_updated_at'] = Carbon::now();

    	$result = CommentForward::create($req);

    	return $result ? [
				'code' => 0,
				'msg' => '回复成功'
			] : [
				'code' => -1,
				'msg' => '回复失败'
			];
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

    // 事务 status: 
    //	1.草稿 
    //	2.申请中 
    //	3.已处理 
    //	4.已删除
    public function affairList()
    {
    	$affairs = Affair::where('user_id', auth()->user()->id)
    		->get();
    	return view('auth.affair.list', compact('affairs'));
    }

    public function affairDetailView($id)
    {
    	$affair = Affair::where('affair_id', $id)->first();

    	return view('auth.affair.detail', compact('affair'));
    }

    // 删除 => status: 4.已删除
    public function affairCancel($id)
    {
    	$result = Affair::where([
    			['user_id', auth()->user()->id],
    			['affair_id', $id]
    		])->update([
    			'affair_status' => 4,
    			'affair_updated_at' => Carbon::now(),
    			'affair_deleted_at' => Carbon::now()
    		]);

		return $result ? [
			'code' => 0,
			'msg' => '删除成功'
		] : [
			'code' => -1,
			'msg' => '删除失败'
		];
    }

    // 事务创建视图
    public function affairCreateView()
    {
    	$isAffairCreateView = true;
    	return view('auth.affair.create', compact('isAffairCreateView'));
    }

    public function affairEditView($id)
    {
    	$isAffairEditView = true;
    	$affair = Affair::where([
    		['user_id', auth()->user()->id],
    		['affair_id', $id]
		])->first();

    	return view('auth.affair.edit', compact('isAffairEditView', 'affair'));
    }

    // 事务保存草稿 => status: 1.草稿
    public function affairCreateSave()
    {
    	$req = request()->except('_token');

    	$req['user_id'] = auth()->user()->id;
    	$req['affair_status'] = 1;
    	$req['affair_created_at'] = Carbon::now();
    	$req['affair_updated_at'] = Carbon::now();

    	if (!request()->affair_id) {
    		// 新建草稿
	    	$result = Affair::create($req);
    	} else {
    		// 更新草稿
    		$result = Affair::where('affair_id', request()->affair_id)
    			->update($req);
    	}

    	return $result ? [
			'code' => 0,
			'msg' => '保存成功'
		] : [
			'code' => -1,
			'msg' => '保存失败'
		];
    }

    // 事务提交 => status: 2.申请中
    public function affairCreatePost()
    {
    	if (!request()->affair_id) { 
    		// 直接提交
    		$req = request()->except('_token');

	    	$req['user_id'] = auth()->user()->id;
	    	$req['affair_status'] = 2;
	    	$req['affair_created_at'] = Carbon::now();
	    	$req['affair_updated_at'] = Carbon::now();

	    	$result = Affair::create($req);
    	} else {
    		// 从草稿提交
    		$result = Affair::where('affair_id', request()->affair_id)
    			->update([
    				'affair_status' => 2
				]);
    	}

    	return $result ? [
			'code' => 0,
			'msg' => '提交成功'
		] : [
			'code' => -1,
			'msg' => '提交失败'
		];
    }

}
