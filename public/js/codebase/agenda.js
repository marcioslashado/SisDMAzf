            function init() {
                dhtmlXTooltip.config.className = 'dhtmlXTooltip tooltip';
                dhtmlXTooltip.config.timeout_to_display = 50;
                dhtmlXTooltip.config.delta_x = 15;
                dhtmlXTooltip.config.delta_y = -20;

                scheduler.config.multi_day = true;
                scheduler.config.xml_date = "%Y-%m-%d %H:%i";
                scheduler.config.details_on_dblclick = true;
                scheduler.config.details_on_create = true;

                scheduler.config.event_duration = 35;
                scheduler.config.occurrence_timestamp_in_utc = true;
                scheduler.config.include_end_by = true;
                scheduler.config.repeat_precise = true;


                scheduler.config.lightbox.sections = [
                    {name: "Título", height: 50, map_to: "text", type: "textarea", focus: true},
                    {name: "description", height: 50, map_to: "details", type: "textarea", focus: true},
                    {name: "Convidados", height: 50, map_to: "convidados", type: "textarea", focus: true},
                    {name: "Endereço", height: 43, map_to: "event_location", type: "textarea",
                        default_value: "Rua Carlos Chagas, 2190 - Granja Portugal - Fortaleza-CE"},
                    //{name: "recurring", type: "recurring", map_to: "rec_type", button: "recurring"}, //Agendamento Recorrente... implantar posteriormente
                    {name: "time", height: 72, type: "time", map_to: "auto"}
                ];

                scheduler.config.full_day = true; // enable parameter to get full day event option on the lightbox form
                scheduler.config.buttons_left = ["dhx_save_btn", "dhx_cancel_btn", "locate_button"];
                scheduler.locale.labels["locate_button"] = "Localização";

                scheduler.init('scheduler_here', new Date(2010, 05, 11), "week");
                scheduler.load("./data/events.xml", function () {
                    scheduler.showLightbox("1261150564");
                });
                scheduler.attachEvent("onLightboxButton", function (button_id, node, e) {
                    if (button_id == "locate_button") {
                        alert("Funções da ação de Localização/Mapa");
                    }

                    var lightbox_form = scheduler.getLightbox(); // this will generate lightbox form
                    var inputs = lightbox_form.getElementsByTagName('input');
                    var date_of_end = null;
                    for (var i = 0; i < inputs.length; i++) {
                        if (inputs[i].name == "date_of_end") {
                            date_of_end = inputs[i];
                            break;
                        }
                    }

                    var repeat_end_date_format = scheduler.date.date_to_str(scheduler.config.repeat_date);
                    var show_minical = function () {
                        if (scheduler.isCalendarVisible())
                            scheduler.destroyCalendar();
                        else {
                            scheduler.renderCalendar({
                                position: date_of_end,
                                date: scheduler.getState().date,
                                navigation: true,
                                handler: function (date, calendar) {
                                    date_of_end.value = repeat_end_date_format(date);
                                    scheduler.destroyCalendar()
                                }
                            });
                        }
                    };
                    date_of_end.onclick = show_minical;
                });

                scheduler.templates.event_text = function (start, end, ev) {
                    return "<b>" + ev.text + "</b><br>" + ev.details + "<br><i>" + ev.event_location + "</i>";
                };

                var format = scheduler.date.date_to_str("%d/%m/%Y %H:%i");
                scheduler.templates.tooltip_text = function (start, end, event) {
                    return "<b>Título:</b> " + event.text + "<br/>\n\
                            <b>Descrição:</b> " + event.details + "<br/>\n\
                            <b>Participantes:</b> " + event.convidados + "<br/>\n\
                            <b>Local:</b> " + event.event_location + "<br/>\n\
                            <b>Inicia em:</b> " + format(start) + "<br/>\n\
                            <b>Termina em:</b> " + format(end);
                };
            }