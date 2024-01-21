<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show all category and search here
    public function index(Request $request)
    {
        $categories = null;
        if ($request->get('search')) {
            $search = $request->search;
            $categories = Category::where('name', 'like', '%'.$search.'%')
                ->with('parent')
                ->paginate(10);
        } else {
            $categories = Category::with('parent')->paginate(10);
        }

        return view('module.category.index', compact('categories'));
    }

    //create category model
    public function create()
    {
        $categories = Category::published()->where('parent_category_id', 0)->get();

        return view('module.category.create', compact('categories'));
    }

    //store the category
    public function store(Request $request)
    {
        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => translate('Category name is required'),
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_category_id = $request->parent_category_id ?? 0;

        //store the icon
        if ($request->has('icon')) {
            $fileName = fileUpload($request->icon, 'category');
            $category->icon = $fileName;
        }
        $category->save();
        notify()->success(translate('Category created successfully'));

        return back();
    }

    //edit category model
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::published()
            ->where('parent_category_id', 0)
            ->get();

        return view('module.category.edit', compact('category', 'categories'));
    }

    //update the category
    public function update(Request $request)
    {

        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => translate('Category name is required'),
        ]);
        $category = Category::where('id', $request->id)->first();
        if ($request->hasFile('icon')){
            fileDelete($category->icon);
           $imageName = fileUpload($request->icon, 'category');
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($category->name).$category->id,
            'parent_category_id' => $request->parent_category_id ?? 0,
            'icon' => $imageName ?? $category->icon,
        ]);


        notify()->success(translate('Category updated successfully'));

        return back();
    }

    //soft delete the category
    public function destroy($id)
    {
        $course = Course::where('category_id', $id)->count();

        if ($course === 0) {
            Category::where('id', $id)->delete();
            Alert::toast(translate('Category deleted successfully'));

        } else {
            Alert::error('warning', 'This category already in used.');
        }
        return back();
    }

    //published
    public function published(Request $request)
    {
       $id =($request->has('id')) ? $request->id : $request->is_argsid;

        $cat = Category::where('id', $id)->first();
        if(!$cat)
        {
            notify()->info(translate('Category not found'));
            return back();
        }
        $cat->update([
            'is_published' => ($cat->is_published == 1) ? 0 : 1
        ]);
        return response(['message' => translate('Category active status is changed ')], 200);
    }

    // published
    public function popular(Request $request)
    {
        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        // don't use this type of variable naming, use $category instead of $cat1
        $cat = Category::where('id', $request->id)->first();
        if ($cat->is_popular == 1) {
            $cat->is_popular = 0;
            $cat->save();
        } else {
            $cat->is_popular = 1;
            $cat->save();
        }

        return response(['message' => translate('Category popular status is changed')], 200);
    }

    // published
    public function top(Request $request)
    {
        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        // don't use this type of variable naming, use $category instead of $cat1
        $cat = Category::where('id', $request->id)->first();
        if ($cat->top == 1) {
            $cat->top = 0;
            $cat->save();
        } else {
            $cat->top = 1;
            $cat->save();
        }

        return response(['message' => translate('Category top status is changed')], 200);
    }

    //END
}
