<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FamilyMember;

class FamilyMembersController extends Controller
{
    public function index()
    {
        //
    }
    public function createMember($customerId)
    {
        return view('admin.customer.createCustomerMember', compact('customerId'));
    }

    public function saveMember(Request $request, $customerId)
    {
        $member = FamilyMember::create($request->all());
        return redirect()->route('admin.customers.show', $customerId)->with('success', 'Thêm thành viên gia đình thành công!');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
