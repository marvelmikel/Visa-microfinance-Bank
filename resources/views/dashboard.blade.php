<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 actions flex justify-between">
                    You're logged in!
                    <div class="">
                        <a href="/deposit" class="p-2 bg-gray-100">Fund Wallet</a>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <div class="w-1/3 flex border items-center hover:bg-gray-100 bg-white bg-white h-32">
                        <div class="mx-auto flex flex-col items-center">
                            <h2 class="text-xl font-bold">N{{ auth()->user()->wallet->amount }}</h2>
                            <span class="text-gray-500 text-md" >Wallet Balance</span>
                        </div>
                    </div>

                    <div class="w-1/3 flex border items-center hover:bg-gray-100 h-32">
                        <div class="mx-auto flex flex-col items-center">
                            <h2 class="text-xl font-bold">0</h2>
                            <span class="text-gray-500 text-md" >Withdrawals</span>
                        </div>
                    </div>

                    <div class="w-1/3 flex border items-center hover:bg-gray-100 bg-white h-32">
                        <div class="mx-auto flex flex-col items-center">
                            <h2 class="text-xl font-bold">{{ count( auth()->user()->deposits ) }}</h2>
                            <span class="text-gray-500 text-md" >Deposits</span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
