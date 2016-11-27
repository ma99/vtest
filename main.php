<!DOCTYPE html>
<html>
	<head>
		<title>Seat Planning Component Based</title>
	</head>
	<body>
		<div id="app"> 
			<seat-planning> </seat-planning>
		</div>
		
		<template id="test-template">
			<div>
				<input type="checkbox" id="checkbox" v-model="checked">
				<label for="checkbox">{{ checked }}</label>	

				<input type="checkbox" id="a1" value="A1" v-model="checkedNames">
				<label for="A1">A1</label>
				<input type="checkbox" id="a2" value="A2" v-model="checkedNames">
				<label for="a2">A2</label>
				<input type="checkbox" id="b1" value="B1" v-model="checkedNames">
				<label for="b1">B1</label>
				<input type="checkbox" id="b2" value="B2" v-model="checkedNames">
				<label for="b2">B2</label>
				<br>
				<span>Checked names: {{ checkedNames }}</span>
				
				
			</div>	
		</template>

		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
		
		
		<script>
			Vue.component('seat-planning', {
				template: '#test-template',	
				data: function(){
					return {
						checked: false,	
						checkedNames: []					
					}
				},
				created: function(){
					var r; //row					
					var code = 64;
					for ( r=1; r<5; r++ ){
						console.log('row=', r);
						var c; //col
						for( c=1; c<5; c++){
							var seatNo = String.fromCharCode(code+r)+ c ;
							console.log('col=', c);
							console.log('seat=', seatNo); 
							this.checkedNames.push(seatNo);
						}
					}

					/*while (i<3){
						console.log('i=', i);
						var j = 1;
						 while (j<5) {
							var seatNo = String.fromCharCode(code+i)+ j ;
							//this.checkedNames.push()
							
							console.log('j=', j);
							console.log('seat=', seatNo); 
							j++;	
						 }
						
						i++;
					}*/
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