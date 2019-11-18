$(() => {
    var FormsWidget = PhpDebugBar.Widget.extend({

        tagName: 'div', // optional as 'div' is the default

        className: 'formswidget',

        render: function() {
            this.bindAttr('data', this.$el);
        }

    });

    PhpDebugBar.Widgets.FormsWidget = FormsWidget;

});