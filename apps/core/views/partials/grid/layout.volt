<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{ grid.getGridTitle() }}
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                	<div class="dataTables_info" id="example_info">Total {{ grid.getTotalCount() }} records found</div>
                    <table class="table grid-table table-striped table-hover table-bordered" id="editable-sample" data-widget="grid">
                        <thead>
                        <tr>
					        {% for name, column in grid.getColumns() %}
					        	
					        	<th width="25px">
					        		{% if column['sortable'] is defined %}
					                    <a href="javascript:;" class="grid-sortable" data-sort="{{ name }}" data-direction="">
					                        {{ column['label'] }}
					                    </a>
					                {% else %}
						        		{{ column['label'] }}
									{% endif %}	
					        	</th>
					        {% endfor %}
				        	{% if grid.hasActions() %}
						        <th width="15%" class="actions">{{ 'Actions' }}</th>
						    {% endif %}
				    	</tr>
					    {% if grid.hasFilterForm() %}
					        <tr class="grid-filter">
					            {% for column in grid.getColumns() %}
					            	<th width="25px">
					            		{% set element = column['filter'] %}
					                    {{ element.setAttribute('autocomplete', 'off').render() }}
					            	</th>
					            {% endfor %}
					            	<th class="actions">
						                <button class="btn btn-filter btn-primary">{{ 'Filter' }}</button>
						                <button class="btn btn-warning">{{ 'Reset' }}</button>
						            </th>
					    {% endif %}
    					</thead>
						{{ partial(grid.getTableBodyView(), ['grid': grid]) }}
					</table>
				</div>
            </div>
        </section>
    </div>
</div>