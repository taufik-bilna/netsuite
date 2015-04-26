{% for columnName, column in grid.getColumns() %}
    <td>
    	{% if column['output_action'] is defined %}
            {{ column['output_action'](item, grid.getDI()) }}
        {% else %}
            {{ item[columnName] }}
        {% endif %}
    </td>
{% endfor %}
