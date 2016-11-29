<!DOCTYPE html>
<html>
	<head>
		<title>Seat Display Component Based</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div id="app"> 
			<!-- <seat-display v-for="seat in seats" v-bind:seat="seat"></seat-display> -->
			<seat-display :seats="seatList"> </seat-display>	
			
			<!-- <pre> {{ $data | json }}</pre> -->

		</div>
		
		<template id="test-template">
			<div class="container">
				<div class="row">					
					<button 
						class="col-xs-2"
						v-bind:class="{ active : seat.checked, booked: seat.sts=='booked'? true : false, confirmed: seat.sts=='confirmed'? true : false, empty: seat.sts=='n/a'? true : false, 'col-xs-offset-3': emptySpace(seat.no) }"
						v-for="seat in seats" 					
						@click="toggle(seat)"						
						:disabled="isDisabledSeatSelection(seat.sts)"										
					> 				    	
						{{ seat.no }} - {{ seat.sts }}
					</button>			
				</div>
				<!-- v-show="seat.sts != 'n/a' ? true : false"	 -->
				<!-- {{ seatStatus(seat.sts) }} -->
		    	<!-- <span  v-show="seat.checked">Toggle info</span> -->
			</div>	
		</template>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		
		<script>
			Vue.component('seat-display', {
				template: '#test-template',
				props: ['seats'],
				data: function() {
						return {			        		        		
			        		seatNo: '',		        		
						    selectedSeat: []
						}
				},
				
				methods: {
					emptySpace: function (seatNo) {
						
						var seatNumber = parseInt(seatNo.match(/\d+/),10);

						// if ( ( seatNumber % 3 ) == 0) {
						// 	console.log('seat Number/3 True');
						// 	return true;
						// }
						// console.log('seat Number/3 False');
						// return false;	
						return ( (seatNumber % 3) == 0 ) ? true : false;

					},
					toggle: function(seat){
						// console.log('clicked');
						// console.log(seat.no);
						seat.checked = !seat.checked;		        		        	
			        	if (seat.checked) {
			        		//console.log('seat checked=', seat.checked);
			        		this.addSeat(seat.no); // to selectedSeat array		        		
			        		return ;
			        	}
			        	//console.log('seat NOT checked=', seat.checked);
			        	//var indx = this.selectedSeat.findIndex(seat);		        	
			        	this.removeSeat(seat.no, seat); // to selectedSeat array		        		            
			        },
			        addSeat: function(seatNo){
			        	//console.log('+', seatNo);
			        	this.selectedSeat.push({
			    			no: seatNo,
							sts: 'booked' //'selected'
			    		});
			        },
			        removeSeat: function(seatNo, seat){
			        	//console.log('-', seatNo);
			        	//var indx = this.selectedSeat.indexOf(seatNo);  
			        	/*
			    			'findIndex' callback is invoked with three arguments: 
			    			1.the value of the element, 
			    			2. the index of the element, and 
			    			3. the Array object being traversed.
			    			ref: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/findIndex 
			    			*/     	
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
			        			 seatStatus == 'confirmed' || seatStatus == 'n/a' ) ? true : false;
			        	//console.log('sts=', sts);
			        	//return sts;

			        },
				}
			})

			new Vue({
			    el: '#app',
			    data: {
			    	    seatList: [
						      { no: 'A1', sts: 'booked', checked:false},
						      { no: 'A2', sts: 'n/a', checked:false },
						      { no: 'A3', sts: 'n/a', checked:false},
						      { no: 'A4', sts: 'avaiable', checked:false },
						      { no: 'B1', sts: 'confirmed', checked:false },
						      { no: 'B2', sts: 'n/a', checked:false },
						      { no: 'B3', sts: 'available', checked:false },
						      { no: 'B4', sts: 'available', checked:false }
					    ]
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
			.empty {
				background-color: white;
				color:white;				
			}
		</style>
	</body>
</html>