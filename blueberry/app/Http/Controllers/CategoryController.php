<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\Categories\AddCategoryRequest;
use App\Http\Requests\Categories\CategoriesRequest;
use App\Http\Requests\Categories\DeleteCategoryRequest;
use App\Http\Requests\Categories\EditCategoryRequest;
use App\Http\Resources\ResourceCategory;
use App\Http\Resources\ResourceFeature;
use App\Models\Category;

use App\Repositories\CategoryRepo;
use App\Repositories\FeatureRepo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-category')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'categories';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Categories',
                    'url' => url('admin/categories'),
                    'active' => 'categories',
                ]
            ];
            $statuses = StatusEnum::values();
            $features = FeatureRepo::getAllFeatures();
            return view('categories', compact(
                'active',
                'breadCrumbs',
                'permissions',
                'features',
                'statuses'
            ));
        } else {
            $model = Category::query()->with(['feature','parentCategory']);

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('image', function ($data) {
                    if(!empty($data->image)){
                        $data->src = asset('storage/images/categories/'.$data->image);
                        return '<img src="'.$data->src.'" alt="Category Image" width="75"/>';
                    }

                })->editColumn('feature_id', function ($data) {
                    return $data->feature?->name;
                })->editColumn('parent_id', function ($data) {
                    return $data->parentCategory?->name;
                })
                ->addColumn('actions', function ($data) use ($permissions) {

                    $html = "";
                    if (hasPermissions($permissions, 'edit-category')) {
                        $html .= "<a title='Edit Category' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                    }
                    if (hasPermissions($permissions, 'delete-category')) {
                        $html .= '<a title="Delete Category" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                    }
                    return $html;
                })->rawColumns(['actions','image'])->make(true);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCategoryRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Category created successfully!";
        $data = $request->all();
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'categories_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/categories', $imageName);
            $data['image'] = $imageName;

        }
        $response['data'] = new ResourceCategory(Category::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditCategoryRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Category Updated successfully!";
        $data = $request->all();
        $category = Category::where('id', $request->id)->first();
        $category->name = $data['name'];
        $category->status = $data['status'];
        $category->feature_id = $data['feature_id'];
        $category->parent_id = $data['parent_id'];
        $category->description = $data['description'];
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'categories_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/categories', $imageName);
            $category->image = $imageName;

        }
        $category->save();
        $response['data'] = new ResourceCategory($category);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCategoryRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Category Deleted successfully!";
        $category = Category::where('id', $request->id)->first();
        $category->delete();
        $response['data'] = new ResourceCategory($category);
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function categories(CategoriesRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Feature Categories fetched successfully!";
        $parentId = null;
        if ($request->has('parent_id')) {
            $parentId = $request->parent_id;
        }
        $categories = CategoryRepo::getAllFeatureCategories($request->feature_id, $parentId);
        $html = '<option value="">Select Category</option>';
        foreach ($categories as $category) {
            $html .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }
        $response['html'] = $html;
        return response()->json($response);
    }
    public function getSubCategories(Request $request)
    {
        $category = Category::where('status',StatusEnum::ACTIVE)->whereNotNull('parent_id');
        if($request->has('category_id')){
            $category->where('parent_id',$request->category_id);
        }

        return $category->get();
    }

}
