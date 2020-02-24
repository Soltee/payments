@extends('layouts.app')
@section('content')

    <div class=" overflow-hidden bg-gray-500	flex flex-row justify-around items-center h-screen ">

        <div class="flex flex-col justify-center items-center my-8 p-4  bg-gray-800 rounded">
        	<div class="flex justify-center items-center">
        		<h3 class="text-md font-medium text-white">Choose Payment Type</h3>

        	</div>
        	<div class="flex justify-center items-center mt-10 mb-3 w-full">
		  		<a href="/checkout?type=once">
				    <input type="radio" name="type" value="once" id="option1"> 
				    <span class=" ml-2 text-bold font-semibold text-white">Once Payment</span>
				</a>
		  		<a href="/checkout?type=subscription" class="ml-3">
				  	
				    <input type="radio" name="type" value="subscription" id="option2"> 
				   	<span class=" ml-2 text-bold font-semibold text-white">Subscription</span>

				</a>
        	</div>
		  
		</div>

		<div class="w-64">
			<div class="my-6">
				<h3>All</h3>
				@foreach($orders as $order)
					<div class="flex items-center">
						<div class="flex items-center">
							<span>Total</span>
							<span class="ml-3">$ {{ $order->total }}</span>
						</div>
						<span>{{ $order->subscription }}</span>
					</div>
				@endforeach
			</div>
			<div class="">
				<h3>Once</h3>
				@foreach($once as $order)
					<div class="flex items-center">
						<div class="flex items-center">
							<span>Total</span>
							<span class="ml-3">$ {{ $order->total }}</span>
						</div>
					</div>
				@endforeach
			</div>
			
			{{-- <div class="">

				<h3>Subscriptions</h3>
				@foreach($subscriptions as $order)
					<div class="flex items-center">
						<div class="flex items-center">
							<span>Total</span>
							<span class="ml-3">$ {{ $order->total }}</span>
						</div>
					</div>
				@endforeach
			</div> --}}
		</div>
    </div>

@endsection