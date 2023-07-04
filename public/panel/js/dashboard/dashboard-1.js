(function($) {
    /* "use strict" */


 var dlabChartlist = function(){
	//let draw = Chart.controllers.line.__super__.draw; //draw shadow
	var screenWidth = $(window).width();
	
	var donutChart1 = function(){
		$("span.donut1").peity("donut", {
			width: "50",
			height: "50"
		});
	}
	var chartTimeline = function(){
		var optionsTimeline = {
			chart: {
				type: "bar",
				height: 320,
				stacked: true,
				toolbar: {
					show: false
				},
				sparkline: {
					//enabled: true
				},
				backgroundBarRadius: 5,
				offsetX: 0,
			},
			series: [
				 {
					name: "New Clients",
					data: [70, 20, 75, 20, 50, 40, 65, 15, 40, 55, 60, 20, 75, 40]
				},
				{
					name: "Retained Clients",
					data: [-60, -10, -50, -25, -30, -65, -22, -10, -50, -20, -70, -35, -60, -20]
				} 
			],
			
			plotOptions: {
				bar: {
					columnWidth: "30%",
					endingShape: "rounded",
					colors: {
						backgroundBarColors: ['#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4'],
						backgroundBarOpacity: 1,
						backgroundBarRadius: 5,
						opacity:0
					},

				},
				distributed: true
			},
			colors:['#2953E8', '#09268A'],
			
			grid: {
				show: false,
			},
			legend: {
				show: false
			},
			fill: {
				opacity: 1
			},
			dataLabels: {
				enabled: false,
				colors:['#2953E8', '#09268A'],
				dropShadow: {
					enabled: true,
					top: 1,
					left: 1,
					blur: 1,
					opacity: 1
				}
			},
			xaxis: {
				categories: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14'],
				labels: {
					style: {
						colors: '#787878',
						fontSize: '13px',
						fontFamily: 'Poppins',
						fontWeight: 400
						
					},
				},
				crosshairs: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
			},
			
			yaxis: {
				//show: false
				labels: {
					offsetX:-15,
					style: {
						colors: '#787878',
						fontSize: '13px',
						fontFamily: 'Poppins',
						fontWeight: 400
						
					},
				},
			},
			
			tooltip: {
				x: {
					show: true
				}
			}
		};
		var chartTimelineRender =  new ApexCharts(document.querySelector("#chartTimeline"), optionsTimeline);
		 chartTimelineRender.render();
	}
	var chartTimeline2 = function(){
		var optionsTimeline = {
			chart: {
				type: "bar",
				height: 320,
				stacked: true,
				toolbar: {
					show: false
				},
				sparkline: {
					//enabled: true
				},
				backgroundBarRadius: 5,
				offsetX: 0,
			},
			series: [
				 {
					name: "New Clients",
					data: [50, 30, 75, 20, 50, 40, 65, 15, 50, 55, 60, 20, 75, 40]
				},
				{
					name: "Retained Clients",
					data: [-60, -10, -30, -25, -30, -45, -72, -10, -50, -20, -70, -35, -60, -20]
				} 
			],
			
			plotOptions: {
				bar: {
					columnWidth: "30%",
					endingShape: "rounded",
					colors: {
						backgroundBarColors: ['#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4'],
						backgroundBarOpacity: 1,
						backgroundBarRadius: 5,
						opacity:0
					},

				},
				distributed: true
			},
			colors:['#2953E8', '#09268A'],
			
			grid: {
				show: false,
			},
			legend: {
				show: false
			},
			fill: {
				opacity: 1
			},
			dataLabels: {
				enabled: false,
				colors:['#2953E8', '#09268A'],
				dropShadow: {
					enabled: true,
					top: 1,
					left: 1,
					blur: 1,
					opacity: 1
				}
			},
			xaxis: {
				categories: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14'],
				labels: {
					style: {
						colors: '#787878',
						fontSize: '13px',
						fontFamily: 'Poppins',
						fontWeight: 400
						
					},
				},
				crosshairs: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
			},
			
			yaxis: {
				//show: false
				labels: {
					offsetX:-15,
					style: {
						colors: '#787878',
						fontSize: '13px',
						fontFamily: 'Poppins',
						fontWeight: 400
						
					},
				},
			},
			
			tooltip: {
				x: {
					show: true
				}
			}
		};
		var chartTimelineRender =  new ApexCharts(document.querySelector("#chartTimeline2"), optionsTimeline);
		 chartTimelineRender.render();
	}
	var chartTimeline3 = function(){
		var optionsTimeline = {
			chart: {
				type: "bar",
				height: 320,
				stacked: true,
				toolbar: {
					show: false
				},
				sparkline: {
					//enabled: true
				},
				backgroundBarRadius: 5,
				offsetX: 0,
			},
			series: [
				 {
					name: "New Clients",
					data: [10, 50, 65, 20, 30, 60, 35, 35, 70, 55, 20, 10, 55, 20]
				},
				{
					name: "Retained Clients",
					data: [-40, -60, -90, -25, -40, -45, -22, -20, -40, -30, -56, -35, -60, -20]
				} 
			],
			
			plotOptions: {
				bar: {
					columnWidth: "30%",
					endingShape: "rounded",
					colors: {
						backgroundBarColors: ['#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4', '#F4F4F4'],
						backgroundBarOpacity: 1,
						backgroundBarRadius: 5,
						opacity:0
					},

				},
				distributed: true
			},
			colors:['#2953E8', '#09268A'],
			
			grid: {
				show: false,
			},
			legend: {
				show: false
			},
			fill: {
				opacity: 1
			},
			dataLabels: {
				enabled: false,
				colors:['#2953E8', '#09268A'],
				dropShadow: {
					enabled: true,
					top: 1,
					left: 1,
					blur: 1,
					opacity: 1
				}
			},
			x: {
				categories: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14'],
				labels: {
					style: {
						colors: '#787878',
						fontSize: '13px',
						fontFamily: 'Poppins',
						fontWeight: 400
						
					},
				},
				crosshairs: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
			},
			
			y: {
				//show: false
				labels: {
					offsetX:-15,
					style: {
						colors: '#787878',
						fontSize: '13px',
						fontFamily: 'Poppins',
						fontWeight: 400
						
					},
				},
			},
			
			tooltip: {
				x: {
					show: true
				}
			}
		};
		var chartTimelineRender =  new ApexCharts(document.querySelector("#chartTimeline3"), optionsTimeline);
		 chartTimelineRender.render();
	}
	var radialChart = function(){
		 var options = {
          series: [75],
          chart: {
          height: 300,
          type: 'radialBar',
          toolbar: {
            show: false
          }
        },
        plotOptions: {
          radialBar: {
             hollow: {
              margin: 0,
              size: '70%',
              background: '#fff',
              image: undefined,
              imageOffsetX: 0,
              imageOffsetY: 0,
              position: 'front',
            },
            track: {
              background: '#F8F8F8',
              strokeWidth: '67%',
              margin: 0, // margin is in pixels
            },
        
            dataLabels: {
              show: true,
              value: {
				offsetY:-7,
                color: '#111',
                fontSize: '20px',
                show: true,
              }
            }
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            type: 'horizontal',
            shadeIntensity: 0.1,
            gradientToColors: ['var(--primary)'],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100]
          }
        },
        stroke: {
        },
        labels: [''],
        };

        var chart = new ApexCharts(document.querySelector("#radialChart"), options);
        chart.render();
	}
	var areaChart1 = function(){	
		//basic area chart
		if(jQuery('#areaChart_1').length > 0 ){
			const areaChart_1 = document.getElementById("areaChart_1").getContext('2d');
    
			areaChart_1.height = 100;

			new Chart(areaChart_1, {
				type: 'line',
				data: {
					defaultFontFamily: 'Poppins',
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [
						{
							label: "Donation",
							data: donationData,
							borderColor: 'rgba(0, 0, 1128, .3)',
							borderWidth: "1",
							backgroundColor: 'rgba(41, 83, 232, 1)', 
							pointBackgroundColor: 'rgba(41, 83, 232, 1)',
							tension: 0.5,
						}
					]
				},
				options: {
					plugins:{
							legend: false, 
					},
				
					scales: {
						y: {
							ticks: {
								beginAtZero: true, 
								max: 100, 
								min: 0, 
								stepSize: 20, 
								padding: 10
							}
						},
						x: { 
							ticks: {
								padding: 5
							}
						}
					}
				}
			});
		}
	}
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				chartTimeline();
				chartTimeline2();
				chartTimeline3();
				donutChart1();
				radialChart();
				areaChart1();
			},
			
			resize:function(){
				
			}
		}
	
	}();

	jQuery(document).ready(function(){
	});
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000); 
		
	});

	jQuery(window).on('resize',function(){
		
		
	});     

})(jQuery);