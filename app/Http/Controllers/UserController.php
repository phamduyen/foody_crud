<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Role;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class UserController extends InfyOmBaseController {

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo) {
        $this->userRepository = $userRepo;
        
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $users = $this->userRepository->paginate(1);
        // select list roles
        $selects = Role::all(['id', 'title']);
        $roles = array();
        foreach ($selects as $select) {
            $roles[$select->id] = $select->title;
        }
        return view('users.index')
                        ->with('users', $users)
                        ->with('roles',$roles);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create() {
        $selects = Role::all(['id', 'title']);
        $roles = array();
        foreach ($selects as $select) {
            $roles[$select->id] = $select->title;
        }
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request) {
        $avatar = Input::file('image');
        $input = $request->all();
        if ($avatar == null) {
            $input['image'] = 'avatar.jpg';
            $user = $this->userRepository->create($input);
        } else {
            $destinationPath = public_path() . "/img/avatar"; // give path of directory where you want to save your files
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $filename = $timestamp . '.' . $avatar->getClientOriginalExtension();
            $input['image'] = $filename;
            $upload_success = $avatar->move($destinationPath, $filename);
            if ($upload_success) {
                $user = $this->userRepository->create($input);
            }
        }
        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id) {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $selects = Role::all(['id', 'title']);
        $roles = array();
        foreach ($selects as $select) {
            $roles[$select->id] = $select->title;
        }
        return view('users.edit')->with('user', $user)->with('roles', $roles);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id) {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $avatar = Input::file('image');
        $input = $request->all();
        if ($avatar == null) {
            $input['image'] = $user->image;
            $food = $this->userRepository->update($input, $id);
        } else {
            $destinationPath = public_path() . "/img/avatar"; // give path of directory where you want to save your files
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $filename = $timestamp . '.' . $avatar->getClientOriginalExtension();
            $input['image'] = $filename;
            $upload_success = $avatar->move($destinationPath, $filename);
            if ($upload_success) {
                $food = $this->userRepository->update($input, $id);
            }
        }

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

}
