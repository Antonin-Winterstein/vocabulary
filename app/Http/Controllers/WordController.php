<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index() 
    {
        $words = Word::orderBy("created_at", "desc")->paginate(10);
        return view("words", compact("words"));
    }

    public function create() 
    {
        $words = Word::all();
        return view("createWord", compact("words"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "english"=> "required",
            "french"=> "required",
            "korean"=> "required",
            "category"=> "required",
        ]);

        // Word::create($request->all());

        Word::create([
            "english" => $request->english,
            "french" => $request->french,
            "korean" => $request->korean,
            "category" => $request->category,
        ]);

        return back()->with("success", "Word added successfully.");
    }

    public function update(Request $request)
    {
        $request->validate([
            "english"=> "required",
            "french"=> "required",
            "korean"=> "required",
            "category"=> "required",
        ]);

        $word = Word::where('id', $request->id);

        $word->update([
            "english" => $request->english,
            "french" => $request->french,
            "korean" => $request->korean,
            "category" => $request->category,
        ]);

        return back()->with("successUpdate", "Word updated successfully.");
    }

    public function delete(Word $word) 
    {
        $word_info = $word->english;
        $word->delete();

        return back()->with("successDelete", "Word \"$word_info\" deleted successfully.");
    }

    public function getByFiltersSelected(Request $request) 
    {
        if ($request->get('wordsFilter')) {
            switch ($request->get('wordsFilter')) {
                case "latestWords":
                    $words = Word::orderBy("created_at", "desc");
                    break;
                case "oldestWords":
                    $words = Word::orderBy("created_at", "asc");
                    break;
                case "randomWords":
                    $words = Word::inRandomOrder();
                    break;
            }
        }
        else {
            $words = Word::query();
        }

        if ($request->has('getNounsCheckbox')) {
            $words = $words->orWhere('category', 'noun');
        }

        if ($request->has('getVerbsCheckbox')) {
            $words = $words->orWhere('category', 'verb');
        }

        if ($request->has('getAdjectivesCheckbox')) {
            $words = $words->orWhere('category', 'adjective');
        }

        if ($request->has('getAdverbsCheckbox')) {
            $words = $words->orWhere('category', 'adverb');
        }

        if ($request->has('getOthersCheckbox')) {
            $words = $words->orWhere('category', 'other');
        }

        $words = $words->paginate(10);

        return view("words", compact("words"));
    }

    public static function getLastNWords($wordsNumber) 
    {
        $words = Word::latest()->take($wordsNumber)->get();
        return $words;
    }

    public static function getRandomWord() 
    {
        $word = Word::inRandomOrder()->first();
        return $word;
    }

    public function searchWords(Request $request)
    {
        $search = $request->input('search');
    
        $words = Word::query()
            ->where('english', 'LIKE', "%{$search}%")
            ->orWhere('french', 'LIKE', "%{$search}%")
            ->orWhere('korean', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view("words", compact("words"));
    }
}
