<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get matakuliah
        $matakuliah = Matakuliah::latest()->paginate(5);

        //render view with matakuliah
        return view('matakuliah.index', compact('matakuliah'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('matakuliah.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'kode'     => 'required|min:5',
            'matkul'   => 'required|min:10'
        ]);

        //create matakuliah
        Matakuliah::create([
            'kode'     => $request->kode,
            'matkul'   => $request->matkul
        ]);

        //redirect to index
        return redirect()->route('matakuliah.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get matakuliah by ID
        $matakuliah = Matakuliah::findOrFail($id);

        //render view with matakuliah
        return view('matakuliah.show', compact('matakuliah'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get matakuliah by ID
        $matakuliah = Matakuliah::findOrFail($id);

        //render view with matakuliah
        return view('matakuliah.edit', compact('matakuliah'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'kode'     => 'required|min:5',
            'matkul'   => 'required|min:10'
        ]);

        //get matakuliah by ID
        $matakuliah = Matakuliah::findOrFail($id);

        //update matakuliah
        $matakuliah->update([
            'kode'     => $request->kode,
            'matkul'   => $request->matkul
        ]);

        //redirect to index
        return redirect()->route('matakuliah.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get matakuliah by ID
        $matakuliah = Matakuliah::findOrFail($id);

        //delete post
        $matakuliah->delete();

        //redirect to index
        return redirect()->route('matakuliah.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
