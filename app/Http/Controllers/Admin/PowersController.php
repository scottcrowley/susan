<?php

namespace App\Http\Controllers\Admin;

use App\Power;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $powers = Power::orderBy('name')->get();

        return view('admin.powers.index', compact('powers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.powers.create', ['power' => new Power]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $power = Power::create($data + ['user_id' => auth()->id()]);

        session()->flash('flash', 'The power has been added successfully!');

        if (request()->wantsJson()) {
            return response($power, 201);
        }

        return redirect(route('admin.powers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Power  $power
     * @return \Illuminate\Http\Response
     */
    public function show(Power $power)
    {
        $cards = $power->cards;
        return view('admin.powers.show', compact('power', 'cards'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Power  $power
     * @return \Illuminate\Http\Response
     */
    public function edit(Power $power)
    {
        return view('admin.powers.edit', compact('power'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Power  $power
     * @return \Illuminate\Http\Response
     */
    public function update(Power $power)
    {
        $power->update(
            request()->validate([
                'name' => ['required', Rule::unique('powers')->ignore($power->id)],
                'description' => 'required'
            ])
        );

        session()->flash('flash', 'The power has been updated successfully!');

        if (request()->wantsJson()) {
            return response($power, 200);
        }

        return redirect(route('admin.powers.show', $power->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Power  $power
     * @return \Illuminate\Http\Response
     */
    public function destroy(Power $power)
    {
        $power->delete();

        session()->flash('flash', 'The power was deleted successfully!');

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect(route('admin.powers.index'));
    }

    /**
     * Make the power inactive
     *
     * @param Power $power
     * @return void
     */
    public function makeInactive(Power $power)
    {
        $power->makeInactive();

        if (request()->wantsJson()) {
            return response([], 204);
        }
    }

    /**
     * Make the power active
     *
     * @param Power $power
     * @return void
     */
    public function makeActive(Power $power)
    {
        $power->makeActive();

        if (request()->wantsJson()) {
            return response([], 204);
        }
    }
}
