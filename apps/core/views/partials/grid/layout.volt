<table id="bdhsbdhbhsfbds" class="table grid-table" data-widget="grid">
    <thead>
    <tr>
        {% for name, column in grid.getColumns() %}
        	{{ column['label'] }}
        {% endfor %}
    </tr>
    {% if grid.hasFilterForm() %}
        <tr class="grid-filter">
            {% for column in grid.getColumns() %}
            	<th>
            		{% set element = column['filter'] %}
                    {{ element.setAttribute('autocomplete', 'off').render() }}
            	</th>
            {% endfor %}
    {% endif %}
    </thead>
	{{ partial(grid.getTableBodyView(), ['grid': grid]) }}
</table>