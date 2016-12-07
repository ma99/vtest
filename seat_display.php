<!DOCTYPE html>
<html>
	<head>
		<title>Seat Display Component Based</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div id="app"> 
			<!-- <seat-display v-for="seat in seats" v-bind:seat="seat"></seat-display> -->
			<seat-display> </seat-display>	
			
			<!-- <pre> {{ $data | json }}</pre> -->

		</div>
		
		<template id="test-template">
			<div class="container">
				<div class="row">					
					<button 
						class="col-xs-2"
						v-bind:class="{ 
						active : seat.checked, 
						booked: seat.sts=='booked'? true : false, 
						confirmed: seat.sts=='confirmed'? true : false, 
						empty: seat.sts=='n/a'? true : false, 						
						'col-xs-offset-2': emptySpace(seat.no) }"
						v-for="seat in seatList" 					
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
		
		<script>
			Vue.component('seat-display', {
				template: '#test-template',
				//props: ['seats'],
				data: function() {
						return {
							seatChar:["A","B", "C" , "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O"],			        		        		
			        		seatNo: '',			        				        		
						    selectedSeat: [],
						    seatList: [
						      { no: 'A1', sts: 'booked', checked:false},
						      { no: 'A2', sts: 'n/a', checked:false },
						      { no: 'A3', sts: 'n/a', checked:false},
						      { no: 'A4', sts: 'avaiable', checked:false },
						      { no: 'B1', sts: 'confirmed', checked:false },
						      { no: 'B2', sts: 'n/a', checked:false },
						      { no: 'B3', sts: 'n/a', checked:false },
						      { no: 'B4', sts: 'available', checked:false },
						      { no: 'C1', sts: 'available', checked:false },
						      { no: 'C2', sts: 'available', checked:false },
						      { no: 'C3', sts: 'available', checked:false },
						      { no: 'C4', sts: 'available', checked:false },
						      //{ no: 'C5', sts: 'available', checked:false }
						      { no: 'D1', sts: 'available', checked:false },
						      { no: 'D2', sts: 'available', checked:false },
						      { no: 'D3', sts: 'available', checked:false },
						      { no: 'D4', sts: 'available', checked:false },
						      { no: 'D5', sts: 'available', checked:false }
					   		]
						}
				},
				
				methods: {					
					emptySpace: function (seatNo) {						
						
						if ( this.isFiveCol(seatNo) ) {
							return false; // no need empty space between columns
						}
						var seatNumber = parseInt(seatNo.match(/\d+/),10);						
						return ( (seatNumber % 3) == 0 ) ? true : false;

					},
					isFiveCol: function(seatNo){
						
						var seatListLength =  this.seatList.length;
						var numberOfRow = (seatListLength-1) /4; //2
						var lastRowChar = this.seatChar[numberOfRow-1]; //B
						lastRowChar = lastRowChar.trim();
						
						var seatChar = seatNo.substr(0, 1); //extract char from seat no
						return ( lastRowChar == seatChar ) ? true : false ;
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
			    		//console.log(indx);
			    		this.selectedSeat.splice(indx, 1);
			    		return;
			        },
			        isDisabledSeatSelection: function(seatStatus){
			        	//console.log('disableSelection=', seatStatus);
			        	return ( seatStatus == 'booked' || 
			        			 seatStatus == 'confirmed' || seatStatus == 'n/a' ) ? true : false;
			        },
				}
			})

			new Vue({
			    el: '#app'			    
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
				border-width: 0;
			    /*color: #0a0a0a;*/
				color:white;				
			}
			#app button {				
				height: 50px;
				margin: 10px 10px 0 0;
			}
			#app button.col-xs-2 {
		    	width: 16.76666667%;		    	
			}
			#app button.col-xs-offset-2 {
			    margin-left: 17.666667%;
			}
			#app button.is-white {
			    background-color: white;
			    border-width: 0;
			    color: #0a0a0a;
			}
		</style>
	</body>
</html>