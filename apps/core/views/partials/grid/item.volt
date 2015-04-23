{% for columnName, column in grid.getColumns() %}
    <td>
        {{ item[columnName] }}
    </td>
{% endfor %}
