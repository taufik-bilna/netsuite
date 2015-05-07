{% for columnName, column in grid.getColumns() %}
    <td>
    	{% if column['output_action'] is defined %}
            {{ column['output_action'](item, grid.getDI(), column) }}
        {% else %}
            {{ item[column['colname']] }}
        {% endif %}
    </td>
{% endfor %}
{% if grid.hasActions() %}
    <td class="actions">
        {% for key, action in grid.getItemActions(item) %}
            <a
                    href="{% if action['href'] is defined %}{{ url(action['href']) }}{% else %}javascript:;{% endif %}"
            
            >
            {{ key }}
            </a>
        {% endfor %}
    </td>
{% endif %}
