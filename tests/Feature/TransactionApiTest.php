<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Bank;
use App\Transaction;

class TransactionApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $bank;

    public function setUp():void
    {
        parent::setUp();
        
        $this->user = factory(User::class)->create();
        $this->bank= factory(Bank::class)->create();

        $this->actingAs($this->user,'api-user');
    }

    /**
     * Transaction API Store Test
     *
     * @return void
     */
    public function testCanStoreTransaction()
    {
        $form_data = [
            'bank_id' => $this->bank->id,
            'amount' => 50,
            'description' => 'Testing Store Test',
            'date' => '08.05.2021'
        ];

        $this->json('POST',route('api.transaction.store'),$form_data)
                ->assertStatus(200);
    }

    /**
     * Transaction API Listing Test
     *
     * @return void
     */
    public function testCanShowTransactionsList()
    {
        $this->get(route('api.transaction.index'))
                ->assertStatus(200);
    }

    /**
     * Transaction API Delete Test
     *
     * @return void
     */
    public function testCanDeleteTransaction()
    {
        $transaction = factory(Transaction::class)->make();
        $this->bank->transactions()->save($transaction);

        $this->delete(route('api.transaction.delete',$transaction->id))
                ->assertStatus(200);
    }

    /**
     * Transaction API Update Test
     *
     * @return void
     */
    public function testCanUpdateTransaction()
    {
        $transaction = factory(Transaction::class)->make();
        $this->bank->transactions()->save($transaction);
        
        $form_data = [
            'bank_id' => $this->bank->id,
            'amount' => 50,
            'date' => '02.05.2021',
            'description' => 'Update Test'
        ];

        $this->json('PUT',route('api.transaction.update',$transaction->id),$form_data)
                ->assertStatus(200);
    }
}
