"use strict";

(function (_, _utils, _is) {
  function getMetaboxConfig(id) {
    if (!!window.FOOBAR_TYPES && _is.object(FOOBAR_TYPES) && FOOBAR_TYPES.hasOwnProperty(id)) {
      return FOOBAR_TYPES[id];
    }

    return {};
  }

  _utils.ready(function ($) {
    var metabox_id = 'foobar_notification-settings',
        config = getMetaboxConfig(metabox_id),
        types = Object.keys(config); //On notification edit/add pages, when the bar type change, store the type

    $('#foobar_notification-types_type-field input:radio').change(function (e) {
      e.preventDefault();
      var selected_type = $(this).val();

      if (types.indexOf(selected_type) !== -1) {
        // we have a valid type
        var selected_config = config[selected_type];

        if (_is.object(selected_config) && _is.string(selected_config['container'])) {
          var container = FooFields.container(selected_config['container']);

          if (container instanceof FooFields.Container) {
            // first set the defaults for the selected type
            var defaults = selected_config['defaults'];

            if (_is.object(defaults)) {
              Object.keys(defaults).forEach(function (key) {
                var field = container.field(key);

                if (field instanceof FooFields.Field) {
                  field.val(defaults[key]);
                }
              });
            } // next iterate over each type and toggle its visibility


            types.forEach(function (type) {
              var content_id = config[type]['content'];

              if (_is.string(content_id)) {
                var is_selected = type === selected_type;
                container.toggle(content_id, is_selected);

                if (is_selected) {
                  container.activate(content_id);
                }
              }
            });
          }
        }
      }

      $('#foobar_notification-settings').show();
    }); //when a foobar shortcode is clicked on

    $('.foobar-shortcode').click(function () {
      try {
        //select the contents
        this.select(); //copy the selection

        document.execCommand('copy'); //show the copied message

        $(this).siblings('.foobar-shortcode-message').show();
      } catch (err) {
        // eslint-disable-next-line no-console
        console.log('Oops, unable to copy!');
      }
    }); //when a foobar preview link is clicked

    $('.foobar-admin-preview').click(function (e) {
      e.preventDefault();
      var $this = $(this),
          $row = $this.parents('tr:first'),
          foobarId = $this.data('foobar-id'),
          foobarUId = $this.data('foobar-uid'),
          data = {
        'action': 'foobar_admin_preview',
        'id': foobarId,
        '_wpnonce': $this.data('foobar-preview-nonce'),
        '_wp_http_referer': encodeURIComponent($('input[name="_wp_http_referer"]').val())
      };
      $row.addClass("foobar-preview-loading"); //do a postback to get the bar content

      $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: data,
        cache: false,
        success: function success(html) {
          // dismiss all existing bars - dismissing is more extreme than destroy;
          // destroy leaves markup in place
          // dismiss removes everything from the page
          FooBar.dismissAll(true); //append the bar content to end of body

          $('body').append(html); //init the bar

          var bar = FooBar.create(foobarUId);

          if (bar instanceof FooBar.Bar) {
            bar.init();
          }
        }
      }).always(function () {
        $row.removeClass("foobar-preview-loading");
      });
    });
  }); // eslint-disable-next-line no-undef

})(FooBar, FooBar.utils, FooBar.utils.is);
/**
 * @typedef {Object} FOOBAR_TYPES
 * @property {string} tab
 * @property {string} content
 * @property {Object<string, string>[]} defaults
 */
"use strict";

