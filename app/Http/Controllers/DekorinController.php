<?php

namespace App\Http\Controllers;

use App\Models\Dekorin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DekorinController extends Controller
{
    // Tampilkan semua data dekorin
    public function index()
    {
        $dekorins = Dekorin::with('category')->latest()->get();
        return view('dekorins.index', compact('dekorins'));
    }

    // Form tambah dekorin
    public function create()
    {
        $categories = Category::all();
        return view('dekorins.create', compact('categories'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tema' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
            'file' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('dekorin_images', 'public');
        }

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('dekorin_files', 'public');
        }

        Dekorin::create($validated);

        return redirect()->route('dekorins.index')->with('success', 'Dekor berhasil ditambahkan.');
    }

    // Form edit dekorin
    public function edit(Dekorin $dekorin)
    {
        $categories = Category::all();
        return view('dekorins.edit', compact('dekorin', 'categories'));
    }

    // Update dekorin
    public function update(Request $request, Dekorin $dekorin)
    {
        $validated = $request->validate([
            'tema' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
            'file' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($dekorin->image) {
                Storage::disk('public')->delete($dekorin->image);
            }
            $validated['image'] = $request->file('image')->store('dekorin_images', 'public');
        }

        if ($request->hasFile('file')) {
            if ($dekorin->file) {
                Storage::disk('public')->delete($dekorin->file);
            }
            $validated['file'] = $request->file('file')->store('dekorin_files', 'public');
        }

        $dekorin->update($validated);

        return redirect()->route('dekorins.index')->with('success', 'Dekor berhasil diperbarui.');
    }

    // Hapus dekorin
    public function destroy(Dekorin $dekorin)
    {
        if ($dekorin->image) {
            Storage::disk('public')->delete($dekorin->image);
        }
        if ($dekorin->file) {
            Storage::disk('public')->delete($dekorin->file);
        }

        $dekorin->delete();

        return redirect()->route('dekorins.index')->with('success', 'Dekor berhasil dihapus.');
    }
}
