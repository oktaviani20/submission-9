<?php

namespace App\Http\Controllers;

use App\Models\Programstudi;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class ProgramstudiController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get progamstudi
        $prodi = Programstudi::latest()->paginate(5);

        //render view with programstudi
        return view('programstudi.index', compact('prodi'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('programstudi.create');
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
            'kode'    => 'required|max:5',
            'prodi'   => 'required|min:8'
        ]);

        //create prodi
        Programstudi::create([
            'kode'    => $request->kode,
            'prodi'   => $request->prodi
        ]);

        //redirect to index
        return redirect()->route('programstudi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get prodi by ID
        $prodi = Programstudi::findOrFail($id);

        //render view with prodi
        return view('programstudi.show', compact('prodi'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get prodi by ID
        $prodi = Programstudi::findOrFail($id);

        //render view with programstudi
        return view('programstudi.edit', compact('prodi'));
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
            'kode'    => 'required|max:5',
            'prodi'   => 'required|min:8'
        ]);

        //get prodi by ID
        $prodi = Programstudi::findOrFail($id);

        //update prodi
        $prodi->update([
            'kode'    => $request->kode,
            'prodi'   => $request->prodi
        ]);

        //redirect to index
        return redirect()->route('programstudi.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get prodi by ID
        $prodi = Programstudi::findOrFail($id);

        //delete prodi
        $prodi->delete();

        //redirect to index
        return redirect()->route('programstudi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
