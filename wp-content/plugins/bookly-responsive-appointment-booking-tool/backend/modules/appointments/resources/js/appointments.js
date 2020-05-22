jQuery(function($) {

    let
        $appointmentsList   = $('#bookly-appointments-list'),
        $checkAllButton     = $('#bookly-check-all'),
        $idFilter           = $('#bookly-filter-id'),
        $appointmentDateFilter = $('#bookly-filter-date'),
        $creationDateFilter = $('#bookly-filter-creation-date'),
        $staffFilter        = $('#bookly-filter-staff'),
        $customerFilter     = $('#bookly-filter-customer'),
        $serviceFilter      = $('#bookly-filter-service'),
        $statusFilter       = $('#bookly-filter-status'),
        $addButton          = $('#bookly-add'),
        $printDialog        = $('#bookly-print-dialog'),
        $printButton        = $('#bookly-print'),
        $exportDialog       = $('#bookly-export-dialog'),
        $exportForm         = $('form', $exportDialog),
        $deleteButton       = $('#bookly-delete'),
        isMobile            = false,
        urlParts            = document.URL.split('#'),
        columns             = [],
        order               = [],
        pickers = {
            dateFormat:       'YYYY-MM-DD',
            appointmentDate: {
                startDate: moment().startOf('month'),
                endDate  : moment().endOf('month'),
            },
            creationDate: {
                startDate: moment(),
                endDate  : moment().add(100, 'years'),
            },
        }
    ;

    try {
        document.createEvent("TouchEvent");
        isMobile = true;
    } catch (e) {

    }

    $('.bookly-js-select').val(null);

    // Apply filter from anchor
    if (urlParts.length > 1) {
        urlParts[1].split('&').forEach(function (part) {
            var params = part.split('=');
            if (params[0] == 'appointment-date') {
                if (params['1'] == 'any') {
                    $appointmentDateFilter
                        .data('date', 'any').find('span')
                        .html(BooklyL10n.dateRange.anyTime);
                } else {
                    pickers.appointmentDate.startDate = moment(params['1'].substring(0, 10));
                    pickers.appointmentDate.endDate = moment(params['1'].substring(11));
                    $appointmentDateFilter
                        .data('date', pickers.appointmentDate.startDate.format(pickers.dateFormat) + ' - ' + pickers.appointmentDate.endDate.format(pickers.dateFormat))
                        .find('span')
                        .html(pickers.appointmentDate.startDate.format(BooklyL10n.dateRange.dateFormat) + ' - ' + pickers.appointmentDate.endDate.format(BooklyL10n.dateRange.dateFormat));
                }
            } else if (params[0] == 'tasks') {
                $appointmentDateFilter
                    .data('date', 'null').find('span')
                    .html(BooklyL10n.tasks.title);
            } else if (params[0] == 'created-date') {
                pickers.creationDate.startDate = moment(params['1'].substring(0, 10));
                pickers.creationDate.endDate = moment(params['1'].substring(11));
                $creationDateFilter
                    .data('date', pickers.creationDate.startDate.format(pickers.dateFormat) + ' - ' + pickers.creationDate.endDate.format(pickers.dateFormat))
                    .find('span')
                    .html(pickers.creationDate.startDate.format(BooklyL10n.dateRange.dateFormat) + ' - ' + pickers.creationDate.endDate.format(BooklyL10n.dateRange.dateFormat));
            } else {
                $('#bookly-filter-' + params[0]).val(params[1]);
            }
        });
    } else {
        $.each(BooklyL10n.datatables.appointments.settings.filter, function (field, value) {
            if (value != '') {
                $('#bookly-filter-' + field).val(value);
            }
            // check if select has correct values
            if ($('#bookly-filter-' + field).prop('type') == 'select-one') {
                if ($('#bookly-filter-' + field + ' option[value="' + value + '"]').length == 0) {
                    $('#bookly-filter-' + field).val(null);
                }
            }
        });
    }

    Ladda.bind($('button[type=submit]', $exportForm).get(0), {timeout: 2000});

    /**
     * Init table columns.
     */
    $.each(BooklyL10n.datatables.appointments.settings.columns, function (column, show) {
        if (show) {
            switch (column) {
                case 'customer_full_name':
                    columns.push({data: 'customer.full_name', render: $.fn.dataTable.render.text()});
                    break;
                case 'customer_phone':
                    columns.push({
                        data: 'customer.phone',
                        render: function (data, type, row, meta) {
                            if (isMobile) {
                                return '<a href="tel:' + $.fn.dataTable.render.text().display(data) + '">' + $.fn.dataTable.render.text().display(data) + '</a>';
                            } else {
                                return $.fn.dataTable.render.text().display(data);
                            }
                        }
                    });
                    break;
                case 'customer_email':
                    columns.push({data: 'customer.email', render: $.fn.dataTable.render.text()});
                    break;
                case 'staff_name':
                    columns.push({data: 'staff.name'});
                    break;
                case 'service_title':
                    columns.push({
                        data: 'service.title',
                        render: function ( data, type, row, meta ) {
                            if (row.service.extras.length) {
                                var extras = '<ul class="bookly-list list-dots">';
                                $.each(row.service.extras, function (key, item) {
                                    extras += '<li><nobr>' + item.title + '</nobr></li>';
                                });
                                extras += '</ul>';
                                return data + extras;
                            }
                            else {
                                return data;
                            }
                        }
                    });
                    break;
                case 'payment':
                    columns.push({
                        data: 'payment',
                        render: function ( data, type, row, meta ) {
                            if (row.payment_id) {
                                return '<a role="button" data-action="show-payment" data-payment_id="' + row.payment_id + '">' + data + '</a>';
                            }
                            return '';
                        }
                    });
                    break;
                case 'service_duration':
                    columns.push({data: 'service.duration'});
                    break;
                case 'attachments':
                    columns.push({
                        data: 'attachment',
                        render: function (data, type, row, meta) {
                            if (data == '1') {
                                return '<button type="button" class="btn btn-link" data-action="show-attachments" title="' + BooklyL10n.attachments + '"><span class="dashicons dashicons-paperclip"></span></button>';
                            }
                            return '';
                        }
                    });
                    break;
                case 'rating':
                    columns.push({
                        data: 'rating',
                        render: function ( data, type, row, meta ) {
                            if (row.rating_comment == null) {
                                return row.rating;
                            } else {
                                return '<a href="#" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="' + $.fn.dataTable.render.text().display(row.rating_comment) + '">' + $.fn.dataTable.render.text().display(row.rating) + '</a>';
                            }
                        },
                    });
                    break;
                case 'number_of_persons':
                case 'locations':
                    columns.push({data: column, render: $.fn.dataTable.render.text()});
                    break;
                default:
                    if (column.startsWith('custom_fields_')) {
                        columns.push({
                            data: column.replace(/_([^_]*)$/, '.$1'),
                            render: $.fn.dataTable.render.text(),
                            orderable: false
                        });
                    } else {
                        columns.push({data: column});
                    }
                    break;
            }
        }
    });
    columns.push({
        responsivePriority: 1,
        orderable         : false,
        render            : function (data, type, row, meta) {
            return '<button type="button" class="btn btn-default" data-action="edit"><i class="glyphicon glyphicon-edit"></i> ' + BooklyL10n.edit + '</a>';
        }
    });
    columns.push({
        responsivePriority: 1,
        orderable         : false,
        render            : function (data, type, row, meta) {
            return '<input type="checkbox" value="' + row.ca_id + '" data-appointment="' + row.id + '" />';
        }
    });

    $.each(BooklyL10n.datatables.appointments.settings.order, function (_, value) {
        const index = columns.findIndex(c => c.data === value.column);
        if (index !== -1) {
            order.push([index, value.order]);
        }
    });
    /**
     * Init DataTables.
     */
    var dt = $appointmentsList.DataTable({
        order       : order,
        info        : false,
        searching   : false,
        lengthChange: false,
        processing  : true,
        responsive  : true,
        pageLength  : 25,
        pagingType  : 'numbers',
        serverSide  : true,
        drawCallback: function( settings ) {
            $('[data-toggle="popover"]').on('click', function (e) {
                e.preventDefault();
            }).popover();
            dt.responsive.recalc();
        },
        ajax: {
            url : ajaxurl,
            type: 'POST',
            data: function (d) {
                return $.extend({action: 'bookly_get_appointments', csrf_token : BooklyL10n.csrf_token}, {
                    filter: {
                        id          : $idFilter.val(),
                        date        : $appointmentDateFilter.data('date'),
                        created_date: $creationDateFilter.data('date'),
                        staff       : $staffFilter.val(),
                        customer    : $customerFilter.val(),
                        service     : $serviceFilter.val(),
                        status      : $statusFilter.val()
                    }
                }, d);
            }
        },
        columns: columns,
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row pull-left'<'col-sm-12 bookly-margin-top-lg'p>>",
        language: {
            zeroRecords: BooklyL10n.zeroRecords,
            processing:  BooklyL10n.processing
        }
    });

    /**
     * Add appointment.
     */
    $addButton.on('click', function () {
        showAppointmentDialog(
            null,
            null,
            moment(),
            function(event) {
                dt.ajax.reload();
            }
        )
    });

    /**
     * Export.
     */
    $exportForm.on('submit', function () {
        $exportDialog.find('[name="filter"]').val(JSON.stringify({
            id          : $idFilter.val(),
            date        : $appointmentDateFilter.data('date'),
            created_date: $creationDateFilter.data('date'),
            staff       : $staffFilter.val(),
            customer    : $customerFilter.val(),
            service     : $serviceFilter.val(),
            status      : $statusFilter.val()
        }));
        $exportDialog.modal('hide');

        return true;
    });

    /**
     * Print.
     */
    $printButton.on('click', function () {
        var columns = [];
        $printDialog.find('input:checked').each(function () {
            columns.push(this.value);
        });
        var config = {
            title: '',
            exportOptions: {
                columns: columns
            },
            customize: function (win) {
                win.document.firstChild.style.backgroundColor = '#fff';
                win.document.body.id = 'bookly-tbs';
                $(win.document.body).find('table').removeClass('collapsed');
            }
        };
        $.fn.dataTable.ext.buttons.print.action(null, dt, null, $.extend({}, $.fn.dataTable.ext.buttons.print, config));
    });

    /**
     * Select all appointments.
     */
    $checkAllButton.on('change', function () {
        $appointmentsList.find('tbody input:checkbox').prop('checked', this.checked);
    });

    $appointmentsList
        // On appointment select.
        .on('change', 'tbody input:checkbox', function () {
            $checkAllButton.prop('checked', $appointmentsList.find('tbody input:not(:checked)').length == 0);
        })
        // Show payment details
        .on('click', '[data-action=show-payment]', function () {
            $('#bookly-payment-details-modal').modal('show', this);
        })
        // Edit appointment.
        .on('click', '[data-action=edit]', function (e) {
            e.preventDefault();
            var data = dt.row($(this).closest('td')).data();
            showAppointmentDialog(
                data.id,
                null,
                null,
                function (event) {
                    dt.ajax.reload();
                }
            )
        });;

    /**
     * Delete appointments.
     */
    $deleteButton.on('click', function () {
        var ladda = Ladda.create(this);
        ladda.start();

        var data = [];
        var $checkboxes = $appointmentsList.find('tbody input:checked');
        $checkboxes.each(function () {
            data.push({ca_id: this.value, id: $(this).data('appointment')});
        });

        $.ajax({
            url  : ajaxurl,
            type : 'POST',
            data : {
                action     : 'bookly_delete_customer_appointments',
                csrf_token : BooklyL10n.csrf_token,
                data       : data,
                notify     : $('#bookly-delete-notify').prop('checked') ? 1 : 0,
                reason     : $('#bookly-delete-reason').val()
            },
            dataType : 'json',
            success  : function(response) {
                ladda.stop();
                $('#bookly-delete-dialog').modal('hide');
                if (response.success) {
                    dt.draw(false);
                    if (response.data && response.data.queue && response.data.queue.length) {
                        $(document.body).trigger('bookly.queue_dialog', [response.data.queue]);
                    }
                } else {
                    alert(response.data.message);
                }
            }
        });
    });

    /**
     * Init date range pickers.
     */
    moment.locale('en', {
        months       : BooklyL10n.datePicker.monthNames,
        monthsShort  : BooklyL10n.datePicker.monthNamesShort,
        weekdays     : BooklyL10n.datePicker.dayNames,
        weekdaysShort: BooklyL10n.datePicker.dayNamesShort,
        weekdaysMin  : BooklyL10n.datePicker.dayNamesMin
    });

    var
        pickerRanges1 = {},
        pickerRanges2 = {}
    ;
    pickerRanges1[BooklyL10n.dateRange.anyTime]   = [moment(), moment().add(100, 'years')];
    pickerRanges1[BooklyL10n.dateRange.yesterday] = [moment().subtract(1, 'days'), moment().subtract(1, 'days')];
    pickerRanges1[BooklyL10n.dateRange.today]     = [moment(), moment()];
    pickerRanges1[BooklyL10n.dateRange.tomorrow]  = [moment().add(1, 'days'), moment().add(1, 'days')];
    pickerRanges1[BooklyL10n.dateRange.last_7]    = [moment().subtract(7, 'days'), moment()];
    pickerRanges1[BooklyL10n.dateRange.last_30]   = [moment().subtract(30, 'days'), moment()];
    pickerRanges1[BooklyL10n.dateRange.thisMonth] = [moment().startOf('month'), moment().endOf('month')];
    pickerRanges1[BooklyL10n.dateRange.nextMonth] = [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')];
    $.extend(pickerRanges2, pickerRanges1);
    if (BooklyL10n.tasks.enabled) {
        pickerRanges1[BooklyL10n.tasks.title] = [moment(), moment().add(1, 'days')];
    }

    $appointmentDateFilter.daterangepicker(
        {
            parentEl : $appointmentDateFilter.parent(),
            startDate: pickers.appointmentDate.startDate,
            endDate  : pickers.appointmentDate.endDate,
            ranges   : pickerRanges1,
            autoUpdateInput: false,
            locale: {
                applyLabel : BooklyL10n.dateRange.apply,
                cancelLabel: BooklyL10n.dateRange.cancel,
                fromLabel  : BooklyL10n.dateRange.from,
                toLabel    : BooklyL10n.dateRange.to,
                customRangeLabel: BooklyL10n.dateRange.customRange,
                daysOfWeek : BooklyL10n.datePicker.dayNamesShort,
                monthNames : BooklyL10n.datePicker.monthNames,
                firstDay   : parseInt(BooklyL10n.dateRange.firstDay),
                format     : BooklyL10n.dateRange.dateFormat
            }
        },
        function(start, end, label) {
            switch (label) {
                case BooklyL10n.tasks.title:
                    $appointmentDateFilter
                        .data('date', 'null')
                        .find('span')
                        .html(BooklyL10n.tasks.title);
                    break;
                case BooklyL10n.dateRange.anyTime:
                    $appointmentDateFilter
                        .data('date', 'any')
                        .find('span')
                        .html(BooklyL10n.dateRange.anyTime);
                    break;
                default:
                    $appointmentDateFilter
                        .data('date', start.format(pickers.dateFormat) + ' - ' + end.format(pickers.dateFormat))
                        .find('span')
                        .html(start.format(BooklyL10n.dateRange.dateFormat) + ' - ' + end.format(BooklyL10n.dateRange.dateFormat));
            }
        }
    );

    $creationDateFilter.daterangepicker(
        {
            parentEl : $creationDateFilter.parent(),
            startDate: pickers.creationDate.startDate,
            endDate  : pickers.creationDate.endDate,
            ranges: pickerRanges2,
            autoUpdateInput: false,
            locale: {
                applyLabel : BooklyL10n.dateRange.apply,
                cancelLabel: BooklyL10n.dateRange.cancel,
                fromLabel  : BooklyL10n.dateRange.from,
                toLabel    : BooklyL10n.dateRange.to,
                customRangeLabel: BooklyL10n.dateRange.customRange,
                daysOfWeek : BooklyL10n.datePicker.dayNamesShort,
                monthNames : BooklyL10n.datePicker.monthNames,
                firstDay   : parseInt(BooklyL10n.dateRange.firstDay),
                format     : BooklyL10n.dateRange.dateFormat
            }
        },
        function(start, end, label) {
            switch (label) {
                case BooklyL10n.tasks.title:
                    $creationDateFilter
                        .data('date', 'null')
                        .find('span')
                        .html(BooklyL10n.tasks.title);
                    break;
                case BooklyL10n.dateRange.anyTime:
                    $creationDateFilter
                        .data('date', 'any')
                        .find('span')
                        .html(BooklyL10n.dateRange.createdAtAnyTime);
                    break;
                default:
                    $creationDateFilter
                        .data('date', start.format(pickers.dateFormat) + ' - ' + end.format(pickers.dateFormat))
                        .find('span')
                        .html(start.format(BooklyL10n.dateRange.dateFormat) + ' - ' + end.format(BooklyL10n.dateRange.dateFormat));
            }
        }
    );

    /**
     * On filters change.
     */
    $('.bookly-js-select')
        .select2({
            width: '100%',
            theme: 'bootstrap',
            allowClear: true,
            placeholder: '',
            language  : {
                noResults: function() { return BooklyL10n.no_result_found; }
            },
            matcher: function (params, data) {
                const term = $.trim(params.term).toLowerCase();
                if (term === '' || data.text.toLowerCase().indexOf(term) !== -1) {
                    return data;
                }

                let result = null;
                const search = $(data.element).data('search');
                search &&
                search.find((text) => {
                    if (result === null && text.toLowerCase().indexOf(term) !== -1) {
                        result = data;
                    }
                });

                return result;
            }
        });

    $('.bookly-js-select-ajax')
        .select2({
            width: '100%',
            theme: 'bootstrap',
            allowClear: true,
            placeholder: '',
            language  : {
                noResults: function() { return BooklyL10n.no_result_found; },
                searching: function () { return BooklyL10n.searching; }
            },
            ajax: {
                url: ajaxurl,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    params.page = params.page || 1;
                    return {
                        action: this.action === undefined ? $(this).data('ajax--action') : this.action,
                        filter: params.term,
                        page: params.page,
                        csrf_token : BooklyL10n.csrf_token
                    };
                }
            },
        });

    $idFilter.on('keyup', function () { dt.ajax.reload(); });
    $appointmentDateFilter.on('apply.daterangepicker', function () { dt.ajax.reload(); });
    $creationDateFilter.on('apply.daterangepicker', function () { dt.ajax.reload(); });
    $staffFilter.on('change', function () { dt.ajax.reload(); });
    $customerFilter.on('change', function () { dt.ajax.reload(); });
    $serviceFilter.on('change', function () { dt.ajax.reload(); });
    $statusFilter.on('change', function () { dt.ajax.reload(); });

});