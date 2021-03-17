<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;
   /**
    * @test
    */
    public function can_register(){
        
        Livewire::test('auth.register')
            ->set('name', 'chichoo')
            ->set('email', 'lldipzee@erty.fr')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')

            ->assertRedirect('/login');
    }

    /**
    * @test
    */
    public function email_is_unique(){
        
        Livewire::test('auth.register')
            ->set('name', 'chichoo')
            ->set('email', 'lldipzee@erty.fr')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')

            ->assertHasErrors(['email' => 'unique']);
    }

    /**
    * @test
    */
    public function email_is_required(){
        
        Livewire::test('auth.register')
            ->set('name', 'chichoo')
            ->set('email', '')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')

            ->assertHasErrors(['email' => 'required']);
    }

    /**
    * @test
    */
    public function email_is_valid_email(){
        
        Livewire::test('auth.register')
            ->set('name', 'chichoo')
            ->set('email', 'chichon')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')

            ->assertHasErrors(['email' => 'email']);
    }

    /**
    * @test
    */
    public function password_is_required(){
        
        Livewire::test('auth.register')
            ->set('name', 'chichoo')
            ->set('email', 'chichon')
            ->set('password', '')
            ->set('passwordConfirmation', 'secret')
            ->call('register')

            ->assertHasErrors(['password' => 'required']);
    }

     /**
    * @test
    */
    public function password_is_min_6_carac(){
        
        Livewire::test('auth.register')
            ->set('name', 'chichoo')
            ->set('email', 'chichon')
            ->set('password', 'sec')
            ->set('passwordConfirmation', 'secret')
            ->call('register')

            ->assertHasErrors(['password' => 'min']);
    }

     /**
    * @test
    */
    public function password_must_matche_passwordConfirmation(){
        
        Livewire::test('auth.register')
            ->set('name', 'chichoo')
            ->set('email', 'chichon')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'sechet')
            ->call('register')

            ->assertHasErrors(['password' => 'same']);
    }


}
