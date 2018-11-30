<?php

namespace App\Http\Controllers\Admin;

use App\Card;
use App\Power;
use App\Rarity;
use App\Rules\Positive;
use App\Filters\CardFilters;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  CardFilters  $filters
     * @return \Illuminate\Http\Response
     */
    public function index(CardFilters $filters)
    {
        $cards = $this->getCards($filters);

        return view('admin.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $powers = Power::orderBy('name')->get();
        $rarities = Rarity::orderBy('level')->get();
        $card = new Card;
        return view('admin.cards.create', compact('card', 'powers', 'rarities'));
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

        session()->flash('flash', 'The card has been added successfully!');

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
        $powers = Power::orderBy('name')->get();
        $rarities = Rarity::orderBy('level')->get();

        return view('admin.cards.edit', compact('card', 'powers', 'rarities'));
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
                'name' => ['required', Rule::unique('cards')->ignore($card->id)],
                'health' => ['required', 'integer', new Positive],
                'damage' => ['required', 'integer', new Positive],
                'rarity_id' => 'required',
                'power_id' => 'required',
                'image' => 'nullable'
            ])
        );

        session()->flash('flash', 'The card was successfully updated!');

        if (request()->wantsJson()) {
            return response($card, 200);
        }

        return redirect(route('admin.cards.show', $card->id));
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

        session()->flash('flash', 'The card was deleted successfully!');

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect(route('admin.cards.index'));
    }

    /**
     * Fetch all relevant cards.
     *
     * @param CardFilters $filters
     * @return mixed
     */
    protected function getCards(CardFilters $filters)
    {
        $cards = Card::orderBy('name')->filter($filters)->get();

        return $cards;
    }

    /**
     * Make the card inactive
     *
     * @param Card $card
     * @return void
     */
    public function makeInactive(card $card)
    {
        $card->makeInactive();

        if (request()->wantsJson()) {
            return response([], 204);
        }
    }

    /**
     * Make the card active
     *
     * @param Card $card
     * @return void
     */
    public function makeActive(card $card)
    {
        $card->makeActive();

        if (request()->wantsJson()) {
            return response([], 204);
        }
    }
}
