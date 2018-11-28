<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PowersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_powers()
    {
        $this->signIn();

        $power = create('App\Power');

        $this->get(route('admin.powers.index'))
            ->assertSee($power->name)
            ->assertSee($power->description);
    }

    /** @test */
    public function a_user_can_view_the_page_to_create_a_new_power()
    {
        $this->signIn();

        $this->get(route('admin.powers.create'))
            ->assertSee('Name')
            ->assertSee('Description')
            ->assertSee('Add Power');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_new_power()
    {
        $this->signIn();

        $power = make('App\Power');

        $this->post(route('admin.powers.store'), $power->toArray());

        $this->assertDatabaseHas('powers', ['name' => $power->name]);

        $this->get(route('admin.powers.index'))
            ->assertSee($power->name);
    }

    /** @test */
    public function a_user_may_edit_a_power_that_they_created()
    {
        $this->signIn();

        $power = create('App\Power', ['user_id' => auth()->id()]);

        $this->get(route('admin.powers.edit', $power->id))
            ->assertSee($power->name)
            ->assertSee('Update Power');
    }

    /** @test */
    public function a_user_cannot_update_a_power_that_they_did_not_create()
    {
        $this->signIn();

        $power = create('App\Power', ['name' => 'This is my power']);

        $power->name = 'This is now my power';

        $this->json('get', route('admin.powers.edit', $power->id))
            ->assertStatus(403);

        $this->json('patch', route('admin.powers.update', $power->id), $power->toArray())
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_can_update_a_power_that_they_created()
    {
        $this->signIn();

        $power = create('App\Power', ['user_id' => auth()->id(), 'name' => 'This is my power']);

        $this->json('get', route('admin.powers.edit', $power->id))
            ->assertSee($power->name);

        $power->name = 'This is now my power';

        $this->json('patch', route('admin.powers.update', $power->id), $power->toArray());

        $this->get(route('admin.powers.show', $power->id))
            ->assertSee('This is now my power');
    }

    /** @test */
    public function a_user_cannot_delete_a_power_that_they_did_not_create()
    {
        $this->signIn();

        $power = create('App\Power');

        $this->json('delete', route('admin.powers.delete', $power->id))
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_can_delete_a_power_that_they_created()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $power = create('App\Power', ['user_id' => auth()->id()]);

        $this->json('delete', route('admin.powers.delete', $power->id))
            ->assertStatus(204);

        $this->assertDatabaseMissing('powers', ['id' => $power->id]);
    }
}
