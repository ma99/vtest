<!DOCTYPE html>
<html>
<head>
	<title>SMS box</title>
</head>
<body>
	<div id="app"> 
		<!-- <seat-display v-for="seat in seats" v-bind:seat="seat"></seat-display> -->
		<seat-display v-for="(seat, index) in seats" v-bind:seat="seat" v-bind:index="index" v-on:myseat="addRemove"></seat-display>	
		
		<!-- <pre> {{ $data | json }}</pre> -->

	</div>
	
	<template id="test-template">
		<div>
			<!-- <button v-bind:class="{ active: isOpen, confirmed: isConfirmed }" @click='toggle()' :disabled="isOpen">A1</button> -->
			
			<!-- <button v-bind:class="{ active: isOpen }" @click="toggle(seat.no)">{{ index }} - {{ seat.no }}</button> -->
			<button v-bind:class="{ active: isOpen, booked: isBooked, confirmed: isConfirmed }" @click="toggle(seat.no)" :disabled="isLocked">{{ index }} - {{ seat.no }} - {{ seat.sts }}</button>
			{{ seatStatus(seat.sts) }}
	    	<span  v-show="isOpen">Toggle info</span>
		</div>	
	</template>

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.8/vue.js"></script>
	
	
	<script>
		Vue.component('seat-display', {
			template: '#test-template',
			props: ['seat', 'index', 'locked'],
			data: function() {
					return {
		        		arr: [], 						
		        		deleteTheSeat: '',
		        		isBooked: false,
		        		isConfirmed: false,
						isOpen: false,
		        		seatNo: '',
		        		sts: 'available',
		        		isLocked: false
					}
			},
			// watch: {
			// 	seatNo: function (val, oldVal) {
			// 		this.arr.push(val);
			// 	}

			// },
			// computed: {
			//   seatStatus: function (sts) {
			//     console.log('seatStatus=', sts );
			//    // this.sts = seat.sts;
			//   }
			// },
			methods: {
				// created: function () {
				//     console.log('seatStatus=', seat.sts );
				//     this.sts = seat.sts;
			 //  	},
			 	seatStatus: function (sts) {
				    console.log('seatStatus=', sts );
				    if (sts == 'booked') {
				    	this.isBooked= true;
				    	this.isLocked = true;
					}
					if (sts == 'confirmed') {
					    this.isConfirmed=true;
					    this.isLocked = true;
					}
				    
				},
				toggle: function(seatNumber){
					console.log('clicked');
					console.log(seatNumber);
		        	this.isOpen = !this.isOpen;		        	
		        	if (this.isOpen) {
		        		this.seatNo = seatNumber;
		        		this.deleteTheSeat = '';
		        		//this.$emit('myseat', indx, this.seatNo); //sending multiple arguments
		        		this.$emit('myseat', this.seatNo, this.deleteTheSeat);
		        		return ;
		        	}

		        	//this.$emit('myseat', this.seatNo);
		        	this.deleteTheSeat = this.seatNo;
		        	this.seatNo = '';
		        	console.log('deleted seat number');
		        	console.log(this.deleteTheSeat);
		        	this.$emit('myseat', this.seatNo, this.deleteTheSeat);		            
		        }    
			}
		})

		new Vue({
		    el: '#app',
		    data: {
		    	    seats: [
					      { no: 'A1', sts: 'booked' },
					      { no: 'A2', sts: 'booked' },
					      { no: 'B1', sts: 'confirmed' },
					      { no: 'B2', sts: 'available' }
				    ],
				    selectedSeat: []
		    },
		    methods: {
		    	addRemove: function (seatNumber, deleteSeat) {
		    		//console.log("hello");
		    		/*console.log(index);
		    		console.log("hello");
		    		console.log(seatNumber);	*/	    		
		    		//this.todos.indexOf(todo)
		    		console.log("hello");
		    		console.log('+', seatNumber);
		    		console.log('-', deleteSeat);
		    		
		    		if ( this.isEmpty(seatNumber) ) {
		    			//console.log("hello");
		    			//var indx = this.selectedSeat.indexOf(deleteSeat);	    			
		    			/* findIndex callback is invoked with three arguments: 
		    			1.the value of the element, 
		    			2. the index of the element, and 
		    			3. the Array object being traversed.
		    			ref: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/findIndex
		    			*/

		    			var indx = this.selectedSeat.findIndex(function(seat){ 
		    				// here 'seat' is array object of selectedSeat array
		    				 return seat.no == deleteSeat;
		    			});
		    			console.log(indx);
		    			this.selectedSeat.splice(indx, 1);
		    			return;
		    		}
		    		//this.selectedSeat.push(seatNumber);
		    		this.selectedSeat.push({
		    			no: seatNumber,
						sts: 'selected' //'booked'
		    		});
		    	},
		    	isEmpty: function(value) {
						return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
				},
				seatDeleted: function(seat) {
					return seat.no == seat;					
				}
		    }	    
		})

	</script>
	<style>
		.active {
			background-color: green;
		}
		.booked {
			background-color: yellow;	
		}
		.confirmed {
			background-color: red;
		}
	</style>

</body>
</html>