<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dekorin;

class DekorinController extends Controller
{
    public function index()
    {
        $query = Dekorin::with('category');

        // Tambahkan filter pencarian jika parameter search ada
        if (request()->has('search') && request()->search != '') {
            $search = request()->search;
            $query->where(function ($q) use ($search) {
                $q->where('tema', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($qc) use ($search) {
                      $qc->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $data = $query->latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'tema' => $item->tema ?? '',
                'description' => $item->description ?? '',
                'image' => $item->image ?? '',
                'file' => $item->file ?? '',
                'price' => $item->price ?? 0,
                'rating' => $item->rating ?? 0,
                'category' => [
                    'id' => $item->category->id ?? null,
                    'name' => $item->category->name ?? '',
                ],
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'List data dekorin',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $item = Dekorin::with('category')->find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Dekorin tidak ditemukan',
                'data' => null
            ], 404);
        }

        $data = [
            'id' => $item->id,
            'tema' => $item->tema ?? '',
            'description' => $item->description ?? '',
            'image' => $item->image ?? '',
            'file' => $item->file ?? '',
            'price' => $item->price ?? 0,
            'rating' => $item->rating ?? 0,
            'category' => [
                'id' => $item->category->id ?? null,
                'name' => $item->category->name ?? '',
            ],
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Detail dekorin',
            'data' => $data
        ], 200);
    }
}
