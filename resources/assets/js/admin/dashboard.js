(function(){
	'use strict';

	HXXSTORE.admin.dashboard=function(){
		charts();
	}

	function charts(){

		var revenue = $('#revenue');
		var order = $('#order');

		// var revenue = document.getElementById('revenue');

		// const revenue = document.querySelector('#revenue');

		var orderLabels = [];
		var revenueLabels=[];
		var orderData=[];
		var revenueData=[];

		axios.get('/02/public/admin/charts').then(function(response){
			response.data.orders.forEach(function(monthly){

				orderData.push(monthly.count);
				orderLabels.push(monthly.new_date);
			});

			response.data.revenues.forEach(function(monthly){

				revenueData.push(monthly.amount);
				revenueLabels.push(monthly.new_date);
			});
		});

		new Chart(revenue,{
			type:'bar',
			data:{
				labels:revenueLabels,
				datasets:[
					{
						label:'# Revenue',
						data:revenueData
					}
				]
			}
		});

		new Chart(order,{
			type:'line',
			data:{
				labels:orderLabels,
				datasets:[
					{
						label:'# Order',
						data:orderData
					}
				]
			}
		});

	}
})();