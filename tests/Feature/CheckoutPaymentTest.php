<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\TicketType;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CheckoutPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_complete_checkout_and_payment_flow_via_simulation()
    {
        // 1. Create a Promoter user
        $promoter = User::create([
            'name' => 'Test Promoter',
            'email' => 'promoter@example.com',
            'password' => bcrypt('password'),
            'role' => 'promoter',
            'status' => 'active',
            'promoter_status' => 'approved',
        ]);

        // 2. Create a Buyer user
        $buyer = User::create([
            'name' => 'Test Buyer',
            'email' => 'buyer@example.com',
            'password' => bcrypt('password'),
            'role' => 'buyer',
            'status' => 'active',
            'promoter_status' => 'none',
        ]);

        // 3. Create an Event
        $event = Event::create([
            'promoter_id' => $promoter->id,
            'title' => 'Concert of the Year',
            'description' => 'A wonderful concert',
            'category' => 'music_festival',
            'venue_name' => 'Stadium Jakarta',
            'address' => 'Sudirman St.',
            'city' => 'Jakarta',
            'event_date' => now()->addDays(10)->toDateString(),
            'start_time' => '19:00',
            'end_time' => '22:00',
            'max_ticket_per_order' => 4,
            'poster_path' => 'events/concert.jpg',
            'terms_and_conditions' => 'Standard T&C',
            'status' => 'approved',
        ]);

        // 4. Create a Ticket Type
        $ticketType = TicketType::create([
            'event_id' => $event->id,
            'name' => 'VIP',
            'price' => 50000.00,
            'quota' => 100,
            'sold' => 0,
            'status' => 'active',
            'start_sale' => now()->subDays(1),
            'end_sale' => now()->addDays(5),
        ]);

        // 5. Create Payment Methods
        PaymentMethod::create([
            'name' => 'QRIS',
            'is_active' => true,
        ]);

        // 6. Act as the Buyer
        $this->actingAs($buyer);

        // STEP 1: Select Ticket
        $response = $this->get(route('buyer.ticket.select', $event->id));
        $response->assertStatus(200);

        // Save selection to session
        $response = $this->post(route('buyer.ticket.select.store', $event->id), [
            'ticket_type_id' => $ticketType->id,
            'quantity' => 2,
        ]);
        $response->assertRedirect(route('buyer.checkout.form', $event->id));

        // STEP 2: Checkout Form
        $response = $this->get(route('buyer.checkout.form', $event->id));
        $response->assertStatus(200);

        // Submit checkout details
        $response = $this->post(route('buyer.checkout.store', $event->id), [
            'full_name' => 'Test Buyer Updated',
            'email' => 'buyer@example.com',
            'phone_number' => '081234567890',
            'nik' => '1234567890123456',
            'agreement' => 'on',
        ]);
        $response->assertRedirect(route('buyer.order.review', $event->id));

        // STEP 3: Order Review (Summary)
        $response = $this->get(route('buyer.order.review', $event->id));
        $response->assertStatus(200);

        // STEP 4: Store Order (Creates Invoice)
        $response = $this->post(route('buyer.order.store', $event->id), [
            'ticket_type_id' => $ticketType->id,
            'quantity' => 2,
        ]);
        
        // Find the created order
        $order = Order::where('user_id', $buyer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals('pending', $order->status);

        $response->assertRedirect(route('buyer.order.payment', $order->id));

        // STEP 5: Payment Page
        $response = $this->get(route('buyer.order.payment', $order->id));
        $response->assertStatus(200);

        // STEP 6: Simulate Payment Success (Bypass)
        $response = $this->get(route('buyer.order.payment.simulate', $order->id));
        $response->assertRedirect(route('buyer.order.ticket', $order->id));

        // Assert order status has updated to paid
        $order->refresh();
        $this->assertEquals('paid', $order->status);

        // STEP 7: View/Print Ticket
        $response = $this->get(route('buyer.order.ticket', $order->id));
        $response->assertStatus(200);
        $response->assertSee('LUNAS / PAID');

        // STEP 8: View Dedicated Offline Ticket
        $response = $this->get(route('buyer.order.ticket.offline', $order->id));
        $response->assertStatus(200);
        $response->assertSee('Kode Booking');
    }
}
