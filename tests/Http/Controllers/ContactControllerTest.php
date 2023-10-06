<?php

namespace Tests\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    public function testMailContactForm()
    {
        $this->post('/contact', ['name' => 'Torben', 'email' => 't@a.dk', 'message' => 'Hi! Need help!'])
            ->assertStatus(302)
            ->assertSessionHas('message', 'Thanks for your message! We will get back to you soon!');
    }

    public function testMailContactFormWithRepetition()
    {
        Cache::shouldReceive('get')
            ->once()
            ->with('last_contact_form_message')
            ->andReturn('Hi! Need help!!');
        $this->post('/contact', ['name' => 'Torben', 'email' => 't@a.dk', 'message' => 'Hi! Need help!!'])
            ->assertStatus(302)
            ->assertSessionHas('message', 'Your message was marked as spam. Find someone else to make the live miserable for');
    }

    public function testMailContactFormWithSpam()
    {
        $this->post('/contact', ['name' => 'Torben', 'email' => 't@a.dk', 'message' => 'SPAM!'])
            ->assertStatus(302)
            ->assertSessionHas('message', 'Your message was marked as spam. Find someone else to make the live miserable for');
    }
}
