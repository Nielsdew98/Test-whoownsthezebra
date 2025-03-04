<?php

namespace App\Livewire;

use Livewire\Component;

class IngredientsChanger extends Component
{
    public $ingredients = [];

    public $servings = 2;

    public function render()
    {
        return <<<'HTML'
        <div>
             <h3 class="font-fancy text-3xl text-nutmeg">Ingredients</h3>
                    <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900">Choose servings:</label>
                    <div class="relative flex items-center max-w-[8rem]">
                        <button wire:click="decrementServings" type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                            </svg>
                        </button>
                        <input wire:model="servings" type="text" id="quantity-input" value="{{$this->servings}}" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
                        <button wire:click="incrementServings" type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                            </svg>
                        </button>
                    </div>
                <ul
                    class="list-disc marker:text-nutmeg mt-4 ml-6 text-wenge-brown marker:align-middle"
                >
                @foreach ($this->ingredients as $ingredient)
                    <li class="pl-4">{{$ingredient->amount . ' ' . $ingredient->unit . ' ' . $ingredient->name}}</li>
                @endforeach
                </ul>
        </div>
        HTML;
    }

    public function updateIngredients()
    {
        foreach ($this->ingredients as &$ingredient) {
            $ingredient['amount'] = $ingredient['amount'] * ($this->servings / 2);
        }
    }

    public function decrementServings()
    {
        if ($this->servings > 1) {
            $this->servings--;
            $this->updateIngredients();
        }
    }

    public function incrementServings()
    {
        $this->servings++;
        $this->updateIngredients();
    }
}
