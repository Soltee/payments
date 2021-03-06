@extends('layouts.app')


@section('extra-scripts')
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
	<script src="https://js.stripe.com/v3/"></script>
@endsection
@section('extra-css')
	<style type="text/css">
          /**
             * The CSS shown here will not be introduced in the Quickstart guide, but shows
             * how you can use CSS to style your Element's container.
             */
            .StripeElement {
              box-sizing: border-box;

              height: 40px;

              padding: 10px 12px;

              border: 1px solid transparent;
              border-radius: 4px;
              background-color: white;

              box-shadow: 0 1px 3px 0 #e6ebf1;
              -webkit-transition: box-shadow 150ms ease;
              transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
              box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
              border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
              background-color: #fefde5 !important;
            }
    </style>
@endsection

@section('content')

    <div class="bg-gray-800 ">

        <div class="  rounded">
        	<div class="flex justify-center items-center">
        		<h3 class="text-md font-medium text-white">Choose Payment Method</h3>

        	</div>
        	<form id="payment-form" method="POST" action="{{ route('checkout.store') }}" class="  w-full">
        		@csrf
	        	<div class="" x-data="{ tab: 'none' }" >
	        		<div class="flex flex-row justify-around items-center">	
		        		<input type="hidden" name="type" value="{{ $type }}">
		        		@if($type == 'once')
			        		<div @click="tab = 'none'" class="method flex items-center">
			        		<label class="py-4 px-4 px-4 py-4 bg-gray-900 rounded-lg group border-2  border-transparent hover:border-green-600 active:border-green-600">
					  	
							    <input type="checkbox" class="hidden" name="payment_method" value="cash" id="option1"> 
							    <span class=" ml-2 text-bold font-semibold text-white">Cash on Delivery</span>
							</label>
							</div>

						<div class="method flex items-center">
						<label class="py-4 px-4 px-4 py-4 bg-gray-900 rounded-lg ml-3 group border-2  border-transparent hover:border-green-600 active:border-green-600">
						  	
						    <input type="checkbox" class="hidden" name="payment_method" value="khalti" id="option2"> 
						   	<span class=" ml-2 text-bold font-semibold text-white">Khalti</span>

						</label>
						</div>
						@endif

		        		@if($type == 'subscription' ||  auth()->user())
							<div class="method flex flex-row items-center">
							<label class="py-4 px-4 px-4 py-4 bg-gray-900 rounded-lg ml-3 group border-2  border-transparent hover:border-green-600 active:border-green-600">
							  	
							    <input type="checkbox" class="" name="payment_method" value="paypal" id="option2"> 
							   	<span class=" ml-2 text-bold font-semibold text-white">Paypal</span>

							</label>
							</div>

							<div @click="tab = 'stripe'" class="method flex flex-row items-center">
							<label class="py-4 px-4 px-4 py-4 bg-gray-900 rounded-lg ml-3 group border-2  border-transparent hover:border-green-600 active:border-green-600">
							  	
							    <input type="checkbox" id="stripe" class="" name="payment_method" value="stripe" id="option2"> 
							   	<span class=" ml-2 text-bold font-semibold text-white">Stripe</span>

							</label>
							</div>
						@endif
					</div>
					<div x-show="tab === 'stripe'" class="my-4 flex flex-col items-center w-full">
							<label for="card-element" class="mb-4 py-2  font-bold text-lg">
	                        	Credit details
	                      	</label>
	                      	<div id="card-element" class="my-3">
	                        	<!-- A Stripe Element will be inserted here. -->
	                      	</div>

	                      	<!-- Used to display form errors. -->
	                      	<div id="card-errors" role="alert" class="text-red-600 mb-3"></div>
					</div>
					<div class="my-8 flex justify-center items-center">
						<button type="submit" class="text-white px-4 py-4 rounded-lg bg-blue-600">Place Your Order</button>						
					</div>

        		</div>
        	</form>
		  
		</div>
    </div>

