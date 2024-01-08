<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get dosen
        $dosen = Dosen::latest()->paginate(5);

        //render view with dosen
        return view('dosen.index', compact('dosen'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('dosen.create');
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
            'nip'     => 'required|min:8',
            'dosen'   => 'required|min:5'
        ]);

        //create dosen
        Dosen::create([
            'nip'     => $request->nip,
            'dosen'   => $request->dosen
        ]);

        //redirect to index
        return redirect()->route('dosen.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get dosen by ID
        $dosen = Dosen::findOrFail($id);

        //render view with dosen
        return view('dosen.show', compact('dosen'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get dosen by ID
        $dosen = Dosen::findOrFail($id);

        //render view with dosen
        return view('dosen.edit', compact('dosen'));
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
            'nip'     => 'required|min:8',
            'dosen'   => 'required|min:5'
        ]);

        //get dosen by ID
        $dosen = Dosen::findOrFail($id);

        //update dosen
        $dosen->update([
            'nip'     => $request->nip,
            'dosen'   => $request->dosen
        ]);

        //redirect to index
        return redirect()->route('dosen.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get dosen by ID
        $dosen = Dosen::findOrFail($id);

        //delete post
        $dosen->delete();

        //redirect to index
        return redirect()->route('dosen.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
