<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = User::query();
        $this->table = (new User())->getTable();
        View::share('title', ucfirst($this->table));
    }

    public function index(Request $request)
    {
        /*$query = $this->model;
        if ($request->has('role')) {
            $query = $query->where('role', $request->role);
        }
        $query->with('company:id,name')->latest()->paginate();*/
        // khong can parameter $request neu dung cach nay
        /*  $users = $this->model
            ->when($request->has('role'), function ($q) {
                return $q->where('role', request('role'));
            })
            ->with('company:id,name')
            ->latest()
            ->paginate();*/

        $users = $this->model->clone()
            ->when($request->has('role'), function ($q) use ($request) {
                return $q->where('role', $request->role);
            })
            ->with('company:id,name')
            ->latest()
            ->paginate();

        $cities = $this->model->clone()
            ->select('city')
            ->distinct()
            ->get();


        $roles = UserRoleEnum::asArray();
        return view("admin.$this->table.index", [
            'users' => $users,
            'roles' => $roles,
            'cities' => $cities,
        ]);
    }

    public function show()
    {

    }


}
