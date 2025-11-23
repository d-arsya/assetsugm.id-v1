<?php

namespace App\Http\Controllers;

use App\Imports\VoterImport;
use App\Models\Kabinet;
use App\Models\Voted;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PemiraController extends Controller
{
    public function pemira()
    {
        $admin = Auth::guard('admin')->user();
        $voteds = Voted::with(['voters'])->get();
        $voters = Voter::all();
        return view('admin.pemira', compact('admin', 'voteds', 'voters'));
    }
    public function create()
    {
        return view('admin.addVoted');
    }
    public function edit(Voted $voted)
    {
        return view('admin.editVoted', compact('voted'));
    }
    public function result()
    {
        $totalVoters = Voter::all()->count();
        $totalVoted = Voter::whereNotNull('voted_id')->count();
        $candidates = Voted::withCount('voters')
            ->orderBy('voters_count', 'desc') // atau 'desc'
            ->get();

        $dataKabinet = Kabinet::all();
        return view('voted', compact('totalVoters', 'totalVoted', 'candidates', 'dataKabinet'));
    }
    public function voter(Voter $voter)
    {
        if ($voter->voted_id) return redirect()->route('vote.result');
        $candidates = Voted::all();
        $dataKabinet = Kabinet::all();
        return view('vote', compact('voter', 'candidates', 'dataKabinet'));
    }

    public function vote(Request $request, Voter $voter)
    {
        if ($voter->voted_id == null) {
            $voter->update(['voted_id' => $request->voted_id]);
        }
        return redirect()->route('vote.result');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'cv' => 'required|file',
            'avatar' => 'required|file',
        ]);
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('cv', $filename, 'public'); // disimpan di storage/app/public/cv
            $validated['cv'] = $path; // simpan path ke database
        }
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatar', 'public');
            $link = Storage::url($path);
            $url = asset($link);
            $validated['avatar'] = $url;
        }
        Voted::create($validated);
        return redirect()->route('admin.pemira');
    }
    public function update(Request $request, Voted $voted)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'avatar' => 'nullable|file',
        ]);
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatar', 'public');
            $link = Storage::url($path);
            $url = asset($link);
            $validated['avatar'] = $url;
        } else {
            unset($validated['avatar']);
        }
        $voted->update($validated);
        return redirect()->route('admin.pemira');
    }
    public function import(Request $request)
    {
        Voter::truncate();
        Excel::import(new VoterImport, $request->file('file'));
        return back();
    }
    public function destroy(Voted $voted)
    {
        if ($voted->voters->count() == 0) {
            $voted->delete();
        }
        return back();
    }
}
