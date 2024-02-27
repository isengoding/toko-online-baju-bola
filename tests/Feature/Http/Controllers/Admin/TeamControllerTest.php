<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Create a user instance for the tests
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($user);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function can_render_team_index_page()
    {
        Team::factory()->count(5)->create();

        $response = $this->get('/admin/teams');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.team.index')
            ->assertViewHas('teams');
    }

    /**
     * @test
     */
    public function can_display_create_view_for_team()
    {
        $response = $this->get('admin/teams/create');

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.team.create');
    }

    /**
     * @test
     */
    public function can_stores_the_team()
    {

        $newTeam = Team::factory()
            ->make(['image' => UploadedFile::fake()->image('test.jpg')])
            ->toArray();

        $response = $this->post(route('teams.store'), $newTeam);

        $this->assertDatabaseHas('teams', [
            'name' => $newTeam['name'],
            'image' => 'test.jpg',
        ]);

        $this->assertFileExists(public_path('assets/img/team/test.jpg'));

        $response
            ->assertRedirect(route('teams.index'))
            ->assertSessionHas('success');

    }

    /**
     * @test
     */
    public function can_display_edit_view_for_team()
    {
        $team = Team::factory()->create();

        $response = $this->get(route('teams.edit', $team));

        $response
            ->assertOk()
            ->assertViewIs('pages.admin.team.edit')
            ->assertViewHas('team');
    }

    /**
     * @test
     */
    public function can_updates_the_team()
    {

        $existingTeam = Team::factory()->create([
            'name' => 'existing-team',
            'image' => 'existing-image.jpg',
        ]);
        $existingImage = UploadedFile::fake()->image('existing-image.jpg');

        $existingImage->move(public_path('/assets/img/team'), $existingImage->getClientOriginalName());

        $updateTeam = Team::factory()->make([
            'name' => 'update-team',
            'image' => UploadedFile::fake()->image('updateImage.jpg')
        ])->toArray();

        $response = $this->put(route('teams.update', $existingTeam), $updateTeam);


        $this->assertDatabaseHas('teams', [
            'name' => $updateTeam['name'],
            'image' => 'updateImage.jpg',
        ]);

        $this->assertFileDoesNotExist(public_path('assets/img/team/existing-image.jpg'));
        $this->assertFileExists(public_path('assets/img/Team/updateImage.jpg'));

        $response
            ->assertRedirect(route('teams.index'))
            ->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function can_deletes_the_team()
    {
        $existingTeam = Team::factory()->create([
            'name' => 'existing-team',
            'image' => 'existing-image.jpg',
        ]);
        $existingImage = UploadedFile::fake()->image('existing-image.jpg');

        $existingImage->move(public_path('/assets/img/team'), $existingImage->getClientOriginalName());

        $response = $this->delete(route('teams.destroy', $existingTeam));

        $response
            ->assertRedirect(route('teams.index'))
            ->assertSessionHas('success');

        $this->assertModelMissing($existingTeam);
        $this->assertFileDoesNotExist(public_path('assets/img/team/existing-image.jpg'));

    }
}
