<!DOCTYPE html>
<html>
	<head>
		<title>Seat Planning</title>
		<!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	</head>
	<body>
		<div id="app"> 			
			<seat-planning> </seat-planning>	
		</div>
		
		<template id="test-template">
			<div class="container">
				<div class="row">
					<button
						class="col-xs-2" 						
						v-bind:class="{ active : seat.checked, 
										inactive : !seat.checked, 
										'col-xs-offset-2': emptySpace(seat.no)
										}"
						v-for="seat in seatList" 					
						@click="toggle(seat)"																
					> 											
						<i class="fa fa-check fa-lg tickmark" v-show="seat.checked"></i>
						<i class="fa fa-times fa-lg crossmark" aria-hidden="true" v-show="!seat.checked"></i>

						{{ seat.no }} - {{ seat.sts }}
						
					</button>	
				</div>	
				<!-- {{ seatStatus(seat.sts) }} -->
		    	<!-- <span  v-show="seat.checked">Toggle info</span> -->
		    	<!-- <br> -->
		    	 <!-- {{ seatList }} -->
			</div>	
		</template>

		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
		
		
		<script>
			Vue.component('seat-planning', {
				template: '#test-template',				
				data: function() {
						return {			        		
			        		seatChar:["A","B", "C" , "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O"],
			        		seatNo: '',		        								    
						    seatList: [],
						   // lastRowSeatList:[]						    
						}

				},
				created: function(){
					this.createList();					
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
					createList: function(){
						var r; //row					
						var code = 64;
						var seatNo;
						var numberOfRow = 8;
						var numberOfCol = 4;
						for ( r=1; r<=numberOfRow; r++ ){
							// console.log('row=', r);
							var c; //col							
							for( c=1; c<=numberOfCol; c++){
								seatNo = String.fromCharCode(code+r)+ c ;
								// console.log('col=', c);
								// console.log('seat=', seatNo); 
								this.seatList.push({
									no: seatNo,
									sts: 'available', 
									checked: true
								});
							}
						}
						seatNo = String.fromCharCode(code+numberOfRow)+ c ; //64+6 + 5 E5
						this.seatList.push({
									no: seatNo,
									sts: 'available', 
									checked: true
						});	
					},	
					toggle: function(seat){						
						seat.checked = !seat.checked;		        		        	
			        	if (seat.checked) {
			        		seat.sts = 'available';
			        		return ;
			        	}			        				        	      	
			        	seat.sts = 'n/a';
			        }
				}
			})

			new Vue({
			    el: '#app'			    
			})

		</script>
		<style>
			.active {
				background-color: #f4e542;
				position: relative;
			}					
			.inactive {
				background-color: #c4c0c0;	
			}						
			.tickmark {
				/*background-color: green;*/
				color: green;
				/*padding: 5px;*/
			}
			.crossmark {
				/*background-color: red;*/
				/*padding: 5px;*/
				color: red;
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
		</style>
	</body>
</html>