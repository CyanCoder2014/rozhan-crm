<?php

namespace Modules\EventModule\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\EventModule\Entities\EventCategory;

class AdminEventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = EventCategory::paginate(20);
        return view('eventmodule::admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('eventmodule::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required'
        ]);
        EventCategory::create(
            $request->only(['name','description'])
        );
        return back()->with('message','دسته بندی با موفقیت افزوده شد');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('eventmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('eventmodule::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required'
        ]);
        EventCategory::where('id',$id)->update(
            $request->only(['name','description'])
        );
        return back()->with('message','دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        EventCategory::where('id',$id)->delete();
        return back()->with('message','دسته بندی با موفقیت حذف شد');
    }
}
