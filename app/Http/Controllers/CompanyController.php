<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.company.index')->with([
            'companies' => Company::paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
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
            'email' => 'required|unique:companies|email',
            'website' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,jpg,png,svg,bmp,webp|max:100|dimensions:max_width=100,max_height=100',
        ]);

        DB::beginTransaction();
        try {
            $logo = Upload::store($request->file('logo'), 'storage/app/company');
            $company = Company::create([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $logo->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            return redirect()->route('company.index');
        } catch (Exception $e) {
            DB::rollBack();
            try {
                $logo->delete();
            } catch (Exception $e) {
                Log::critical($e);
            }
            return back()->withErrors('Terjadi kesalahan saat menyimpan data silahkan coba lagi');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('admin.company.show')->with([
            'company' => $company,
            'employees' => Employee::where('company', $company->id)->paginate(5),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit')->with([
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'website' => 'required|string',
        ]);
        DB::beginTransaction();
        $logo = $company->logoImage;

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,jpg,png,svg,bmp,webp|max:100|dimensions:max_width=100,max_height=100',
            ]);
            $logo = Upload::store($request->file('logo'), 'storage/app/company');
        }
        if ($request->email !== $company->email) {
            $request->validate([
                'email' => '|unique:companies|email'
            ]);
        }

        try {
            $company = $company->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $logo->id,
                'updated_at' => now(),
            ]);

            DB::commit();
            return redirect()->route('company.index');
        } catch (Exception $e) {
            DB::rollBack();
            try {
                $logo->delete();
            } catch (Exception $e) {
                Log::critical($e);
            }

            return back()->withErrors('Terjadi kesalahan saat mengupdate data silahkan coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try{
            $company->delete();
        } catch (\Exception $e) {
            return back()->withErrors('Terjadi kesalahan saat menghapus data silahkan coba lagi');
        }

        return redirect()->route('company.index')->with('success', 'success hapus data');
    }
}
