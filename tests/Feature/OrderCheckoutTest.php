<?php

use App\Models\Order;
use App\Models\Orderitems;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

function orderCheckoutUser(): User
{
    return User::create([
        'name' => 'Burger Customer',
        'email' => 'burger@example.test',
        'password' => 'password',
        'image' => 'avatars/burger-customer.jpg',
    ]);
}

function orderCheckoutProduct(): Product
{
    return Product::create([
        'name' => ['en' => 'Happy Classic', 'ar' => 'هابي كلاسيك'],
        'description' => ['en' => 'Beef, cheese, lettuce', 'ar' => 'لحم وجبن وخس'],
        'price' => 8.99,
        'category_name' => 'Sample Burgers',
        'image' => 'images/resturant.jpg',
        'Is_trend' => false,
    ]);
}

test('placing an order records quantities and clears the cart without online payment', function () {
    Http::preventStrayRequests();

    $user = orderCheckoutUser();
    $product = orderCheckoutProduct();
    $user->products()->attach($product->id, ['quantity' => 1]);

    $response = $this->actingAs($user, 'web')
        ->post(route('order.checkout'), [
            'quantities' => [$product->id => 2],
        ]);

    $order = Order::first();
    $response->assertRedirect(route('order.user'));
    $response->assertSessionHas('success', __('product.order_placed', ['id' => $order->id]));
    expect(Order::count())->toBe(1);
    expect(Orderitems::count())->toBe(1);
    expect(Orderitems::first()->quantity)->toBe(2);
    expect((float) Orderitems::first()->price)->toBe(8.99);
    expect(Status::where('order_id', $order->id)->value('name'))->toBe('pending');
    expect($user->fresh()->products()->count())->toBe(0);
});

test('placing an order uses cart quantity when no updated quantity is submitted', function () {
    Http::preventStrayRequests();

    $user = orderCheckoutUser();
    $product = orderCheckoutProduct();
    $user->products()->attach($product->id, ['quantity' => 3]);

    $this->actingAs($user, 'web')
        ->post(route('order.checkout'))
        ->assertRedirect(route('order.user'));

    expect(Orderitems::first()->quantity)->toBe(3);
});

test('an empty cart does not create an order', function () {
    Http::preventStrayRequests();
    $user = orderCheckoutUser();

    $this->actingAs($user, 'web')
        ->post(route('order.checkout'))
        ->assertRedirect(route('cart.view'))
        ->assertSessionHas('error', __('product.empty_cart_order'));

    expect(Order::count())->toBe(0);
});

test('invalid quantities do not place an order or clear the cart', function () {
    Http::preventStrayRequests();
    $user = orderCheckoutUser();
    $product = orderCheckoutProduct();
    $user->products()->attach($product->id, ['quantity' => 1]);

    $this->actingAs($user, 'web')
        ->post(route('order.checkout'), [
            'quantities' => [$product->id => 0],
        ])
        ->assertSessionHasErrors('quantities.' . $product->id);

    expect(Order::count())->toBe(0);
    expect($user->fresh()->products()->count())->toBe(1);
});

test('the cart offers order submission without online payment', function () {
    $user = orderCheckoutUser();
    $product = orderCheckoutProduct();
    $user->products()->attach($product->id, ['quantity' => 1]);

    $this->actingAs($user, 'web')
        ->get(route('cart.view'))
        ->assertOk()
        ->assertSee(__('product.place_order'))
        ->assertSee(__('product.no_online_payment_note'))
        ->assertDontSee('checkout.stripe.com')
        ->assertDontSee('Stripe');
});

test('order history shows owned order items totals and current status', function () {
    $user = orderCheckoutUser();
    $product = orderCheckoutProduct();
    $order = Order::create(['user_id' => $user->id]);
    Orderitems::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => 2,
        'price' => 8.99,
    ]);
    Status::create(['order_id' => $order->id, 'name' => 'pending']);
    Status::create(['order_id' => $order->id, 'name' => 'preparing']);

    $otherUser = User::create([
        'name' => 'Other Customer',
        'email' => 'other@example.test',
        'password' => 'password',
        'image' => 'avatars/other-customer.jpg',
    ]);
    $otherOrder = Order::create(['user_id' => $otherUser->id]);

    $this->actingAs($user, 'web')
        ->get(route('order.user'))
        ->assertOk()
        ->assertSee('#' . $order->id)
        ->assertSee('Happy Classic')
        ->assertSee('× 2')
        ->assertSee('$17.98')
        ->assertSee(__('product.status_preparing'))
        ->assertSee(route('ordertracking', ['id' => $order->id]))
        ->assertDontSee('class="order-id">#' . $otherOrder->id . '</span>', false);
});

test('order history shows an empty state when the customer has no orders', function () {
    $user = orderCheckoutUser();

    $this->actingAs($user, 'web')
        ->get(route('order.user'))
        ->assertOk()
        ->assertSee(__('product.no_orders_yet'))
        ->assertSee(__('product.start_ordering'));
});
