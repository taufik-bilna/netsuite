<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <!--header class="panel-heading">
                Dynamic Table
            </header-->
            <div class="panel-body">
                <div class="adv-table">
                    <table class="display table table-bordered table-striped" id="example" data-widget="grid">
                        <thead>
                        <tr>
					        {% for name, column in grid.getColumns() %}
					        	<th width="25px">{{ column['label'] }}</th>
					        {% endfor %}
				    	</tr>
					    {% if grid.hasFilterForm() %}
					        <tr class="grid-filter">
					            {% for column in grid.getColumns() %}
					            	<th width="25px">
					            		{% set element = column['filter'] %}
					                    {{ element.setAttribute('autocomplete', 'off').render() }}
					            	</th>
					            {% endfor %}
					    {% endif %}
    					</thead>
						{{ partial(grid.getTableBodyView(), ['grid': grid]) }}
					</table>
				</div>
            </div>
        </section>
    </div>
</div>