<!DOCTYPE html>
<html>
	<head>
		<title>Seat Planning</title>
	</head>
	<body>
		<div id="app"> 
			<!-- <seat-display v-for="seat in seats" v-bind:seat="seat"></seat-display> -->
			<seat-display> </seat-display>	
			
			<!-- <pre> {{ $data | json }}</pre> -->

		</div>
		
		<template id="test-template">
			<div>
				<button 
					v-bind:class="{ active : seat.checked, inactive : !seat.checked  }"
					v-for="seat in seatList" 					
					@click="toggle(seat)"						
					:disabled="isDisabledSeatSelection(seat.sts)"					
				> 				    	
					{{ seat.no }} - {{ seat.sts }}
				</button>			
			
				<!-- {{ seatStatus(seat.sts) }} -->
		    	<!-- <span  v-show="seat.checked">Toggle info</span> -->
		    	<br>
		    	{{ seatList }}
			</div>	
		</template>

		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
		
		
		<script>
			Vue.component('seat-display', {
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
						for ( r=1; r<4; r++ ){
							console.log('row=', r);
							var c; //col
							for( c=1; c<3; c++){
								var seatNo = String.fromCharCode(code+r)+ c ;
								// console.log('col=', c);
								// console.log('seat=', seatNo); 
								this.seatList.push({
									no: seatNo,
									sts: 'available', 
									checked:true
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
			}			
			.inactive {
				background-color: #c4c0c0;	
			}			
			#app button {
				width: 100px;
				height: 50px;
				margin-right: 10px;
			}
		</style>
	</body>
</html>