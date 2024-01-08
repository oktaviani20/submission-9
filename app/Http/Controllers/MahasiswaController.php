<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get mahasiswa
        $mahasiswa = Mahasiswa::latest()->paginate(5);

        //render view with mahasiswa
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('mahasiswa.create');
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
            'nim'   => 'required|min:8',
            'nama'  => 'required|min:4',
            'email' => 'required'
        ]);

        //create mahasiswa
        Mahasiswa::create([
            'nim'   => $request->nim,
            'nama'  => $request->nama,
            'email' => $request->email
        ]);

        //redirect to index
        return redirect()->route('mahasiswa.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        //render view with mahasiswa
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        //render view with mahasiswa
        return view('mahasiswa.edit', compact('mahasiswa'));
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
            'nim'   => 'required|min:8',
            'nama'  => 'required|min:4',
            'email' => 'required'
        ]);

        //get mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        //update mahasiswa
        $mahasiswa->update([
            'nim'   => $request->nim,
            'nama'  => $request->nama,
            'email' => $request->email
        ]);

        //redirect to index
        return redirect()->route('mahasiswa.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        //delete post
        $mahasiswa->delete();

        //redirect to index
        return redirect()->route('mahasiswa.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
