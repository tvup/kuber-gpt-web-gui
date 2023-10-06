<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    public function testMailContactForm()
    {
        $this->post('/contact', ['name' => 'Torben', 'email' => 't@a.dk', 'message' => 'Hi! Need help!'])
            ->assertStatus(302)
            ->assertSessionHas('message', 'Thanks for your message! We will get back to you soon!');
    }

    public function testMailContactFormWithSpam()
    {
        $this->post('/contact', ['name' => 'Torben', 'email' => 't@a.dk', 'message' => 'SPAM!'])
            ->assertStatus(302)
            ->assertSessionHas('message', 'Your message was marked as spam. Find someone else to make the live miserable for');
    }
}
