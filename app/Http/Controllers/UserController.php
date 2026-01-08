<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $search = $request->get('search');
        $filter = $request->get('filter', 'all');
        $perPage = $request->get('per_page', 10);

        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
        })->when($filter !== 'all', function ($query) use ($filter) {
            return $query->when($filter === 'verified', fn($q) => $q->whereNotNull('email_verified_at'))
                        ->when($filter === 'unverified', fn($q) => $q->whereNull('email_verified_at'));
        })->paginate($perPage)->withQueryString();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
