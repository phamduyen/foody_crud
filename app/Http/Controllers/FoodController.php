<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Repositories\FoodRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;


class FoodController extends InfyOmBaseController {

    /** @var  FoodRepository */
    private $foodRepository;
    private $categoryRepository;

    public function __construct(FoodRepository $foodRepo) {
        $this->foodRepository = $foodRepo;
        
    }
    /**
     * Display a listing of the Food.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {

        $this->foodRepository->pushCriteria(new RequestCriteria($request));
        $foods = $this->foodRepository->paginate(3);
        $selects = Category::all(['id', 'name']);
        $categories = array();
        foreach ($selects as $select) {
            $categories[$select->id] = $select->name;
        }
//        var_dump($foods);die();SS
        return view('foods.index')
                        ->with('foods', $foods)->with('categories', $categories);
    }
    
    /**
     * Show the form for creating a new Food.
     *
     * @return Response
     */
    public function create() {
        $selects = Category::all(['id', 'name']);
        $categories = array();
        foreach ($selects as $select) {
            $categories[$select->id] = $select->name;
        }
        return view('foods.create', compact('categories'));
    }

    /**
     * Store a newly created Food in storage.
     *
     * @param CreateFoodRequest $request
     *
     * @return Response
     */
    public function store(CreateFoodRequest $request) {
        $avatar = Input::file('image');
        $input = $request->all();
        if ($avatar == null) {
            $input['image'] = 'avatar.jpg';
            $food = $this->foodRepository->create($input);
        } else {
            $destinationPath = public_path() . "/img/food"; // give path of directory where you want to save your files
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $filename = $timestamp . '.' . $avatar->getClientOriginalExtension();
            $input['image'] = $filename;
            $upload_success = $avatar->move($destinationPath, $filename);
            if ($upload_success) {
                $food = $this->foodRepository->create($input);
            }
        }
        Flash::success('Food saved successfully.');
        return redirect(route('foods.index'));
    }

    /**
     * Display the specified Food.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('foods.index'));
        }

        return view('foods.show')->with('food', $food);
    }

    /**
     * Show the form for editing the specified Food.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id) {
        $food = $this->foodRepository->findWithoutFail($id);
        $selects = Category::all(['id', 'name']);
        $categories = array();
        foreach ($selects as $select) {
            $categories[$select->id] = $select->name;
        }
        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('foods.index'));
        }

        return view('foods.edit')->with('categories', $categories)->with('food', $food);
        //->with('food', $food);
    }

    /**
     * Update the specified Food in storage.
     *
     * @param  int              $id
     * @param UpdateFoodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFoodRequest $request) {
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('foods.index'));
        }

        // request
        $avatar = Input::file('image');
        $input = $request->all();
        if ($avatar == null) {
            $input['image'] = $food->image;
            $food = $this->foodRepository->update($input, $id);
        } else if ($avatar != null) {
            $destinationPath = public_path() . "/img/food"; // give path of directory where you want to save your files
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $filename = $timestamp . '.' . $avatar->getClientOriginalExtension();
            $input['image'] = $filename;
            $upload_success = $avatar->move($destinationPath, $filename);
            if ($upload_success) {     
                if ($food->image!= 'avatar.jpg') {
                    @unlink(public_path() . '\img\food' . "\\" .$food->image);// delete image if it change
                }
                $food = $this->foodRepository->update($input, $id);
            }
        }

        Flash::success('Food updated successfully.');
        return redirect(route('foods.index'));
    }

    /**
     * Remove the specified Food from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');
            return redirect(route('foods.index'));
        }
        $this->foodRepository->delete($id);
        @unlink(public_path() . '\img\food' . "\\" . $food->image);
        Flash::success('Food deleted successfully.');
        return redirect(route('foods.index'));
    }

}
