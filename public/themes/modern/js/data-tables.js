jQuery(document).ready(function () {
	if ( $('#kleper').length) {
		$('#kleper').DataTable();
	}
	
	if ( $('.data-tables').length) {
		$setting = $('#dataTables-setting');
		settings = {};
		if ($setting.length > 0) {
			settings = $.parseJSON($('#dataTables-setting').html());
			
		}
		
		addSettings = 
		{
			"dom":"Bfrtip"
			,"buttons":[
				{"extend":"copy"
					,"text":"<i class='far fa-copy'></i> Copy"
					,"className":"btn-light"
				},
				{"extend":"excel"
					, "title":"Data Mahasisa"
					, "text":"<i class='far fa-file-excel'></i> Excel"
					, "exportOptions": {
					  columns: [2, 3, 4, 5, 6, 7],
					  modifier: {selected: null}
					}
					, "className":"btn-light"
				},
				{"extend":"pdf"
					,"title":"Data Mahasisa"
					,"text":"<i class='far fa-file-pdf'></i> PDF"
					, "exportOptions": {
					  columns: [2, 3, 4, 5, 6, 7],
					  modifier: {selected: null}
					}
					,"className":"btn-light"
				},
				{"extend":"csv"
					,"title":"Data Mahasisa"
					,"text":"<i class='far fa-file-alt'></i> CSV"
					, "exportOptions": {
					  columns: [2, 3, 4, 5, 6, 7],
					  modifier: {selected: null}
					}
					,"className":"btn-light"
				},
				
			]
		}
		
		// Merge settings
		settings = {...settings, ...addSettings};
		$('.data-tables').DataTable(settings);
	}
});