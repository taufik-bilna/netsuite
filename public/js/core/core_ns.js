(function (window, $, undefined) {
	
	var ns = function (path, object, root) {
        var parts = path.split('.')
            , len = parts.length
            , i = 0
            , def = {};

        object || (object = {});
        root || (root = window);

        for (; i < len; i++) {
            if (i == len - 1) {
                def = object;
            }
            root = root[parts[i]] || (root[parts[i]] = def)

        }

        return root;
    };
    
    var BilnaNs = ns('BilnaNs');
    BilnaNs.ns = ns;
    BilnaNs.debug = 1;
    
    BilnaNs.core = {
        /**
         * Show loading image.
         */
        showLoadingStage: function () {
            if ($('#loading_stage').length) {
                return;
            }
            var bg = $('<div id="loading_stage" class="loading_stage"><span></span></div>');
            $(window.document.body).append(bg);
        },

        /**
         * Hide loading image.
         */
        hideLoadingStage: function () {
            if ($('#loading_stage').length) {
                $('.loading_stage').remove();
            }
        }
    };
    
    //////////////////////////
    // Initalization.
    //////////////////////////
    _initWidgets();
    _initHelpers();
    $(function () {
        _initSystem()
    });

	    /**
     * Init helpers handler.
     *
     * @private
     */
    function _initHelpers() {
        var helper = ns('BilnaNs.helper');
        
        /**
         * template
         *
         * util.template("Hello {name}", { name: 'world' });
         *
         * @param template
         * @param params
         * @returns {*}
         */
        helper.template = function (template, params) {
            var item, i;
            for (i in params) {
                item = '{' + i + '}';
                if (params.hasOwnProperty(i) && !!~template.indexOf(item)) {
                    template = template.replace(new RegExp(item, 'g'), params[i])
                }
            }
            return template;
        };

        /**
         * Log message.
         *
         * @param msg
         * @param params
         */
        helper.log = function (msg, params) {
            if (!BilnaNs.debug) {
                return;
            }

            console.error(this.template(msg, params));
        };

		/**
         * Scroll to selector or element.
         *
         * @param el selector|jquery
         */
        helper.scrollTo = function (el) {
            if (!(el instanceof  $))  el = $(el);
            $('html, body').animate({scrollTop: el.offset().top - 50}, 2000);
        };

        /**
         * Get url params.
         * If no param provided - window.location.search will be used.
         *
         * @param url Get params from url.
         * @returns {*}
         */
        helper.getUrlParams = function (url) {
            if (!url) {
                url = window.location.search;
            }

            var re = /([^&=]+)=?([^&]*)/g,
                decode = function (str) {
                    return decodeURIComponent(str.replace(/\+/g, ' '));
                };

            var params = {}, e;
            if (url) {
                if (url.substr(0, 1) == '?') {
                    url = url.substr(1);
                }

                while (e = re.exec(url)) {
                    var k = decode(e[1]);
                    var v = decode(e[2]);
                    if (params[k] !== undefined) {
                        if (!$.isArray(params[k])) {
                            params[k] = [params[k]];
                        }
                        params[k].push(v);
                    } else {
                        params[k] = v;
                    }
                }
            }
            return params;
        }
	}
    
    /**
     * Init widgets system.
     *
     * @private
     */
    function _initWidgets()
    {
    	var widget = ns('BilnaNs.widget');
    	
    	/**
         * Init widgets.
         *
         * @param context
         */
        widget.init = function (context) {
        	/**
             * Look for all widgets.
             */
            $('[data-widget]', context).each(function () {
                var widgets = this.getAttribute('data-widget').split(/\s?,\s?/)
                    , len = widgets.length
                    , widget
                    , data;
console.log(widgets);
console.log(len);
console.log(data);
                for (; len--;) {
                    widget = widgets[len];
                    if (widget.indexOf('invoked') != -1) {
                        continue;
                    }

                    if (!(widget in BilnaNs.widget)) {
                        BilnaNs.helper.log('Widget with name "{name}" not found.', {name: widget});
                        continue;
                    }

                    widget = BilnaNs.widget[widget];
                    if (widget.init) {
                        widget.init($(this));
                        widgets[len] = '(' + widgets[len] + '):invoked';
                    }
                }

                this.setAttribute('data-widget', widgets.join(', '))
            });
        }
    }
    
    /**
     * Init all related systems.
     *
     * @private
     */
    function _initSystem() {
        BilnaNs.widget.init();
        
        /**
         * Init on update.
         */
        $(document).bind("DOMNodeInserted", function (event) {
            BilnaNs.widget.init(event.target);
        });
    }

}(window, jQuery));