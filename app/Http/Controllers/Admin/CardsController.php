<?php

namespace App\Http\Controllers\Admin;

use App\Card;
use App\Rules\Positive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::orderBy('name')->get();

        return view('admin.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cards.create', ['card' => new Card]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:cards',
            'health' => ['required', 'integer', new Positive],
            'damage' => ['required', 'integer', new Positive],
            'rarity_id' => 'required',
            'power_id' => 'required',
            'image' => 'nullable'
        ]);

        $card = Card::create($data + ['user_id' => auth()->id()]);

        session()->flash('The card has been added successfully!');

        if (request()->wantsJson()) {
            return response($card, 201);
        }

        return redirect(route('admin.cards.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return view('admin.cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        return view('admin.cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Card $card)
    {
        $card->update(
            request()->validate([
                'name' => 'required|unique:cards',
                'health' => ['required', 'integer', new Positive],
                'damage' => ['required', 'integer', new Positive],
                'rarity_id' => 'required',
                'power_id' => 'required',
                'image' => 'nullable'
            ])
        );

        session()->flash('The card was successfully updated!');

        if (request()->wantsJson()) {
            return response($card, 200);
        }

        return redirect(route('admin.cards.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();

        session()->flash('The card was deleted successfully!');

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect(route('admin.cards.index'));
    }
}
