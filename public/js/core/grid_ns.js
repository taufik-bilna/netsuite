(function (window, $, root, undefined) {
	root.ns(
        'BilnaNs.widget.grid',
        {
	    	options: {
                useSession: true,
                params: {
                    page: 'page',
                    sort: 'sort',
                    direction: 'direction',
                    filter: 'filter',
                    data: 'data'
                },
                css: {
                    paginator: '.pagination',
                    sortable: '.grid-sortable',
                    actionLinks: '.actions a',
                    actionDelete: '.actions .grid-action-delete',

                    filterForm: '.grid-filter',
                    filterButton: '.btn-filter',
                    filterInputs: 'input, select',
                    filterClearInput: '.clear-filter',
                    filterResetAll: '.btn-warning'
                }
            },
            element: null,
            
            /**
             * Init grid.
             *
             * @param element Grid element.
             * @param options Grid options.
             */
            init: function (element, options) {
                this.element = element;
                this.options = $.extend(this.options, options);

                this.initPaginator();
                this.initFilter();
                this.initSorting();
                this.initSession();
            },
            
            /**
             * Init grid paginator.
             */
            initPaginator: function () {
                var $this = this,
                    paginator = $(this.options.css.paginator, this.element.parent());
                if (!paginator.length) {
                    return;
                }

                $('a', paginator).click(function () {
                    var link = $(this);
                    if (link.parent().hasClass('active')) {
                        return false;
                    }

                    $this.setParam('page', link.data('page'));
                    $this.load();

                    return false;
                });
            },
            
            /**
             * Init filter form.
             */
            initFilter: function () {
                var filter = $(this.options.css.filterForm, this.element),
                    $this = this,
                    collectData = function () {
                        var map = {};
                        var x = [];
                        $($this.options.css.filterInputs).each(function () {
                            var value = $(this).val();
                            if (value) {
                                if(typeof $(this).attr("data-between") !== 'undefined'){
                                    //map[$(this).attr("name")] = {};
                                    //map[$(this).attr("name")][$(this).attr("data-between")] = value;
                                    //between = $(this).attr("data-between");
                                    var between = {};
                                    
                                    between[$(this).attr("data-between")] = value;
                                    //x[$(this).attr("name")] = between;
                                    x.push(between);
console.log('xxxxx');
                                    map[$(this).attr("name")] = x;
                                }else{
console.log('cdcdcdcdcd');
                                    map[$(this).attr("name")] = value;
                                }
                            }
//console.log(map);                            
                        });
                        return map;
                    };

                if (!filter.length) {
                    return;
                }

                filter.show();
                $(this.options.css.filterInputs, filter).change(function () {
                    $(this).parent().find($this.options.css.filterClearInput).show();
                });

                // Clear button near each input.
                $(this.options.css.filterClearInput, filter).click(function () {
                    $(this).hide().parent().find($this.options.css.filterInputs).val('');

                    var data = collectData();
                    if ($.isEmptyObject(data)) {
                        data = null;
                    }

                    $this.setParam('filter', data)
                    $this.load();
                });

                // Trigger enter key for inputs.
                $(this.options.css.filterInputs, filter).keyup(function (e) {
                    var data = collectData();
                    if (e.keyCode == 13 && !$.isEmptyObject(data)) {
                        $this.setParam('filter', data);
                        $this.load();
                    }
                });

                // Clear button for all (Reset All).
                $(this.options.css.filterResetAll, filter).click(function () {
                    var data = collectData();
                    $($this.options.css.filterInputs, filter).val('');
                    $($this.options.css.filterClearInput, filter).hide();

                    if (!$.isEmptyObject(data)) {
                        $this.setParam('filter', {});
                        $this.load();
                    }
                });

                // Filter Button.
                $(this.options.css.filterButton, filter).click(function () {
                    var data = collectData();
                    if (!$.isEmptyObject(data)) {
                        $this.setParam('filter', data);
                        $this.load();
                    }
                });
            },
            
            /**
             * Ini sorting via header column links.
             */
            initSorting: function () {
                var $this = this;

                $(this.options.css.sortable, this.element).click(function () {
                    var link = $(this),
                        direction = link.data('direction');

                    // Clear other direction attributes.
                    $($this.options.css.sortable, $this.element).attr('data-direction', null);

                    // Find out direction.
                    if (!direction || direction == 'ASC') {
                        direction = 'DESC';
                    }
                    else {
                        direction = 'ASC';
                    }

                    // Set data about direction to link.
                    link.attr('data-direction', direction); // Update attribute for css changes.
                    link.data('direction', direction);

                    $this.setParam('sort', link.data('sort'));
                    $this.setParam('direction', direction);
                    $this.load();
                });
            },
            
            /**
             * Init grid session.
             * This will allow to store data into cookies and load it if user used actions links.
             */
            initSession: function () {
                // Init some additional actions.
                $(this.options.css.actionDelete, this.element).click(function (e) {
                    return confirm('Do you really want to delete this item?');
                });

                if (!this.options.useSession) {
                    return;
                }

                var $this = this;

                // Setup events.
                $(this.options.css.actionLinks, this.element).click(function () {
                    $.cookie($this.element.attr('id'), JSON.stringify($this.getParams()), {path: window.location.pathname});
                });

                // If there is cookies - load params and remove cookie.
                var data = $.cookie($this.element.attr('id'));
//console.log(data);                
                if (data) {
                    data = JSON.parse(data);
                    $.removeCookie($this.element.attr('id'), {path: window.location.pathname});
                    $.each(data, function (name, value) {
                        // Try to set filters values.
                        if (name == 'filter' && value) {
                            $.each(value, function (fk, fv) {
                                $('[name="' + fk + '"]', $this.element).val(fv);
                            })
                        }
//console.log(name);
                        $this.setParam(name, value);
                    });


                    // Set sorting.
                    if (data.sort && data.direction) {
                        $(this.options.css.sortable + '[data-sort="' + data.sort + '"]', this.element).attr('data-direction', data.direction);
                    }

                    $this.load();
                }
            },
            
            /**
             * Set grid data.
             *
             * @param name  Data naming.
             * @param value Data value.
             */
            setParam: function (name, value) {
                if (!$.contains(this.options.params, name)) {
                    this.options.params[name] = name;
                }
/*console.log(name);
console.log(value);*/
                this.element.data(name, value);
//console.log(this.element.data);                
            },

            /**
             * Get grid data.
             *
             * @param name Data naming.
             */
            getParam: function (name) {
                return this.element.data(name);
            },

            /**
             * Get current params.
             *
             * @return Object
             */
            getParams: function () {
                var params = {},
                    $this = this;

                $.each(this.options.params, function (name) {
//console.log(name);
                    var value = $this.getParam(name);
                    if (value) {
                        params[name] = window.btoa(JSON.stringify(value));
                    }
                });
//console.log(name);
//console.log(params['filter']);
                return params;
            },
            
            /**
             * Load grid.
             */
            load: function () {
                var params = $.extend(BilnaNs.helper.getUrlParams(), this.getParams()),
                    $element = this.element;

                // Show loading stage.
                BilnaNs.core.showLoadingStage();
//console.log(params);

                // Request.
                $.ajax(
                    {
                        url: window.location.pathname,
                        data: params
                    }
                ).done(
                    function (html) {
                        $('tbody', $element).replaceWith(html);

                        BilnaNs.widget.grid.initPaginator();
                        BilnaNs.widget.grid.initSession();

                        BilnaNs.core.hideLoadingStage();
                    }
                );
            }
            
               
        }
   );
}(window, jQuery, BilnaNs));