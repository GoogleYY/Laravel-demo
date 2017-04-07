<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

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
        // dd('后台首页，当前用户名：'.auth('admin')->user()->name);
        return view('admin.index');
    }

    /***
     * 文章管理
     */
    public function articleList()
    {
    	$sql = \DB::table('articles as a')
			->join('categorys as b', 'a.category_id', '=', 'a.category_id')
			->leftJoin('dict_provinces as c' ,'a.province_id', '=', 'c.province_id')
			->leftJoin('dict_cities as d' ,'a.city_id', '=', 'd.city_id')
			->leftJoin('dict_areas as e' ,'a.area_id', '=', 'e.area_id')
			->orderBy('a.id', 'desc');

		$articles = null;

		$categorys = \DB::table('categorys')
			->get();

		if(!request()->category_id) {
			// 默认显示全部分类
			$articles = $sql->paginate(10);
		} else {
			// 按分类查看
			$articles = $sql->where('a.category_id', request()->category_id)->paginate(10);
		}
		
		return view('admin.article.list', compact('articles', 'categorys'));
    }

    public function articleCreateView()
    {
    	$categorys = \DB::table('categorys')
				->get();

		return view('admin.article.create', compact('categorys'));
    }

    public function imageUpload()
    {
    	$file = request()->file('Filedata');

    	if($file -> isValid()) {
            //$tmpName = $file->getRealPath(); //上传后临时文件的绝对路径
            $extension =  $file->getClientOriginalExtension(); //文件后缀
            $newName = date('YmdHis').'.'.$extension;
            $file->move(base_path().'/uploads', $newName); //移动文件并重命名
            $filePath = 'uploads/'.$newName;
            return $filePath;
        }
    }

    public function articleCreatePost()
    {
    	$article = request()->except('_token');

		$article['article_created_at'] = date('Y-m-d H:i:s', time());
		$article['article_updated_at'] = date('Y-m-d H:i:s', time());

		$rules = [
        	'article_title' => 'required',
        	'article_author' => 'required',
        	'article_content' => 'required'
        ];
        $message = [
        	'article_title.required' => '标题不能为空',
        	'article_author.required' => '作者不能为空',
        	'article_content.required' => '内容不能为空',
        ];
        $validator = Validator::make($article, $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
			$result = \DB::table('categorys')->insert($article);
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
		$areas = \DB::table('areas')
			->get();

		$article = \DB::table('articles')
			->where('article_id', $id)
			->first();

		if ($article) {
			return view('admin.article.modify', compact('categorys', 'areas', 'article'));
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

    public function articleDelete($id)
    {
    	$article = \DB::table('articles')
			->where('article_id', $id)
			->update([
				'article_status' => 0
			]);

		return $article ? [
			'code' => 0,
			'msg' => '删除成功'
		] : [
			'code' => -1,
			'msg' => '删除失败'
		];
    }

    /***
     * 分类管理
     */
    public function categoryList()
    {
    	$categorys = \DB::table('categorys')
			->paginate(10);

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
    	$input = request()->except('_token', '_method');

		$result = \DB::table('categorys')
			->where('category_id', $id)
			->update($input);

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
			->get();

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