(function ($, _, _f, _utils, _is) {
  _.IconPicker = _.Field.extend({
    construct: function construct(content, element, options, classes, i18n) {
      var self = this;

      self._super(content, element, options, classes, i18n);

      self.$doc = $(document);
      self.initial = self.$value.val();
      self.hasDefault = !_is.empty(self.opt.default);
      self.$container = $('<div/>', {
        'class': self.cls.container
      });
      self.containerElement = self.$container.get(0);
      self.$button = $('<button/>', {
        'class': 'button ' + self.cls.button,
        type: 'button'
      });
      self.$clear = $('<button/>', {
        'class': 'button button-small ' + self.cls.clear,
        type: 'button',
        text: self.hasDefault ? self.i18n.default : self.i18n.clear
      });
      self.$icon = $('<span/>', {
        'class': self.cls.icon
      });
      self.$text = $('<span/>', {
        'class': self.cls.text,
        text: self.i18n.select
      });
      self.$list = $('<div/>', {
        'class': self.cls.list
      });
      self.$selected = $();
      self.icons = _f.icons.all();
    },
    setup: function setup() {
      var self = this;

      if (!_is.empty(self.icons)) {
        self.$container.append(self.$button.append(self.$icon, self.$text), self.$clear, self.$list.append(self.createItems()));
        self.$button.on('click', {
          self: self
        }, self.onButtonClick);
        self.$clear.on('click', {
          self: self
        }, self.onClearClick);
        self.$list.on('click', self.sel.item, {
          self: self
        }, self.onItemClick);
        self.$value.addClass(self.cls.hidden).after(self.$container);
        self.val(self.$value.val());
      }
    },
    createItems: function createItems() {
      var self = this;
      return Object.keys(self.icons).map(function (name) {
        return $('<button/>', {
          'class': self.cls.item,
          'title': name,
          type: 'button'
        }).append(self.icons[name].cloneNode(true));
      });
    },
    teardown: function teardown() {},
    val: function val(value) {
      var self = this;

      if (_is.undef(value)) {
        return self.$value.val();
      }

      var oldValue = self.$value.val();
      var newValue = '';

      if (_is.string(value) && self.icons.hasOwnProperty(value)) {
        newValue = value;
        self.$selected = self.$list.find('[title="' + newValue + '"]');
        self.$value.val(newValue);
        self.$icon.empty().append(self.icons[newValue].cloneNode(true));
      } else {
        self.$selected = $();
        self.$value.val(newValue);
        self.$icon.empty();
      }

      self.$list.find(self.sel.selected).removeClass(self.cls.selected);
      self.$selected.addClass(self.cls.selected);

      if (oldValue !== newValue) {
        self.doValueChanged();
      }
    },
    toggleDropdown: function toggleDropdown(state) {
      var self = this;
      self.dropdownVisible = _is.boolean(state) ? state : !self.dropdownVisible;

      if (self.dropdownVisible) {
        self.$container.addClass(self.cls.visible);
        var list = self.$list.get(0);

        if (self.$selected.length !== 0) {
          var selectedElement =
          /** @type {HTMLElement}  */
          self.$selected.get(0);
          list.scrollTo(0, selectedElement.offsetTop);
        } else {
          list.scrollTo(0, 0);
        }

        self.$doc.on('click', {
          self: self
        }, self.onDocumentClick);
      } else {
        self.$doc.off('click', self.onDocumentClick);
        self.$container.removeClass(self.cls.visible);
      }
    },
    onDocumentClick: function onDocumentClick(e) {
      var self = e.data.self;

      if (!$.contains(self.containerElement, e.target)) {
        self.toggleDropdown(false);
      }
    },
    onButtonClick: function onButtonClick(e) {
      e.preventDefault();
      var self = e.data.self;
      self.toggleDropdown();
    },
    onClearClick: function onClearClick(e) {
      e.preventDefault();
      var self = e.data.self;
      self.val(self.hasDefault ? self.opt.default : '');
    },
    onItemClick: function onItemClick(e) {
      var self = e.data.self;
      self.val(this.title); //self.toggleDropdown(false);
    }
  });

  _.fields.register('icon-picker', _.IconPicker, '.foofields-type-icon-picker', {
    default: null
  }, {
    container: 'fip-container',
    button: 'fip-button',
    clear: 'fip-clear',
    icon: 'fip-icon',
    text: 'fip-text',
    list: 'fip-list',
    item: 'fip-item',
    hidden: 'fip-hidden',
    visible: 'fip-visible',
    selected: 'fip-selected',
    sr: 'fip-sr'
  }, {
    select: 'Select Icon',
    clear: 'Clear',
    default: 'Default'
  });
})(FooFields.$, FooFields, FooBar, FooFields.utils, FooFields.utils.is);