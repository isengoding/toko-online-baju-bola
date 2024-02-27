<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter['search'] = request()->keyword;

        $teams = Team::query()
            ->filter($filter)
            ->latest()
            ->paginate(10);

        return view('pages.admin.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);


        if (!empty($request->image)) {
            $image = $request->file('image');
            $image->move(public_path('/assets/img/team'), $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = 'default.png';
        }


        Team::create([
            'name' => $request->name,
            'image' => $imageName,
        ]);



        $request->session()->flash('success', 'Team created successfully');

        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('pages.admin.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if (!empty($request->image)) {
            $image = $request->file('image');
            $image->move(public_path('/assets/img/team'), $image->getClientOriginalName());

            if ($team->image != 'default.png' && File::exists(public_path('/assets/img/team/' . $team->image))) {
                File::delete(public_path('/assets/img/team/' . $team->image));
            }

            $team->update([
                'image' => $image->getClientOriginalName(),
            ]);
        }

        $team->update([
            'name' => $request->name,
        ]);

        $request->session()->flash('success', 'Team updated successfully');

        return redirect()->route('teams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if ($team->image != 'default.png' && File::exists(public_path('/assets/img/team/' . $team->image))) {
            File::delete(public_path('/assets/img/team/' . $team->image));
        }
        $team->delete();
        return redirect(route('teams.index'))->withSuccess('Team deleted successfully');
    }
}
