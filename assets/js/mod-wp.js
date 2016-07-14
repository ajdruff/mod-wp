$(document).ready(function () {

    var modwp_install = {}; //script namespace







    /**
     * setUpConfigTable()
     * 
     * Setup Configuration Table
     * Displays all the options that are set in config.php
     */
    modwp_install.setUpConfigTable = function () {


        $('#site_config').html((getConfigAsHTML(SITE_CONFIG, 'SITE_CONFIG')));
        $('#profile_config').html((getConfigAsHTML(PROFILE_CONFIG, 'PROFILE_CONFIG')));

    }


    /**
     * Update Profile
     * 
     * Updates displayed values with the new PROFILE_CONFIG 
     */
    modwp_install.updateProfile = function () {

        var form_values = $("#install_form").serialize();

        $.post(window.location.pathname + '?action=config', form_values, function (response) {
            //parse response object
            //  alert(response);
            response = jQuery.parseJSON(response);

            PROFILE_CONFIG = response.PROFILE_CONFIG;


            $('#profile_config').html((getConfigAsHTML(PROFILE_CONFIG, 'PROFILE_CONFIG')));

        })
        return false;



    }


    /**
     * Get Config Object as HTML
     * 
     * Returns a configuration object as HTML
     * 
     * param object config_obj The configuration paramaters as a json object. 
     * input_array_name string The name to use for our form's input array. 
     */

    function getConfigAsHTML(config_obj, input_array_name) {

        /**
         * Get HTML For The Profile DropDown
         *
         * @param none
         * @return string The html for the dropdown
         */

        function getProfileDropDownHTML(config_name) {
         config_name=config_name.replace(input_array_name, '');
            var profile_select_html;
            profile_select_html = '';
            selected = '';
            for (var profile in PROFILES) {
                if (PROFILES[profile] === SITE_CONFIG['profile']) {
                    selected = 'selected';
                } else {
                    selected = ''
                }
                profile_select_html = profile_select_html + '<option ' + selected + ' value="' + PROFILES[profile] + '">' + PROFILES[profile] + '</option>';
            }



            
                            html = '<tr class="form-group">'
                        + '<td>'
                          + '<label >' +getConfigLabel(config_name)+ '</label>'
                        + '<div ><em >' +getConfigDescription(config_name)+ '</em></div>'                    
                        + '</td>'
                        + '<td >'

                        + '<select class="form-control" id="profile" name="' + input_array_name + '[profile]"> ' + profile_select_html + '</select>'


                        + '</td>'
                        + '</tr>';
            
            
            return html;
            

        }
        /**
         * Get Config Label
         *
         * Get the configuration label
         */
        
        function getConfigLabel(config_name) {
           if (typeof(CONFIG_PROPS[config_name])!=='undefined' && typeof(CONFIG_PROPS[config_name].label)!=='undefined') {
                label =  CONFIG_PROPS[config_name].label;
                
            }
            else {
              label =  config_name;

            }
            return label;
        }
        /**
         * Get Config Label
         *
         * Get the configuration label
         */
        
        function getConfigDescription(config_name) {
            var description;
           if (typeof(CONFIG_PROPS[config_name])!=='undefined' && typeof(CONFIG_PROPS[config_name].description)!=='undefined') {            


                description=CONFIG_PROPS[config_name].description + ' $config' +config_name ;
                
            }
            else {
              description =  '';

            }
            return description;
        }
        
        /**
         * Get HTML For Non-editable Elements
         *
         * @param mixed config_name The form field name
         * @param mixed The form field value
         * @return string The html for the element
         */

        function getNonEditableHtml(config_name, config_value) {
    config_name=config_name.replace(input_array_name, '');
            var displayed_value = '<span class="control-group">'+config_value+'</span>';
            var html;
            //use displayed_value if applicable
            if ((typeof (config_value) == "boolean")) {


                displayed_value = (config_value == true) ? '<span class="control-group   glyphicon glyphicon-ok" style="color:green"></span>' : '<span class="glyphicon glyphicon-remove" style="color:red"></span>';

            }


 
            
                            html = '<tr class="form-group">'
                        + '<td>'
                               + '<label >' +getConfigLabel(config_name)+ '</label>'
                        + '<div ><em >' +getConfigDescription(config_name)+ '</em></div>'     
                        + '</td>'
                        + '<td >'

                        + displayed_value


                        + '</td>'
                        + '</tr>';   
            
            
            return html;
        }


        /**
         * Get HTML For Editable Elements
         *
         * @param mixed config_name The form field name
         * @param mixed The form field value
         * @return string The html for the element
         */

        function getEditableHtml(config_name, config_value) {

           config_name=config_name.replace(input_array_name, '');
           

           
           

            if ((typeof (config_value) == "boolean")) {
                checked = (config_value == true) ? 'checked' : '';




                
                
                html = '<tr class="form-group">'
                        + '<td>'
                           + '<label >' +getConfigLabel(config_name)+ '</label>'
                        + '<div ><em >' +getConfigDescription(config_name)+ '</em></div>'        
                        + '</td>'
                        + '<td >'

                        + '<input type="checkbox" ' + checked + ' name="no_input_' + config_name + '" value="' + config_value + '"><input type="hidden"  value="' + config_value + '">'


                        + '</td>'
                        + '</tr>';                
                
                

            } else {







                html = '<tr class="form-group">'
                        + '<td>'
                        + '<label >' +getConfigLabel(config_name)+ '</label>'
                        + '<div ><em >' +getConfigDescription(config_name)+ '</em></div>'                   
                        + '</td>'
                        + '<td >'

                        +'<input class="form-control  "  type="text" name="' + config_name + '" value="' + config_value + '">'


                        + '</td>'
                        + '</tr>';
            }

            return html;

        }



        var table = '';
        var config_name = null;
        var value = null;
        var displayed_value = null;
        var checked = null;


        for (var config_name in config_obj) {
            config_value = config_obj[config_name];



            var is_editable = null;

            if (config_value instanceof Object) {


                //if the config_value is an object also, we iterate it through it again
                config_category = config_name;//now that we have an array (or object), our first dimension is the 'category' and the second is the name
                config_object = config_value;//the value is now the object
                for (var config_name in config_object) {

                    config_value = config_object[config_name];
                    displayed_value = config_value;
                    is_editable = editable_props[config_category] != null && editable_props[config_category][config_name] != null && editable_props[config_category][config_name];

                    //check if we need to add an editable field for the user
                    if (is_editable) {


                        table = table.concat(getEditableHtml(input_array_name + '[' + config_category + '][' + config_name + ']', config_value));


                    } else if (!is_editable) {

                            html = '<tr class="form-group">'
                        + '<td>'
                               + '<label >' +getConfigLabel(config_name)+ '</label>'
                        + '<div ><em >' +getConfigDescription(config_name)+ '</em></div>'     
                        + '</td>'
                        + '<td >'

                        + getNonEditableHtml(input_array_name + '[' + config_category + '][' + config_name + ']', config_value)


                        + '</td>'
                        + '</tr>';   
                        table = table.concat(html);

                    }
                }

            } else {

                is_editable = editable_props[config_name] != null && editable_props[config_name];

                //provide a dropdown for the profile names
                if (config_name === 'profile') {

                    table = table.concat(getProfileDropDownHTML(input_array_name + '[' + config_name + ']'));
                }
                else if (is_editable) {



                    table = table.concat(getEditableHtml(input_array_name + '[' + config_name + ']', config_value));
                }
                else if (!is_editable) {


                    table = table.concat(getNonEditableHtml(input_array_name + '[' + config_name + ']', config_value));

                }
            }




        }



        return table;


    }

//setup Events


    modwp_install.setupEvents = function () {

        //change profile

        jQuery('#profile').change(function () {


            modwp_install.updateProfile();


        });

        //add hidden value if needed

        jQuery('input[type="checkbox"]').change(function () {
            //if checked


            // checked
            //update hidden value

            if ($(this).is(':checked'))
                jQuery(this).siblings('input[type="hidden"]').attr('value', true);  // checked
            else
                jQuery(this).siblings('input[type="hidden"]').attr('value', false);  // checked



        });


    }

//installation functionality
    modwp_install.install = function () {
        var retry = 0;
        var progress_bar_elem = $('.progress-bar').clone(); //cache progress bar so we can reset it
        var log_messages_elem = $('#log_messages').clone(); //cache progress bar so we can reset it
        var progress_bar_width = 0; //keep track of width updates.

        $('#submit').click(function () {

            $("#install_form").submit();

        });

        /**
         * Short Description
         *
         * Long
         * @param string $content The shortcode content
         * @return string The parsed output of the form body tag
         */

        function resetForm() {
            retry = 0;

            $('#submit').attr("disabled", true);
            $('#submit').prop("disabled", true);
            $('#submit').html('Installing WordPress...');
            $('#install_messages').html('');
            $('#install_messages').hide();
            $('#log_messages').replaceWith(log_messages_elem.clone());
            $('#log_messages').show();
            $('.progress-bar').replaceWith(progress_bar_elem.clone());
            $('.progress-bar').html("Installing WordPress...");
            progress_bar_width = 0;
            progress_bar_width = progress_bar_width + 10;
            $('.progress-bar').animate({width: progress_bar_width + "%", "aria-valuenow": progress_bar_width});

        }




        var rules = {
            rules: {
                'SITE_CONFIG[wp_options][blogname]': {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    minlength: 2,
                    required: true
                }
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');

            },
            success: function (element) {

                element.text('OK!').addClass('valid')
                        .closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            onfocusout: false,
            onkeyup: false,
            submitHandler: function () {
                resetForm();
                install('start');
            }

        };


        $("#install_form").validate(rules);

        /**
         * Install
         *
         * Sends an ajax request to wpinstall.php and handles the response
         * @package ModWP
         * @param string last_action The name of the last installation action. Used by wpinstall.php to determine the next install step.
         * @return string The parsed output of the form body tag
         */


        function install(last_action) {

            var extra_params;
            var form_values = $("#install_form").serialize();
            extra_params = '';

            if (retry > 0) {
                extra_params = extra_params + '&retry=' + retry;
            }
            $.post(window.location.pathname + '?action=install&last_action=' + last_action + extra_params, form_values, function (response) {


                //add each message to output.
                response = jQuery.parseJSON(response);
                log_messages = response.log_messages;
                success_messages = response.success_messages;
                error_messages = response.error_messages;
                warning_messages = response.warning_messages;
                last_action = response.last_action;
                retry = response.retry;

                if (error_messages.length > 0) {
                    displayMessages(error_messages, 'danger');
                    $('#install_messages').show();
                    $('#submit').attr("disabled", false);
                    $(this).prop("disabled", false);
                    $('#submit').html('Install WordPress');
                    return;
                }


                if (last_action === 'wpSuccessMessage') {

                    //animate=change width slowly until reach 100%, when done, show text that installation is complete
                    $('.progress-bar').animate({width: "100%", "aria-valuenow": 100}, function () {

                        $('.progress-bar').html("WordPress Installation Complete");
                        logMessages(log_messages);
                        displayMessages(success_messages, 'success');
                        displayMessages(warning_messages, 'warning');
                        displayMessages(error_messages, 'danger');
                    });
                    //   $.get(window.location.href + '?action=install&last_action=' + last_action);
                    $.post(window.location.pathname + '?action=install&last_action=' + last_action + extra_params, form_values);
                    $('#install_messages').show();
                    $('#submit').attr("disabled", false);
                    $(this).prop("disabled", false);
                    $('#submit').html('Install WordPress');
                    return false;
                } else {
                    progress_bar_width = progress_bar_width + 10; //increase the progress bar target by 10%
                    $('.progress-bar').animate(
                            {
                                width: progress_bar_width.toString() + "%", //property and target to reach
                                "aria-valuenow": progress_bar_width.toString() //accessibility valuenow
                            }
                    , 100 //easing,how fast it reaches value in ms (default 400)
                            , function () { //what to do when target is reached
                                setTimeout(function () { //a pause gives a smoother experience between showing bar and showing message
                                    logMessages(log_messages);
                                    displayMessages(success_messages, 'success');
                                    displayMessages(warning_messages, 'warning');
                                    displayMessages(error_messages, 'danger');

                                    install(last_action);
                                }, 1000);


                            });


                }


            });

        }

        /**
         * displayMessages
         *
         * Displays Messages 
         * @package ModWP
         * @param array messages The messages to display
         * @param string alert_class The boostrap class for alerts. acceptable values: 'danger' 'info' 'warning'  'success'
         * @return string void
         */
        function displayMessages(messages, alert_class) {
            //      $html=$('#install_messages').html;



            $.each(messages, function (index, value) {

                // $html=$html+'<p>'+value+'</p>'
                $('#install_messages').append('<div style="text-align:center;" class="alert alert-' + alert_class + '">' + value + '</div>');

            });

        }

        /**
         * logMessages
         *
         * Adds an information message to the log_messages element.
         * @package ModWP
         * @param array messages The messages to display
         * @return void
         */
        function logMessages(messages) {
            //      $html=$('#install_messages').html;



            $.each(messages, function (index, value) {

                // $html=$html+'<p>'+value+'</p>'
                $('#log_messages').append('<div>' + value + '</div>');

            });

        }




    }




    modwp_install.setUpConfigTable();
    modwp_install.setupEvents();
    modwp_install.install();






});