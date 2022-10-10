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
                    Welcome back Admin !!
                    <!--<div class="">-->
                    <!--    <a href="/deposit" class="p-2 bg-gray-100">Fund Wallet</a>-->
                    <!--</div>-->
                </div>

                <div class="flex items-center space-x-2">
                    <div class="w-1/3 flex border items-center hover:bg-gray-100 bg-white bg-white h-32">
                        <div class="mx-auto flex flex-col items-center">
                            <h2 class="text-xl font-bold">{{count($users)}}</h2>
                            <span class="text-gray-500 text-md" >Total Users</span>
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
                            <h2 class="text-xl font-bold">10</h2>
                            <span class="text-gray-500 text-md" >Deposits</span>
                        </div>
                    </div>
                    
                   
                    
                </div>
            </div>
        </div>
    </div>
    
    
     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-5 h-screen bg-gray-100">
                <h1 class="text-xl mb-2">
                   User  Transactions 
                </h1> 
            
                    <table class="w-full p-4">
                        <thead class="bg-gray-50 border-b-3 border-gray-300">
                            
                            <tr class="bg-gray-50">
                                
                                <td class="p-3 text-sm font-semibold tracking-wide text-left">Id</td>
                                
                                
                                <td class="p-3 text-sm font-semibold tracking-wide text-left">Name</c>
                                
                                <td class="p-3 text-sm font-semibold tracking-wide text-left">Email</td>
                                
                                <td class="p-3 text-sm font-semibold tracking-wide text-left">Amount</td>
                                
                                 <td class="p-3 text-sm font-semibold tracking-wide text-left">Number of Deposits</td>
                            </tr>
                           
                        </thead>
                        
                        
                        <tbody>
                            
                         @foreach ($users as $user)
                            <tr class="bg-white">
                                    <td class="p-3 text-sm text-gray-700">{{$user->id}}</td>
                                    <td class="p-3 text-sm text-gray-700">{{$user->name}}</td>
                                    <td class="p-3 text-sm text-gray-700">{{$user->email}}</td>
                                    <td class="p-4 text-sm tracking-wide text-right">{{$user->wallet->amount}}</td>
                                    <td class="p-3 text-sm text-gray-700">{{ count($user->deposits) }}</td>
                                </tr>
                                 @endforeach
                        </tbody>
                       
                    </table>
                    

                    

                 
                    
                   
                    
               
            </div>
            </div>
        
    </div>
    
    
   
</x-app-layout>
