<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {# grid.getGridTitle() #}
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <table id="{{ grid.getId() }}" class="table grid-table table-striped table-hover table-bordered" data-widget="grid{# grid.getId() #}">
                        <thead>
                        <tr>
					        {% for name, column in grid.getColumns() %}
					        	<th>
						        	{{ column['label'] }}
					        	</th>
					        {% endfor %}
				    	</tr>
    					</thead>
    					<tfoot>
    						<tr>
    							{% for name, column in grid.getColumns() %}				        	
						        	<th>
							        	{{ column['label'] }}
						        	</th>
					        	{% endfor %}
    						</tr>
    					</tfoot>
					</table>
				</div>
            </div>
        </section>
    </div>
</div>

<script src="assets/data-tables/jquery.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="assets/data-tables/jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>

<script>

	$(document).ready(function() {

          oTable = $('#{{ grid.getId() }}').dataTable( {
              //"aaSorting": [[ 4, "desc" ]],
	          "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
	          "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
              "bProcessing": true,
              "bServerSide": true,
              "sPaginationType": "bootstrap",
              "sAjaxSource": "/{{ grid.getGridUrl() }}"
          } ).columnFilter({ aoColumns: [
          		{% for name, column in grid.getColumns() %}
          			
          			{ type: "{{ column['type'] }}", bRegex:true 
          				{% if column['value'] is defined  %}
          					,values:[
          					{% for key, val in column['value'] %}
          						{value: "{{ val['value'] }}", label: "{{ val['label'] }}" },
          					{% endfor %}
          					]
          				{% endif %}
          			},
          		{% endfor %}
                ]
            });

          $('#{{ grid.getId() }} tfoot tr').insertAfter($('#{{ grid.getId() }} thead tr'));

	});

</script>