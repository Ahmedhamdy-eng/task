<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\Constants;
use App\Rules\CompanyKey;
use App\Models\User;
use App\Http\Requests\CreateUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use Alert;
class UsersController extends Controller
{
    protected $model;
    protected $blade;
    protected $route;
    protected $title;


    public function __construct()
    {
        $this->model = '\App\Models\User';
        $this->blade  = 'dashboard.user.';
        $this->route = 'dashboard.users.';
        $this->title = trans('site.user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->model::where(function($q) use ($request) {

            return $q->when($request->search , function($query) use($request){
            return $query->where('name','like','%'.$request->search.'%');
            });

        })->latest()->paginate(Constants::DASHBOARD_PAGINATION);

        return view($this->blade.__FUNCTION__,compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view($this->blade.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUsersRequest $request)
    {      
        $request_data = $request->all();
        $request_data['verify'] = 1 ;

        $this->model::create($request_data);
        Alert::success('success', 'Added Successfully');  
        return redirect()->route($this->route.'index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {       
        return view($this->blade.__FUNCTION__,compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {        
        $user->update($request->all());

        Alert::success('success', trans('site.updated_successfully'));  
        return redirect()->route($this->route.'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
    
        if (!$user){
            Alert::success('success', trans('This User Not Found'));   
            return redirect()->route($this->route.'index');
        }


        $user->delete();
        Alert::success('success', trans('site.deleted_successfully'));
        return redirect()->route($this->route.'index');
    }


}
