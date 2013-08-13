/* objectSorter by Cyrus Smith (http://coding-contemplation.blogspot.com) (https://github.com/smithcyr)
 * with the structure of the plugin inspired by 
 * http://coding.smashingmagazine.com/2011/10/11/essential-jquery-plugin-patterns/
 * 
 * objectSorter is a jQuery plugin that sorts HTML elements of a specified
 * class by comparing child elements. 
 * 
 * example usage:
 * $('#the_parent_element_id').objectSorter(options);
 * 
 * 
 * @param object options - a json object with valid keys and values listed below
 * 
 * options = {
 *  container: (string) - the class of elements that need to be sorted,
 *  sortby: (object) - a json object with keys and values of the form:
 *          key = (string) - name of class to be sorted by
 *          value = Array(
 *                    (string) - displayed name of sort,
 *                    (int) - type of comparison (1 [for numerical],0 [for alphabetical]),
 *                    (boolean) - whether it should be sortable
 *                  )
 *  perpage: (int) - the number of elements per page (default infinity),
 *  initial_sort: (object) - {
 *                  elclass: (string) - class that contains the value,
 *                  type: (int) - type of comparison (1 [for numerical],0 [for alphabetical]),
 *                  direction: (int) - direction of sort (1 [for ascending],0 [for descending])
 *                }
 * }
 * */
;(function( $ ) {
    
    var defaults = {}, 
        pluginName = 'objectSorter',
        cssDirectory = '/';
    
    function Plugin (el, options) {
        
        var base = this;
        base.options = $.extend({}, defaults, options);
        base.el = el;
        base.$el = $(el);
        
        // Function that handles all sorting operations
        base.sortHandler = function(sort_type, sort_class, direction) {
            var players = base.$el.children('.' + base.options.container).detach();
            players.sort(function(a, b) {
                var A = $(a).find('.' + sort_class).filter(':first').html();
                var B = $(b).find('.' + sort_class).filter(':first').html();
                if (sort_type == 1) {
                    A = Number(A);
                    B = Number(B);
                }
                if (direction)
                    return A > B ? 1 : -1;
                else
                    return A < B ? 1 : -1;
            });
            base.$el.append(players);
        };
        this.init();
    };
    
    Plugin.prototype.init = function () {
            base = this;
            
            // add classes to elements for table display
            this.$el.addClass("objs_table");
            this.$el.children('.' + this.options.container).children().addClass("objs_cell");
            this.$el.children('.' + this.options.container).addClass("objs_row");
            
            // create table headers and bind sorting event to clicks for each respective header
            if ('sortby' in base.options) {
                base.head = $(document.createElement('ul')).addClass("objs_header");
                // create header for each sorting column
                for (var key in base.options.sortby) {
                    var category = $(document.createElement('li'))
                                    .addClass("objs_cell")
                                    .attr("data-key",key)
                                    .attr("scope","col")
                                    .html('<span>' + base.options.sortby[key][0] + '</span>')
                                    .append('<span class="sorting-indicator"></span>');
                    if (base.options.sortby[key][2] === true) 
                      category.addClass("sortable");
                    base.head.append(category);
                }
                // bind on click a customized call to base.sortHandler for each column header
                // using data- attributes to store state
                base.head.delegate('li.sortable','click', function() {
                    var key = $(this).attr("data-key");
                    var container = $(this).parent();
                    var sort = container.attr("data-sort");
                    var datadir = container.attr("data-sortdir");
                    if (sort == key) {
                        if (datadir && datadir == "down") {
                          container.attr("data-sortdir","up");
                          $(this).removeClass("sortdown");
                          $(this).addClass("sortup");
                          var dir = false;
                        } else if (datadir && datadir == "up") {
                          container.attr("data-sortdir","down");
                          $(this).removeClass("sortup");
                          $(this).addClass("sortdown");
                          var dir = true;
                        }
                    } else {
                      if (sort) 
                        container.children('li[data-key|=' + sort + ']')
                                 .removeClass("sortdown sortup");
                      $(this).addClass("sortdown");
                      container.attr('data-sort',key);
                      container.attr('data-sortdir','down');
                      var dir = true;
                    }
                    base.sortHandler( base.options.sortby[key][1], key, dir );
                });
                base.$el.prepend(base.head);
            }
            // run base.sortHandler on initialization if given the option
            if ('initial_sort' in base.options) {
                base.sortHandler(base.options.initial_sort.type, 
                                 base.options.initial_sort.elclass, 
                                 base.options.initial_sort.direction);
            }
      };
    
    // add objectSorter to the jQuery function object
    $.fn[pluginName] = function (options) {
      return this.each( function () {
        if(!$.data(this,'plugin_'+pluginName)) {
           $.data(this,'plugin_'+pluginName,
           new Plugin(this, options));
        }
      });
    };

})( jQuery );
