<?php

namespace Tests\Feature;

use App\Services\UserService;
use App\User;
use App\UserProfile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{

    /** Rodar o teste, criar registro no DB, verificar se existe e depois da um rollback. Ou seja,
     *  não da um commit (begin e rollback) no processo de criação no banco (não persistindo o dado)
     *  Sendo assim, o teste fica apenas na memória */
    use DatabaseTransactions;

    public function testCreateUser()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@teste.com',
            'password' => bcrypt(123456),
        ]);

        $this->assertDatabaseHas('users', ['name' => 'Admin User']);
    }

    public function testCreateUserProfile()
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@teste.com',
            'password' => bcrypt(123456),
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'address' => 'Rua 101',
            'state' => 'DF',
            'zipcode' => '72000-000',
        ]);

        $this->assertDatabaseHas('users', ['name' => 'Admin User']);
        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $user->id,
            'address' => 'Rua 101'
        ]);
    }

    public function testGetProfileByUser()
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@teste.com',
            'password' => bcrypt(123456),
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'address' => 'Rua 101',
            'state' => 'DF',
            'zipcode' => '72000-000',
        ]);

        $profile = UserProfile::first();
        $result = $user->profile;

        $this->assertEquals($profile, $result);
    }

    public function testCreateUserAndProfileWithService()
    {
        /** Simulando dados vindos do formulário */
        $data = [
            'name' => 'Admin User',
            'email' => 'admin@teste.com',
            'password' => 123456,
            'address' => 'Rua 101',
            'state' => 'DF',
            'zipcode' => '72000-000',
        ];

        $userService = new UserService();
        $user = $userService->create($data);


        $userExpected = User::first();
        $this->assertEquals($userExpected->id, $user->id);
    }
}
