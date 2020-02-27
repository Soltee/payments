<template>
	   <div class="container mx-auto my-4 ">
        <div class="flex flex-wrap justify-center p-2">
            <div class="w-full max-w-xl">
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                    <div v-if="!paymentTypeStatus">
                    	<div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        	Payment Type
                    	</div>

                    	<div class="flex justify-around items-center my-6">
                    	

                    		<div @click="paymentType = 'once'; paymentTypeStatus=true;" class="border-2  flex flex-col items-center group hover:border-green-600  px-3 py-3 rounded-lg cursor-pointer transition-all duration-150 ease-in-out" :class="(paymentType == 'once') ? 'border-green-600 transition-all duration-150 ease-in-out' : ''">
                          		<span class="font-semibold text-gray-700 mb-2">Once Payment</span>                    		

								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6  group-hover:text-green-600"  :class="(paymentType == 'once') ? 'text-green-600 transition-all duration-150 ease-in-out' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                    			
                    		</div>
                    		<div @click="paymentType = 'oncesubscription'; paymentTypeStatus=true;" class="border-2  flex flex-col items-center group hover:border-green-600  px-3 py-3 rounded-lg cursor-pointer transition-all duration-150 ease-in-out" :class="(paymentType == 'subscription') ? 'border-green-600 transition-all duration-150 ease-in-out' : ''">
                          		<span class="font-semibold text-gray-700 mb-2">Subscription</span>                    		

								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 group-hover:text-green-600"  :class="(paymentType == 'subscription') ? 'text-green-600 transition-all duration-150 ease-in-out' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                    			
                    		</div>
                    	</div>
                    </div>

                    <form v-else @submit.prevent="submitPaymentMethod()" class="w-full p-6 transition-all duration-150 ease-in-out" method="POST" action="">
                    	<div class="flex flex-col ">
		        		<input type="hidden" name="pType" :value="paymentType">
		        		<div v-if="paymentType == 'once'">
		        			
                    		<div class="flex items-center mn-6">
                    			<svg @click="paymentType = ''; paymentTypeStatus=false;" class="h-6 w-6 text-blue-800 mr-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><polygon points="3.828 9 9.899 2.929 8.485 1.515 0 10 .707 10.707 8.485 18.485 9.899 17.071 3.828 11 20 11 20 9 3.828 9"/></svg>
                    			<p class="text-gray-800 font-medium py-3">Customer information</p>
                    			
                    		</div>
						    <div class="mb-6 ">
						      	<label class="block text-gray-700 text-sm font-bold mb-2" for="name">
		                        Name
		                      </label>
		                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Name">
		                    </div>
						    <div class="mb-6">
			                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
			                      Email
			                    </label>
			                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="email">
			                  </div>
						     <div class="flex flex-wrap w-full mb-6">
			                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
			                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
			                        City
			                      </label>
			                      <div class="relative">
			                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" name="city">
			                          <option>Pokhara</option>
			                        </select>
			                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
			                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
			                        </div>
			                      </div>
			                    </div>
			                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
			                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="street">
			                        Street Address
			                      </label>
			                      <div class="relative">
			                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="street" type="text" placeholder="Albuquerque" name="address">


			                      </div>
			                    </div>
			                  </div>
		        		</div>

						    <p class="my-4 text-gray-800 font-medium py-3">Payment methods</p>

						    <div class="flex items-center justify-around flex-wrap">
						    	<div v-if="paymentType == 'once'" class="flex items-center justify-between">
						    		
							    	<div @click="paymentMethod = 'cash'" class="flex flex-col items-center px-4 py-4 rounded-lg  group border-2 border-gray-500 mr-3 hover:border-green-600 ">
										    <input type="checkbox" class="hidden" name="payment_method" value="cash" id="option1"> 
										    <span class=" ml-2 mb-3 font-semibold text-gray-700">Cash on Delivery</span>
										    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 group-hover:text-green-600"  :class="(paymentMethod == 'cash') ? 'text-green-600 transition-all duration-150 ease-in-out' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

									</div>
						        	<div @click="paymentMethod = 'khalti'" class="flex flex-col items-center px-4 py-4 rounded-lg  group border-2 border-gray-500  hover:border-green-600 ">
								  	
										    <input type="checkbox" class="hidden" name="payment_method" value="khalti" id="option1"> 
										    <span class=" ml-2 mb-3 font-semibold text-gray-700">Khalti</span>

										    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 group-hover:text-green-600"  :class="(paymentMethod == 'khalti') ? 'text-green-600 transition-all duration-150 ease-in-out' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
									</div>
								</div>

								<div @click="paymentMethod = 'paypal'" class="flex flex-col items-center px-4 py-4 rounded-lg  group border-2 border-gray-500  hover:border-green-600 ">
									<input type="checkbox" class="hidden" name="payment_method" value="paypal" id="option1"> 
									<span class=" ml-2 mb-3 font-semibold text-gray-700">Paypal</span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 group-hover:text-green-600"  :class="(paymentMethod == 'paypal') ? 'text-green-600 transition-all duration-150 ease-in-out' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
								</div>
								<div @click="paymentMethod = 'stripe'; loadIntent();" class="flex flex-col items-center px-4 py-4 rounded-lg  group border-2 border-gray-500  hover:border-green-600 ">
									<input type="checkbox" class="hidden" name="payment_method" value="stripe" id="option1"> 
									<span class=" ml-2 mb-3 font-semibold text-gray-700">Stripe</span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 group-hover:text-green-600"  :class="(paymentMethod == 'stripe') ? 'text-green-600 transition-all duration-150 ease-in-out' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
								</div>
						    </div>

                    	</div>

                    	<div class="my-6" v-if="paymentMethod == 'stripe'">
                    		<div class="flex flex-col mb-3">
	                    		<label>Card Holder Name</label>
						        <input id="card-holder-name" type="text" v-model="name" class="px-3 py-3 rounded-lg mb-2 w-full">
						    </div>
                    		<div class="flex flex-col ">
						        <label>Card</label>
						        <div id="card-element"></div>
						    </div>
                    	</div>	
                      
                        <button type="submit" class=" my-3 bg-gray-800 hover:bg-gray-700 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline">
                                Subscribe
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
	export default {
		name : 'charge-payments',
		props : {
			auth : {
				required : false,
				default  : {}
			}
		},
		data(){
			return {
				paymentType       : '',
				paymentTypeStatus :false,
				paymentMethod     : '',
                csrf              : document.head.querySelector('meta[name="csrf-token"]').content,
                intentToken       : '',
                name               : '',
                addPaymentStatus   :    0,
                addPaymentStatusError  :   '',
                stripe     : '',
		        elements   : '',
		        card       : '',
		        paymentMethods : []			
            }
		},
		mounted(){
		},
		methods: {
			loadIntent(){
			    axios.get('/user/setup-intent')
			        .then( ( response ) => {
			            this.intentToken = response.data.intent;
			        });

			    let key = process.env.MIX_STRIPE_APP_KEY;

			    setTimeout(() => {
					this.stripe = Stripe(`${key}`);

				    this.elements = this.stripe.elements();
				    if(this.paymentMethod == 'stripe'){
				    	this.card = this.elements.create('card');
				    	this.card.mount('#card-element');
				    }
			    }, 500);
			    
			    

			},
			submitPaymentMethod(){

	           this.addPaymentStatus = 1;

			    this.stripe.confirmCardSetup(
			        this.intentToken.client_secret, {
			            payment_method: {
			                card: this.card,
			                billing_details: {
			                    name: this.name
			                }
			            }
			        }
			    ).then(function(result) {
			        if (result.error) {
			            this.addPaymentStatus = 3;
			            this.addPaymentStatusError = result.error.message;
			        } else {
			            this.savePaymentMethod( result.setupIntent.payment_method );
			            this.addPaymentStatus = 2;
			            this.card.clear();
			            this.name = '';
			        }
			    }.bind(this));

			},
			savePaymentMethod(method)
			{
				axios.post('/user/payments', {
					method : method
				}).then(res => {
					// if(status == 200)
					// {
					// 	alert('successful.');
					// }
					this.loadPaymentMethods();
				});
			},
			loadPaymentMethods(){
			    axios.get('/api/v1/user/payment-methods')
			        .then( function( response ){
			            this.paymentMethods = response.data;
			        }.bind(this));
			},


		}
	};	
</script>
<style scoped>
	
</style>