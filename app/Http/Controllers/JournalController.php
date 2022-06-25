<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $journals = Journal::where([
                ['name', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $journals = Journal::all();
        }

        return view('welcome', ['journals' => $journals, 'search' => $search]);
    }

    public function create()
    {
        return view('journals.create');
    }

    public function store(Request $request)
    {
        $journal = new Journal;

        $journal->name = $request->name;
        $journal->publisher = $request->publisher;
        $journal->signature = $request->signature;
        $journal->area = $request->area;
        $journal->description = $request->description;

        //Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage =  $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->image->move(public_path('img/journals'), $imageName);

            $journal->image = $imageName;
        }

        $user = auth()->user();
        $journal->user_id = $user->id;

        $journal->save();

        return redirect('/')->with('msg', 'Periódico criado com sucesso!');
    }

    public function show($id)
    {
        $journal = Journal::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if ($user) {
            $userJournals = $user->journalsAsParticipant->toArray();
            foreach ($userJournals as $userJournal) {
                if ($userJournal['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        $journalOwner = User::where('id', $journal->user_id)->first()->toArray();

        return view('journals.show', ['journal' => $journal, 'journalOwner' => $journalOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        $journals = $user->journals;

        $journalsAsParticipants = $user->journalsAsParticipant;

        return view('journals.dashboard', ['journals' => $journals, 'journalsAsParticipants' => $journalsAsParticipants]);
    }

    public function destroy($id)
    {
        Journal::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit($id)
    {
        $user = auth()->user();

        $journal = Journal::findOrFail($id);
        if ($user->id != $journal->user->id) {
            return redirect('/dashboard');
        }
        return view('journals.edit', ['journal' => $journal]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage =  $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->image->move(public_path('img/journals'), $imageName);

            $data['image'] = $imageName;
        }

        Journal::findOrFail($request->id)->update($data);


        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinEvent($id)
    {
        $user = auth()->user();
        $user->journalsAsParticipant()->attach($id);

        $journal = Journal::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $journal->title);
    }

    public function leaveEvent($id)
    {
        $user = auth()->user();
        $user->journalsAsParticipant()->detach($id);

        $journal = Journal::findOrFail($id);


        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento: ' . $journal->title);
    }
}
