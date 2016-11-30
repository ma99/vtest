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
			        		seatNo: '',		        								    
						    seatList: [],
						    lastRowSeatList:[]						    
						}

				},
				created: function(){
					this.createList();					
				},		
				methods: {
					emptySpace: function (seatNo) {
						
						var seatNumber = parseInt(seatNo.match(/\d+/),10);
						if ( this.isFiveCol(seatNo) ) {
							return false; // no need empty space
						}
						return ( (seatNumber % 3) == 0 ) ? true : false;

					},
					isFiveCol: function(seatNo){
						var arr = this.lastRowSeatList;										
						var fiveCol = false;
						arr.forEach(function (item) {							
						   if (seatNo == item ) {
						   	return fiveCol = true ;
						   } 
						});
						return fiveCol; 
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
								if ( r == numberOfRow ) {
									this.lastRowSeatList.push(seatNo);
								}							
							}
						}
						seatNo = String.fromCharCode(code+numberOfRow)+ c ; //64+6 + 5 E5
						this.seatList.push({
									no: seatNo,
									sts: 'available', 
									checked: true
						});	
						this.lastRowSeatList.push(seatNo);

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
			#app button {				
				height: 50px;
				/*margin-right: 10px;*/
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
			#app button.col-xs-2 {
		    width: 16.76666667%;
		}
		</style>
	</body>
</html>