<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PowerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_power_has_many_cards()
    {
        $power = create('App\Power');

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $power->cards
        );
    }

    /** @test */
    public function a_power_can_provide_its_active_status()
    {
        $this->signIn();

        $power = create('App\Power', ['active' => false]);

        $this->assertEquals($power->isActive(), false);
    }

    /** @test */
    public function a_power_can_be_made_inactive_by_its_creator()
    {
        $this->signIn();

        $power = create('App\Power', ['user_id' => auth()->id()]);

        $this->assertEquals($power->isActive(), true);

        $this->json('get', route('admin.powers.inactive', $power->id))
            ->assertStatus(204);

        $this->assertEquals($power->fresh()->isActive(), false);
    }

    /** @test */
    public function a_power_can_not_be_made_inactive_if_the_user_isnt_the_creator()
    {
        $this->signIn();

        $power = create('App\Power');

        $this->assertEquals($power->isActive(), true);

        $this->get(route('admin.powers.inactive', $power->id))
            ->assertStatus(403);
    }

    /** @test */
    public function a_power_can_be_made_active_by_its_creator()
    {
        $this->signIn();

        $power = create('App\Power', ['user_id' => auth()->id(), 'active' => false]);

        $this->json('get', route('admin.powers.active', $power->id))
            ->assertStatus(204);

        $this->assertEquals($power->fresh()->isActive(), true);
    }

    /** @test */
    public function a_power_can_not_be_made_active_if_the_user_isnt_the_creator()
    {
        $this->signIn();

        $power = create('App\Power', ['active' => false]);

        $this->get(route('admin.powers.active', $power->id))
            ->assertStatus(403);
    }
}