@endsection

	{{--@section('scripts')

 	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" ></script>
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine-ie11.js"></script>
	<script>
		let stripeCheckbox = document.getElementById('stripe');
		var form = document.getElementById('payment-form');
		// const total = 10 * 100;
	 //    var config = {
	 //        // replace the publicKey with yours
	 //        "publicKey": "<?php echo env('KHALTI_PUBLIC_KEY'); ?>",
	 //        "productIdentity": "1234567890",
	 //        "productName": "Dragon",
	 //        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
	 //        "eventHandler": {
	 //            onSuccess (payload) {
	 //            	// request options
	 //            	// let input = document.createElement('input');
	 //            	// input.value = payload.token;
		// 			const options = {
		// 			    method: 'POST',
		// 			    body: JSON.stringify(payload),
		// 			    headers: {
		// 			        'Content-Type': 'application/json',
		// 			        "Accept": "application/json",
	 //        				"X-Requested-With": "XMLHttpRequest",
	 //        				"X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content
		// 			    }
		// 			}
	 //                // hit merchant api for initiating verfication
	 //                fetch('/checkout', options)
		// 		    .then(res => res.json())
		// 		    .then(res => {
		// 		    	console.log(res);
		// 		    	if(res.status == 200){
		// 		    		console.log('Payment Successful.');
		// 		    	}
		// 		    })
		// 		    .catch((error) => {
		// 		    	console.log('Error!');
		// 		    });
	 //                // console.log(payload);
	 //            },
	 //            onError (error) {
	 //                console.log(error);
	 //            },
	 //            onClose () {
	 //                console.log('widget is closing');
	 //            }
	 //        }
	 //    };

	 //    var checkout = new KhaltiCheckout(config);
	 //    // console.log(total);
	 //    KhaltiBtn.onclick = function () {
	 //        checkout.show({amount: total});
	 //    }

		if(stripeCheckbox.checked){
			if('<?php echo $type = "subscription"; ?>'){
				alert('Yes');
				let intentToken = '';
				axios.get('/api/v1/user/setup-intent')
		        .then( ( response ) => {
		      //   	var hiddenInput = document.createElement('input');
				    // hiddenInput.setAttribute('type', 'hidden');
				    // hiddenInput.setAttribute('name', 'stripeToken');
				    // hiddenInput.setAttribute('value', token.id);
		            intentToken = response.data;
	       	 	});
			}
			

		// Create a Stripe client.
			var stripe = Stripe('<?php echo env('STRIPE_PUBLISHABLE_KEY'); ?>');
			  
			// Create an instance of Elements.
			var elements = stripe.elements();
			  
			// Custom styling can be passed to options when creating an Element.
			// (Note that this demo uses a wider set of styles than the guide below.)
			var style = {
			    base: {
			         color: "#32325d",
			    }
			};
			  
			// Create an instance of the card Element.
			var card = elements.create('card', {style: style});
			  
			// Add an instance of the card Element into the `card-element` <div>.
			card.mount('#card-element');
						  
			// Handle real-time validation errors from the card Element.
			card.addEventListener('change', function(event) {
			    var displayError = document.getElementById('card-errors');
			    if (event.error) {
			        displayError.textContent = event.error.message;
			    } else {
			        displayError.textContent = '';
			    }
			});
  
		// Handle form submission.
		form.addEventListener('submit', function(event) {
		    event.preventDefault();
		  
		    stripe.createToken(card).then(function(result) {
		        if (result.error) {
		            // Inform the user if there was an error.
		            var errorElement = document.getElementById('card-errors');
		            errorElement.textContent = result.error.message;
		        } else {
		            // Send the token to your server.
		            stripeTokenHandler(result.token);
		        }
		    });
		});
		  
		// Submit the form with the token ID.
		function stripeTokenHandler(token) {
		    // Insert the token ID into the form so it gets submitted to the server
		    var form = document.getElementById('payment-form');
		    var hiddenInput = document.createElement('input');
		    hiddenInput.setAttribute('type', 'hidden');
		    hiddenInput.setAttribute('name', 'stripeToken');
		    hiddenInput.setAttribute('value', token.id);
		    form.appendChild(hiddenInput);
		  
		    // Submit the form
		    form.submit();
		}
	}
	</script>
@endsection --}}