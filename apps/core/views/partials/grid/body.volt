<tbody data-url="{{ grid.getUrl() }}">
{% if grid %}
	{% for item in grid.getItems() %}
        <tr>
            {{ partial(grid.getItemView(), ['grid': grid, 'item': item]) }}
        </tr>
    {% endfor %}
    <tr>
        <td colspan="{{ (grid.getColumns() | length) + 1 }}">
            {{ partial(grid.getPaginatorView(), ['grid': grid]) }}
        </td>
    </tr>
{% else %}
	<tr>
        <td class="grid-no-items" colspan="{{ (grid.getColumns() | length) + 1 }}">
            {{ 'No items' }}
        </td>
    </tr>
{% endif %}
</tbody>