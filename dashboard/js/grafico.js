function drawChart(){
	var data = google.visualization.arrayToDataTable([
		['STATUS', '%'],		
		['Superado', 10],
		['Esperado', 10],
		['Alerta', 5],
		['Crítico', 10],
		['Muito Crítico', 20],
		['Cancelado', 5],
		['Não Monitorado', 10]		
	]);
	var options={	
		is3D:true
	};
	var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}
google.setOnLoadCallback(drawChart);