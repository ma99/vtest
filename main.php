<!DOCTYPE html>
<html>
<head>
	<title>SMS box</title>
</head>
<body>
	<div id="app"> 
		<!-- <seat-display v-for="seat in seats" v-bind:seat="seat"></seat-display> -->
		<seat-display :seats="seatList"> </seat-display>	
		
		<!-- <pre> {{ $data | json }}</pre> -->

	</div>
	
	<template id="test-template">
		<div>
			<!-- <button v-for="(seat, index) in seats" v-bind:index="index" @click="toggle(seat.no)" v-bind:class="{ active: isOpen, booked: isBooked, confirmed: isConfirmed }" :disabled="isLocked" >{{ index }} - {{ seat.no }} - {{ seat.sts }}</button> -->
			<!-- @click="seat.checked = !seat.checked"   -->
			<!-- :disabled="seat.sts == 'booked'  ? true : false"		 -->
			<button v-bind:class="{ active : seat.checked, booked: seat.sts=='booked'? true : false, confirmed: seat.sts=='confirmed'? true : false }"
					v-for="seat in seats" 					
					@click="toggle(seat)"						
					:disabled="isDisabledSeatSelection(seat.sts)"					
			> 				    	
				{{ seat.no }} - {{ seat.sts }}
			</button>			
		
			<!-- {{ seatStatus(seat.sts) }} -->
	    	<!-- <span  v-show="seat.checked">Toggle info</span> -->
		</div>	
	</template>

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.8/vue.js"></script>
	
	
	<script>
		Vue.component('seat-display', {
			template: '#test-template',
			props: ['seats'],
			data: function() {
					return {
		        		arr: [], 						
		        		deleteTheSeat: '',
		        		//isBooked: false,
		        		//isConfirmed: false,
						//isOpen: false,
		        		seatNo: '',
		        		//sts: 'available',
		        		//isLocked: false,		        		
					    selectedSeat: []
					}
			},
			
			methods: {
				toggle: function(seat){
					console.log('clicked');
					console.log(seat.no);
					seat.checked = !seat.checked;
		        	//this.isOpen = !this.isOpen;		        	
		        	if (seat.checked) {
		        		console.log('seat checked=', seat.checked);
		        		this.addSeat(seat.no); // to selectedSeat array		        		
		        		return ;
		        	}

		        	console.log('seat NOT checked=', seat.checked);
		        	//var indx = this.selectedSeat.findIndex(seat);
		        	
		        	this.removeSeat(seat.no, seat); // to selectedSeat array
		        	//this.isOpen = true;
		        	// if (seat.checked) {
		        	// this.seatNo = seat.no;
		        	// //this.isOpen = true;
		        	// this.deleteTheSeat = '';
		        	// // 	//this.$emit('myseat', indx, this.seatNo); //sending multiple arguments
		        	// // 	//this.$emit('myseat', this.seatNo, this.deleteTheSeat);
		        	// this.addRemove(this.seatNo, this.deleteTheSeat);
		        	// 	return ;
		        	// }

		        	// //this.$emit('myseat', this.seatNo);
		        	// this.deleteTheSeat = this.seatNo;
		        	// this.seatNo = '';
		        	// this.isOpen = false;
		        	// console.log('deleted seat number');
		        	// console.log(this.deleteTheSeat);
		        	//this.$emit('myseat', this.seatNo, this.deleteTheSeat);		            
		        },
		        addSeat: function(seatNo){
		        	console.log('+', seatNo);
		        	this.selectedSeat.push({
		    			no: seatNo,
						sts: 'selected' //'booked'
		    		});
		        },
		        removeSeat: function(seatNo, seat){
		        	console.log('-', seatNo);
		        	//var indx = this.selectedSeat.indexOf(seatNo);       	
		        	var indx = this.selectedSeat.findIndex(function(seat){ 
		    				// here 'seat' is array object of selectedSeat array
		    				 return seat.no == seatNo;
		    			});
		    		console.log(indx);
		    		this.selectedSeat.splice(indx, 1);
		    		return;
		        },
		        isDisabledSeatSelection: function(seatStatus){
		        	console.log('disableSelection=', seatStatus);
		        	//var sts;
		        	return ( seatStatus == 'booked' || 
		        			 seatStatus == 'confirmed' ) ? true : false;
		        	//console.log('sts=', sts);
		        	//return sts;

		        },
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
		    			/*
		    			findIndex callback is invoked with three arguments: 
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
		    		
		    	},
		    	isEmpty: function(value) {
						return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
				},
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
				seatDeleted: function(seat) {
					return seat.no == seat;					
				}   
			}
		})

		new Vue({
		    el: '#app',
		    data: {
		    	    seatList: [
					      { no: 'A1', sts: 'booked', checked:false},
					      { no: 'A2', sts: 'available', checked:false },
					      { no: 'B1', sts: 'confirmed', checked:false },
					      { no: 'B2', sts: 'available', checked:false }
				    ],
				    //selectedSeat: []
		    }
		  //   methods: {
		  // //   	addRemove: function (seatNumber, deleteSeat) {
		  // //   		//console.log("hello");
		  // //   		/*console.log(index);
		  // //   		console.log("hello");
		  // //   		console.log(seatNumber);	*/	    		
		  // //   		//this.todos.indexOf(todo)
		  // //   		console.log("hello");
		  // //   		console.log('+', seatNumber);
		  // //   		console.log('-', deleteSeat);
		    		
		  // //   		if ( this.isEmpty(seatNumber) ) {
		  // //   			//console.log("hello");
		  // //   			//var indx = this.selectedSeat.indexOf(deleteSeat);	    			
		  // //   			 findIndex callback is invoked with three arguments: 
		  // //   			1.the value of the element, 
		  // //   			2. the index of the element, and 
		  // //   			3. the Array object being traversed.
		  // //   			ref: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/findIndex
		    			

		  // //   			var indx = this.selectedSeat.findIndex(function(seat){ 
		  // //   				// here 'seat' is array object of selectedSeat array
		  // //   				 return seat.no == deleteSeat;
		  // //   			});
		  // //   			console.log(indx);
		  // //   			this.selectedSeat.splice(indx, 1);
		  // //   			return;
		  // //   		}
		  // //   		//this.selectedSeat.push(seatNumber);
		  // //   		this.selectedSeat.push({
		  // //   			no: seatNumber,
				// // 		sts: 'selected' //'booked'
		  // //   		});
		  // //   	},
		  // //   	isEmpty: function(value) {
				// // 		return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
				// // },
				// // seatDeleted: function(seat) {
				// // 	return seat.no == seat;					
				// // }
		  //   }	    
		})

	</script>
	<style>
		.active {
			background-color: green;
		}
		/*.checked {
			background-color: green;
		}*/
		.booked {
			background-color: yellow;	
		}
		.confirmed {
			background-color: red;
		}
	</style>

</body>
</html>