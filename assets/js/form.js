jQuery(function($)
{

    if($.fn.characterCounter)
    {
        $('.input-counter').characterCounter();
    }

    // Input url
    $('input[type=url]').each(function()
    {
        var input = $(this);
        input.blur(function()
        {
            var oldvalue = input.val();
            if(oldvalue != '' && !oldvalue.match(/^https?:\/\//))
            {
                input.val('http://' + oldvalue);
            }
        });
    });

    // Toggle html/fields
    $('form :input[data-show-key]').each(function()
    {
        var input = $(this);
        init_toggle(input, input.parents('.input-field'), input.parents('form'));
    });

    $('form [data-show-key]:not(:input)').each(function()
    {
        var elt = $(this);
        init_toggle(elt, elt, elt.parents('form'));
    });


    function init_toggle(elt, elt_cont, cont)
    {

        var show_key = elt.data('show-key');
        var show_value = elt.data('show-value');

        var input_trigger_name = cont.attr('name') + '[' + show_key + ']';
        var input_trigger = cont.find('[name="' + input_trigger_name + '"]');
        if(input_trigger.length == 0)
        {
            input_trigger_name = show_key;
            input_trigger = cont.find('[name="' + input_trigger_name + '"]');
        }

        // Abort
        if(input_trigger.length == 0) return;

        if(input_trigger.is(':radio'))
        {
            input_trigger.change(function()
            {
                var value = cont.find('[name="' + input_trigger_name + '"]:checked').val();
                elt_cont.toggle(value == show_value);
            }).triggerHandler('change');
        }
        else
        {
            input_trigger.change(function()
            {
                var value = input_trigger.val();
                elt_cont.toggle(value == show_value);
            }).triggerHandler('change');
        }
    }

    // COllection field
    $('.collection-field').each(function()
    {
        var container = $(this);
        var prototype = container.data('prototype');

        var modal_edit_title = container.data('modal-edit-title');
        var modal_edit_confirm = container.data('modal-edit-confirm');
        var modal_add_title = container.data('modal-add-title');
        var modal_add_confirm = container.data('modal-add-confirm');
        var modal_abort = container.data('modal-abort');

        var $children = container.find('.widget_children');
        var $widget_rows = container.find('.widget_rows');
        var widget_template = container.find('.widget_template');
        var max_id = $children.find('>*').length;

        var btn_add = container.find('.btn-add');

        var modal_edit = $('<form class="modal modal-fixed-footer"><div class="modal-content"><h4>' + modal_edit_title + '</h4><div class="modal-body"></div></div><div class="modal-footer"><button type="submit" class="btn">' + modal_edit_confirm + '</button><a href="#" class="modal-action modal-close btn-flat">' + modal_abort + '</a></div></form>');
        var modal_add = $('<form class="modal modal-fixed-footer"><div class="modal-content"><h4>' + modal_add_title + '</h4><div class="modal-body"></div></div><div class="modal-footer"><button type="submit" class="btn">' + modal_add_confirm + '</button><a href="#" class="modal-action modal-close btn-flat">' + modal_abort + '</a></div></form>');


        $('body').append(modal_edit);
        $('body').append(modal_add);
        modal_add.modal();
        modal_edit.modal();

        var current_edit_widget;
        var current_add_widget;

        container.on('click', '.btn-edit', function()
        {
            current_edit_widget = $children.find('#' + $(this).parents('.widget_row').attr('id').substr(4));
            modal_edit.find('.modal-body').html(current_edit_widget.clone());
            init_form_components(modal_edit);
            modal_edit.modal('open');
        });

        modal_edit.submit(function()
        {
            modal_edit.find(':input').each(function()
            {
                var input = $(this);
                var dest_input = current_edit_widget.find(":input[name='" + input.attr("name") + "']");
                // Solution moche à un problème chelou sur chrome... Made by Val
                if(dest_input.is('select'))
                {
                    dest_input.find('option:selected').removeAttr('selected');
                    dest_input.find('option[value="' + input.val() + '"]').attr('selected', 'selected');
                }
                else
                {
                    dest_input.val(input.val());
                }
            });

            $widget_rows.find('#row_' + current_edit_widget.attr("id")).html(get_template_row(current_edit_widget).html());

            modal_edit.modal('close');
            modal_edit.find('.modal-body').empty();
            current_edit_widget = null;
            return false;
        });

        container.on('click', '.btn-delete', function()
        {
            if(confirm('sûr ?'))
            {
                $(this).parents('.widget_row').fadeOut(function()
                {
                    $children.find('#' + $(this).attr('id').substr(4)).remove();
                    $(this).remove();
                });
            }
        });

        btn_add.click(function()
        {
            current_add_widget = $(prototype.replace(/__name__/g, max_id));
            modal_add.find('.modal-body').html(current_add_widget.clone());
            init_form_components(modal_add);
            modal_add.modal('open');
        });

        modal_add.submit(function()
        {
            modal_add.find(':input').each(function()
            {
                var input = $(this);
                var dest_input = current_add_widget.find(":input[name='" + input.attr("name") + "']");
                // Solution moche à un problème chelou sur chrome... Made by Val
                if(dest_input.is('select'))
                {
                    dest_input.find('option:selected').removeAttr('selected');
                    dest_input.find('option[value="' + input.val() + '"]').attr('selected', 'selected');
                }
                else
                {
                    dest_input.val(input.val());
                }
            });
            $widget_rows.append(get_template_row(current_add_widget));
            $children.append(current_add_widget);
            modal_add.modal('close');
            modal_add.find('.modal-body').empty();
            max_id++;

            return false;
        });

        function get_template_row(widget)
        {
            var template = widget_template.text();
            widget.find(':input').each(function()
            {
                var input = $(this);
                var id = this.id.substr(this.id.lastIndexOf('_')+1);
                var value = this.value;
                if(input.is('select'))
                {
                    value = input.find(':selected').text();
                }
                template = template.replace('__' + id + '__', value);
            });
            var $template = $(template);
            $template.attr('id', "row_" + widget.attr("id"));
            return $template;
        }

        $children.find('>*').each(function()
        {
            $widget_rows.append(get_template_row($(this)));
        });


        function init_form_components(cont)
        {
            cont.find('select').material_select();

            cont.find('input.datepicker').pickadate({
                format : 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15 // Creates a dropdown of 15 years to control year
            });
        }
    });
});
