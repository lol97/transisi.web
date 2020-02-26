<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee.index')->with([
            'employees' => Employee::paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create')->with([
            'companies' => Company::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:employees|email',
            'company' => 'required|exists:companies,id'
        ]);
        try {
            DB::beginTransaction();
            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'company' => $request->company
            ]);

            DB::commit();

            return redirect()->route('employee.index')->with('success', 'data berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('something wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('admin.employee.show')->with([
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin.employee.edit')->with([
            'employee' => $employee,
            'companies' => Company::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string',
            'company' => 'required|exists:companies,id'
            ]);

        if ($request->email !== $employee->email) {
            $request->validate([
                'email' => 'required|unique:employees|email',
            ]);
        }

        DB::beginTransaction();
        try {
            $employee = $employee->update([
                'name' => $request->name,
                'email' => $request->email,
                'company' => $request->company,
            ]);
            DB::commit();

            return redirect()->route('employee.index')->with('success', 'sukses mengupdate data');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('terdapat kesalahan ketika update');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'sukses menghapus data');
    }
}
