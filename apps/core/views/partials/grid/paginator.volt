{% if paginator.total_pages > 1 %}
    {% set startIndex = 1 %}

    {% if paginator.total_pages > 10 %}
        {% if paginator.current > 4 %}            {% set startIndex = startIndex + paginator.current - 4 %}
        {% endif %}
        {% if paginator.total_pages - paginator.current < 10 %}
            {% set startIndex = paginator.total_pages - 9 %}
        {% endif %}
    {% endif %}

    <div class="pagination-container">
        <ul class="pagination">
            {% if paginator.current > 1 %}
                <li>
                    <a href="" data-page="1">{{ 'First' }}</a>
                </li>
                <li>
                    <a href="" data-page="{{ paginator.before }}">&laquo;</a>
                </li>
            {% endif %}

            {% for pageIndex in startIndex..paginator.total_pages %}
                {% if pageIndex is startIndex+10 %}
                    {% break %}
                {% endif %}

                <li {% if pageIndex is paginator.current %}class="active"{% endif %}>
                    <a href="?page={{ pageIndex }}" data-page="{{ pageIndex }}">{{ pageIndex }}</a>
                </li>
            {% endfor %}

            {% if paginator.current < paginator.total_pages %}
                <li>
                    <a href="?page={{ paginator.current + 1 }}" data-page="{{ paginator.current + 1 }}">&raquo;</a>
                </li>
                <li>
                    <a href="?page={{ paginator.last }}" data-page="{{ paginator.last }}">{{ 'Last' }}</a>
                </li>
            {% endif %}
        </ul>
    </div>
{% endif %}