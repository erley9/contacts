<?php

namespace Tests\Unit;

namespace App\Services;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use App\Mail\newContactAdd;
use App\Events\ContactRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Events\CallQueuedListener;
use App\Listeners\addEmailQueueWhenCreatedContact;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ContactTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testListClients()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('GET', '/api/contact');

        $response->assertOk();
        $response->assertJson(['status' => true]);
    }

    public function testFoundClient()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('GET', '/api/contact/1');

        $response->assertOk();
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Successfully"]);
    }

    public function testCreateContact()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('POST', '/api/contact', [
            "name" => "teste2",
            "email" => "test2e@teste.comn.br",
            "telephone" => "(12) 11111-1111",
            "postcode" => "09695-100",
            "address" => "rua teste",
            "number" => "20",
            "neighbourhood" => "fatima",
            "city" => "orlando",
            "state" => "são paulo",
            "country" => "teste"
        ]);

        $response->assertOk();
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Contact created Successfully"]);
        $response->assertJsonPath('data.name', 'teste2');
        $response->assertJsonPath('data.email', 'test2e@teste.comn.br');
    }

    public function testUpdateContact()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('PUT', '/api/contact/1', [
            "name" => "teste6",
            "email" => "teste6@teste.comn.br",
            "telephone" => "(12) 11111-1111",
            "postcode" => "09695-100",
            "address" => "rua teste 6",
            "number" => "20",
            "neighbourhood" => "fatima",
            "city" => "orlando",
            "state" => "são paulo",
            "country" => "teste"
        ]);

        $response->assertOk();
        $response->assertJson(['message' => "Contact updated Successfully"]);
        $response->assertJson(['status' => true]);
        $response->assertJsonPath('data.name', 'teste6');
        $response->assertJsonPath('data.email', 'teste6@teste.comn.br');
    }

    public function testDeleteContact()
    {
        $user = User::factory()->create();

        $delete = $this->actingAs($user)->json('DELETE', '/api/contact/1');

        $delete->assertOk();
        $delete->assertJson(['status' => true]);
        $delete->assertJson(['message' => "Contact deleted Successfully"]);
    }

    public function testDispatchEvent()
    {
        Event::fake();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('POST', '/api/contact', [
            "name" => "teste2",
            "email" => "test2e@teste.comn.br",
            "telephone" => "(12) 11111-1111",
            "postcode" => "09695-100",
            "address" => "rua teste",
            "number" => "20",
            "neighbourhood" => "fatima",
            "city" => "orlando",
            "state" => "são paulo",
            "country" => "teste"
        ]);

        $response->assertOk();

        Event::assertDispatched(ContactRegistered::class);
    }

    public function testEnterQueue()
    {
        Queue::fake();

        $contact = Contact::find(1);

        event(new ContactRegistered($contact));

        Queue::assertPushed(CallQueuedListener::class, function ($job) {
            return $job->class === addEmailQueueWhenCreatedContact::class;
        });
    }

    public function testSendEmail()
    {
        Mail::fake();

        $contact = Contact::find(1);

        $event = new ContactRegistered($contact);

        $listener = new addEmailQueueWhenCreatedContact();
        $listener->handle($event);

        Mail::assertSent(newContactAdd::class);
    }
}
