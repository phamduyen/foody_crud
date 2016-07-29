<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class CategoryController extends InfyOmBaseController {

    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo) {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        $this->categoryRepository->pushCriteria(new RequestCriteria($request));
        $categories = $this->categoryRepository->paginate(3);

        return view('categories.index')
                        ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create() {
        if (Gate::check('user')) {
            Flash::error('You can not do that');
            abort(503);
        }
        return view('categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request) {
        $avata = Input::file('image');
        if ($avata != null) {
            $destinationPath = public_path() . "/img/upload"; // give path of directory where you want to save your files
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $filename = $timestamp . '.' . $avata->getClientOriginalExtension();
            $upload_success = $avata->move($destinationPath, $filename);

            if ($upload_success) {
                $input = array('name' => $request->input('name'), 'image' => $filename);
                $category = $this->categoryRepository->create($input);
            } else {
                return redirect(route('categories.create'));
                Flash::fail('Category can save');
            }
        } else if ($avata == null) {
            $input = array('name' => $request->input('name'), 'image' => 'avatar.jpg');
            $category = $this->categoryRepository->create($input);
        };

        Flash::success('Category saved successfully.');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id) {
        if (Gate::check('user')) {
            Flash::error('You can not do that');
            abort(503);
        }
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request) {
        if (Gate::check('user')) {
            Flash::error('You can not do that');
            abort(503);
        }
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }
        $avatar = Input::file('image');
        if ($avatar == null) {
            $input = array('name' => $request->input('name'), 'image' => $category->image);
            $category = $this->categoryRepository->update($input, $id);
        } else {
            $destinationPath = public_path() . "/img/upload"; // give path of directory where you want to save your files
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $filename = $timestamp . '.' . $avatar->getClientOriginalExtension();
            $upload_success = $avatar->move($destinationPath, $filename);
            if ($upload_success) {
                $input = array('name' => $request->input('name'), 'image' => $filename);
                $category = $this->categoryRepository->update($input, $id);
            }
        }
        Flash::success('Category updated successfully.');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        if (Gate::check('user')) {
            Flash::error('You can not do that');
            abort(503);
        }
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }
        Storage::delete("$category->image");
        // unlink(URL::to("/img/upload/$category->image"));
        $this->deleteImage($category->image, 'upload');
        $this->categoryRepository->delete($id);


        // Delete food is belong to category
        $foods = \App\Models\Food::where('category_id', $category->id);
        foreach ($foods as $food) {
            $this->deleteImage($food->image, 'food');
//            if ($food->image != 'avatar.jpg') {
//                @unlink(public_path() . '\img\food' . "\\" . $food->image); // delete image if it change
//            }
        }
        $foods->delete();

        Flash::success('Category deleted successfully.');
        return redirect(route('categories.index'));
    }

    public function deleteImage($image,$file) {
        if ($image != 'avatar.jpg') {
            @unlink(public_path() . '\img'. "\\" .$file . "\\" . $image); // delete image if it change
        }
    }

}
