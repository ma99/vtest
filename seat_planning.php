<!DOCTYPE html>
<html>
	<head>
		<title>Seat Planning</title>
		<!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	</head>
	<body>
		<div id="app"> 			
			<seat-planning> </seat-planning>	
		</div>
		
		<template id="test-template">
			<div>
				<button 
					v-bind:class="{ active : seat.checked, inactive : !seat.checked  }"
					v-for="seat in seatList" 					
					@click="toggle(seat)"																
				> 											
					<i class="fa fa-check fa-lg tickmark" v-show="seat.checked"></i>
					<i class="fa fa-times fa-lg crossmark" aria-hidden="true" v-show="!seat.checked"></i>

					{{ seat.no }} - {{ seat.sts }}

				</button>		
				<!-- {{ seatStatus(seat.sts) }} -->
		    	<!-- <span  v-show="seat.checked">Toggle info</span> -->
		    	<br>
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
						    seatList: []
						}

				},
				created: function(){
					this.createList();					
				},		
				methods: {
					createList: function(){
						var r; //row					
						var code = 64;
						var numberOfRow = 4;
						var numberOfCol = 3;
						for ( r=1; r<numberOfRow; r++ ){
							console.log('row=', r);
							var c; //col
							for( c=1; c<numberOfCol; c++){
								var seatNo = String.fromCharCode(code+r)+ c ;
								// console.log('col=', c);
								// console.log('seat=', seatNo); 
								this.seatList.push({
									no: seatNo,
									sts: 'available', 
									checked: true
								});
							}
						}
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
				/*width: 100px;*/
				height: 50px;
				margin-right: 10px;
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
		</style>
	</body>
</html>