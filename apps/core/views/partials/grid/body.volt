<tbody>
{% if grid %}
	{% for item in grid.getItems() %}
        <tr>
            {{ partial(grid.getItemView(), ['grid': grid, 'item': item]) }}
        </tr>
    {% endfor %}
{% else %}
	{# partial(grid.getPaginatorView(), ['grid': grid]) #}
{% endif %}
</tbody>