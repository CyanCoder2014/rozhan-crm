<?php

namespace Modules\TicketingModule\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TicketingModule\Entities\TicketCategory;

class AdminTicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = TicketCategory::paginate(20);
        return view('ticketingmodule::admin.ticketCategory.index',compact('categories'));
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
        TicketCategory::create(
            $request->only(['name','description'])
        );
        return back()->with('message','دسته بندی با موفقیت افزوده شد');
    }



    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request,int $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required'
        ]);
        TicketCategory::where('id',$id)->update(
            $request->only(['name','description'])
        );
        return back()->with('message','دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        TicketCategory::where('id',$id)->delete();
        return back()->with('message','دسته بندی با موفقیت حذف شد');
    }
}
