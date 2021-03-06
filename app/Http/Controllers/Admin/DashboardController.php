<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Article;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth.admin:admin');
    }

    public function index()
    {
        $sql = \DB::table('articles as a')
            ->orderBy('article_view_counts', 'desc');

        $categorys = \DB::table('categorys')->get();

        if(!request()->category_id) {
            $articles = $sql->take(8)->get();
        } else {
            $articles = $sql->where('a.category_id', request()->category_id)
                ->take(8)->get();
        }

        $isHome = true;

        return view('admin.index', compact('articles', 'categorys' ,'isHome'));
    }

    /***
     * 文章管理
     */
    public function articleList()
    {
    	$sql = \DB::table('articles as a')
			->join('categorys as b', 'b.category_id', '=', 'a.category_id')
			->orderBy('a.article_updated_at', 'desc');

		$articles = null;

		$categorys = \DB::table('categorys')->get();

		if(!request()->category_id) {
			// 默认显示全部分类
            if (request()->search_text) {
                // 搜索
			     $articles = $sql
                 ->where('a.article_title', 'like', '%'.request()->search_text.'%')
                 ->orWhere('a.article_content', 'like', '%'.request()->search_text.'%')
                 ->paginate(6);
            } else {
                $articles = $sql->paginate(6);
            }
		} else {
			// 按分类查看
			$articles = $sql->where('a.category_id', request()->category_id)->paginate(10);
		}

		return view('admin.article.list', compact('articles', 'categorys'));
    }

    public function articleComments($id)
    {
        $comments = \DB::table('comments')
            ->where('article_id', $id)
            ->paginate(6);

        return view('admin/article/comment/list', compact('comments'));
    }

    public function commentDelete()
    {
        $comment = \DB::table('comments')
            ->where('comment_id', request()->id)
            ->delete();

        $forwards = \DB::table('comment_forwards')
            ->where('comment_id', request()->id)
            ->delete();

        return $comment && $forwards ? [
            'code' => 0,
            'msg' => '删除成功'
        ] : [
            'code' => -1,
            'msg' => '删除失败'
        ];
    }

    public function articleCreateView()
    {
    	$categorys = \DB::table('categorys')
				->get();

		return view('admin.article.create', compact('categorys'));
    }

    public function articleCreatePost()
    {
    	$article = request()->except('_token');
    	//date('Y-m-d H:i:s', time())
		$article['article_created_at'] = Carbon::now();
		$article['article_updated_at'] = Carbon::now();

        $validator = Validator::make($article, [
	    		'article_title' => 'required',
	        	'article_author' => 'required',
	        	'article_content' => 'required|min:10'
    		], [
    			'article_title.required' => '标题不能为空',
	        	'article_author.required' => '作者不能为空',
	        	'article_content.required' => '内容不能为空',
	        	'article_content.min' => '内容太少',
    		]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
			$result = Article::create($article);

			if($result) {
				return back()->withErrors('添加成功');
			} else {
				return back()->withErrors('添加失败');
			}
		}
    }

    public function articleModifyView($id)
    {
    	$categorys = \DB::table('categorys')
			->get();
		// $areas = \DB::table('areas')
		// 	->get();

		$article = \DB::table('articles')
			->where('article_id', $id)
			->first();

		if ($article) {
			return view('admin.article.modify', compact('article', 'categorys'));
		} else {
			abort(404);
		}
    }

    public function articleModifyPost($id)
    {
    	$input = request()->except('_token', '_method');

		$result = \DB::table('articles')
			->where('category_id', $id)
			->update($input);

        if ($result) {
            return redirect('admin/article/list');
        } else {
            return back()->with('errors', '出错了 ！');
        }
    }

    public function articleDelete()
    {
    	$article = \DB::table('articles')
			->where('article_id', request()->id)
			->update([
				'article_status' => 2
			]);

		return $article ? [
			'code' => 0,
			'msg' => '删除成功'
		] : [
			'code' => -1,
			'msg' => '删除失败'
		];
    }

    // 事务管理
    // 事务 status:
    //  1.草稿
    //  2.申请中
    //  3.已处理
    //  4.已取消
    //  5.已删除
    public function affairList()
    {
        $affairs = \DB::table('affairs')
            ->whereNotIn('affair_status', [1, 4, 5]) // 排除草稿
            ->paginate(10);

        return view('admin.affair.list', compact('affairs'));
    }

    public function affairHandleView($id)
    {
        $affair = \DB::table('affairs')
            ->where('affair_id', $id)
            ->first();

        return view('admin.affair.handle', compact('affair'));
    }

    public function affairHandlePost()
    {
        $result = \DB::table('affairs')
            ->where('affair_id', request()->affair_id)
            ->update([
                'affair_status' => '3',
                'affair_updated_at' => Carbon::now()
            ]);

        return $result ? [
            'code' => 0, 'msg' => '处理成功'
        ] : [
            'code' => -1, 'msg' => '处理失败'
        ];
    }

    /***
     * 分类管理
     */
    public function categoryList()
    {
    	$categorys = \DB::table('categorys')->get();

        foreach ($categorys as $category) {
            $article = \DB::table('articles')
                ->where('articles.category_id', $category->category_id)
                ->get();
            $category->article_count = count($article);
        }

		return view('admin.category.list', compact('categorys'));
    }

    public function categoryCreateView()
    {
    	return view('admin.category.create');
    }

    public function categoryCreatePost()
    {
    	$category_name = request()->except('_token');

		$rules = [
        	'category_name' => 'required'
        ];
        $message = [
        	'category_name.required' => '分类名不能为空'
        ];
        $validator = Validator::make($category_name, $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
			$result = \DB::table('categorys')->insert($category_name);
			if($result) {
				return back()->withErrors('添加成功');
			} else {
				return back()->withErrors('添加失败');
			}
		}
    }

    public function categoryModifyView($id)
    {
    	$category = \DB::table('categorys')
			->where('category_id', $id)
			->first();
		return view('admin.category.modify', compact('category'));
    }

    public function categoryModifyPut($id)
    {
    	$res = request()->except('_token', '_method');

		$result = \DB::table('categorys')
			->where('category_id', $id)
			->update($res);

        if ($result) {
            return redirect('admin/article/index');
        } else {
            return back()->with('errors', '出错了 ！');
        }
    }

    public function categoryDelete()
    {
    	$article = \DB::table('articles')
			->where('category_id', request()->id)
			->first();

		if (!$article) {
			$result = \DB::table('categorys')
				->where('category_id', request()->id)
				->delete();
			return $result ? [
				'code' => 0,
				'msg' => '删除成功'
			] : [
				'code' => -1,
				'msg' => '删除失败'
			];
		} else {
			return ['code' => -2, 'msg' => '该分类下存在文章,请先调整分类'];
		}
    }
}
