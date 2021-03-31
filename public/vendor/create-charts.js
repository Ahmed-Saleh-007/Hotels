(function ($) {

    var charts = {
        init: function () {
   
            this.ajaxGetClientCount();
			this.ajaxGetCountryCount();

        },

        ajaxGetClientCount: function () {
            var urlPath = '/get-client-count';
            var request = $.ajax({
                method: 'GET',
                url: urlPath
            });

            request.done(function (response) {
                console.log(response);
				console.log(response.count);
				console.log(response.gender);
				
                charts.createClientPieChart(response);
            });
        },

		ajaxGetCountryCount: function () {
            var urlPath = '/get-country-count';
            var request = $.ajax({
                method: 'GET',
                url: urlPath
            });

            request.done(function (response) {
                console.log(response);
				console.log(response.count);
				console.log(response.gender);
				
                charts.createClientPieChart(response);
            });
        },


		createClientPieChart: function (response) {

		var ctx = document.getElementById(response.id).getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data:{
			datasets: [{
			  
			
			   
			data:response.data,
		   
			backgroundColor:response.colors,
			}],
		
			// These labels appear in the legend and in the tooltips when hovering different arcs
		
			labels:response.labels,
		   
		
		}
		,options:{
				cutoutPercentage:50,
				
			}
		});
	},

        /**
         * Created the Completed Jobs Chart
         */
        createCompletedJobsChart: function (response) {

            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: response.months, // The response got from the ajax request containing all month names in the database
                    datasets: [{
                        label: "Sessions",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 20,
                        pointBorderWidth: 2,
                        data: response.post_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: response.max, // The response got from the ajax request containing max limit for y axis
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }
    };

    charts.init();

})(jQuery);
