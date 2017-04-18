<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Article;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\CommentForward;
use App\Models\Affair;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function personal()
    {
    	$user = auth()->user();

		$userInfo = [
			'name' => $user->name,
			'email' => $user->email,
			'avatar' => $user->avatar,
			'created_at' => $user->created_at
		];

		return view('auth.info.collection', compact('userInfo'));
    }

    public function modifyMyInfo()
    {
        $isModifyInfoView = true;
        return view('auth.info.modify', compact('isModifyInfoView'));
    }

    public function modifyMyInfoPost()
    {
        $req = request()->except('_token');
        $validator = Validator::make($req, [
            'name' => 'required|min:6'
        ], [
            'name.required' => '昵称不能为空',
            'name.min' => '昵称必须大于6位'
        ]);

        $req['updated_at'] = Carbon::now();

        if($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $result = User::where('id', auth()->user()->id)
                ->update($req);
            if ($result) {
                return back()->withErrors('资料修改成功');
            } else {
                return back()->withErrors('资料修改失败');
            }
        }
    }

    public function unreadComments()
    {
        $unreadComments = array();
        $comments = Comment::where('user_id', auth()->user()->id)->get();

        foreach ($comments as $comment) {
            if ($comment->comment_updated_at > $comment->comment_viewed_at) {
                array_push($unreadComments, $comment);
            }
        }
        // return view('auth.info.comment', compact('unreadComments'));
        return $unreadComments;
    }

	public function userComments()
    {
        $unreadComments = (array)$this->unreadComments();

        return view('auth.info.comment', compact('unreadComments'));
    }

    public function forwardList()
    {
    	$forwards = \DB::table('comment_forwards as a')
            ->leftJoin('comments as b', 'a.comment_id', '=', 'b.comment_id')
            ->join('articles as c', 'c.article_id', '=', 'b.article_id')
            ->where('a.user_id', auth()->user()->id)
            ->orderBy('a.forward_created_at', 'desc')
            ->select('a.*', 'b.*', 'c.article_id', 'c.article_title')
            ->paginate(10);

    	return view('auth.info.forward', compact('forwards'));
    }

    public function collectionList()
    {
    	// 我的收藏
		$collections = \DB::table('collections as a')
			->where('a.user_id', auth()->user()->id)
			->rightJoin('articles as b', 'b.article_id', '=', 'a.article_id')
            ->orderBy('a.updated_at', 'desc')
			->get();

    	return view('auth.info.collection', compact('collections'));
    }

    // 提问
    public function questView()
    {
        $isQuestionView = true;
        return view('auth.quest', compact('isQuestionView'));
    }

    public function questPost()
    {
        $req = request()->except('_token');
        $req['article_author'] = auth()->user()->name;
        $req['category_id'] = 10;
        $req['article_created_at'] = Carbon::now();
        $req['article_updated_at'] = Carbon::now();

        $validator = Validator::make($req, [
            'article_title' => 'required|min:6',
            'article_content' => 'required|min:10'
        ], [
            'article_title.required' => '标题不能为空',
            'article_title.min' => '标题字数太少',
            'article_content.required' => '内容不能为空',
            'article_content.min' => '多写点吧'
        ]);

        if ($validator->fails()) {
            return $validator;
        }

        $result = Article::create($req);

        return $result ? [
            'code' => 0,
            'msg' => '问题发表成功'
        ] : [
            'code' => -1,
            'msg' => '出错了'
        ];
    }

    // 事务 status:
    //	1.草稿
    //	2.申请中
    //	3.已处理
    //	4.已取消
    //	5.已删除
    public function affairList()
    {
    	$affairs = Affair::where([
            ['user_id', auth()->user()->id],
            ['affair_status', '!=', 5]
        ])->get();

    	return view('auth.info.affair', compact('affairs'));
    }

    public function affairDetailView($id)
    {
    	$isAffairDetailView = true;

    	$affair = Affair::where('affair_id', $id)->first();

    	return view('auth.affair.detail', compact('affair', 'isAffairDetailView'));
    }

    // 取消 => status: 4.已取消
    public function affairCancel()
    {
    	$result = Affair::where([
    			['user_id', auth()->user()->id],
    			['affair_id', request()->affair_id]
    		])->update([
    			'affair_status' => 4,
    			'affair_updated_at' => Carbon::now()
    		]);

		return $result ? [
			'code' => 0,
			'msg' => '取消成功'
		] : [
			'code' => -1,
			'msg' => '取消失败'
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
    	$req['affair_updated_at'] = Carbon::now();

    	if (!$req['affair_id']) {
            unset($req['affair_id']);
    		// 新建草稿
    		$req['affair_created_at'] = Carbon::now();
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

    // 事务删除 => status: 5.已删除
    public function affairDelete()
    {
    	$result = Affair::where([
    			['user_id', auth()->user()->id],
    			['affair_id', request()->affair_id]
    		])->update([
    			'affair_status' => 5,
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
}
