$(document).ready(function () {

    var modwp_install = {}; //script namespace







    /**
     * setUpConfigTable()
     * 
     * Setup Configuration Table
     * Displays all the options that are set in config.php
     */
    modwp_install.setUpConfigTable = function () {


        $('#site_config_basic').html((getConfigAsHTML(SITE_CONFIG, 'SITE_CONFIG', 'main')));
        $('#site_config_advanced').html((getConfigAsHTML(SITE_CONFIG, 'SITE_CONFIG', 'advanced')));
        $('#profile_config').html((getConfigAsHTML(PROFILE_CONFIG, 'PROFILE_CONFIG', 'all')));

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


          //  $('#profile_config').html((getConfigAsHTML(PROFILE_CONFIG, 'PROFILE_CONFIG')));
            
            $('#profile_config').html((getConfigAsHTML(PROFILE_CONFIG, 'PROFILE_CONFIG', 'all')));
            

        })
        return false;



    }


    /**
     * Get HTML For The Profile DropDown
     *
     * @param none
     * @return string The html for the dropdown
     */

    function getProfileDropDownHTML(section, setting_name, setting_value, input_array_name) {
        var config_id = '[' + section + '][' + setting_name + ']';
        var profile_select_html;
        profile_select_html = '';
        selected = '';
        for (var profile in PROFILES) {
            if (PROFILES[profile] === setting_value) {
                selected = 'selected';
            } else {
                selected = ''
            }
            profile_select_html = profile_select_html + '<option ' + selected + ' value="' + PROFILES[profile] + '">' + PROFILES[profile] + '</option>';
        }



        html_value = '<select class="form-control" id="profile" name="' + input_array_name + config_id + '"> ' + profile_select_html + '</select>';
        return html_value;


    }
    /**
     * Get Config Label
     *
     * Get the configuration label
     */

    function getConfigLabel(section, setting_name) {



        var config_id = section + ' : ' + setting_name;




        if (typeof (CONFIG_PROPS[section][setting_name]) !== 'undefined' && typeof (CONFIG_PROPS[section][setting_name].label) !== 'undefined') {
            label = CONFIG_PROPS[section][setting_name].label + '<div style="font-size:12px";>' + config_id + '</div>';

        }
        else {
            label = config_id;

        }
        return label;
    }
    /**
     * Get Config Label
     *
     * Get the configuration label
     */

    function getConfigDescription(section, setting_name) {

        var config_id = section + ' : ' + setting_name;

        var description;
        if (typeof (CONFIG_PROPS[section][setting_name]) !== 'undefined' && typeof (CONFIG_PROPS[section][setting_name].description) !== 'undefined') {


            description = CONFIG_PROPS[section][setting_name].description;

        }
        else {
            description = '';

        }
        return description;
    }

    /**
     * Get HTML For Non-editable Elements
     *
     * @param mixed setting_value The settings value
     * @return string The html for the element
     */

    function getSettingHtml(setting_value) {


        var html_value;

        //use displayed_value if applicable
        if ((typeof (setting_value) == "boolean")) {


            html_value = (setting_value == true) ? '<span class="control-group   glyphicon glyphicon-ok" style="color:green"></span>' : '<span class="glyphicon glyphicon-remove" style="color:red"></span>';

        } else {

            html_value = '<span class="control-group">' + setting_value + '</span>';
        }



        return html_value;
    }


    /**
     * Get HTML For Editable Elements
     *
     * @param mixed config_name The form field name
     * @param mixed The form field value
     * @return string The html for the element
     */

    function getSettingHtmlEditable(section, setting_name, setting_value, input_array_name) {


        var config_id = '[' + section + '][' + setting_name + ']';








        if ((typeof (setting_value) == "boolean")) {
            checked = (setting_value == true) ? 'checked' : '';





            html_value = '<input type="checkbox" ' + checked + ' name="no_input_' + input_array_name + config_id + '" value="' + setting_value + '"><input type="hidden"  value="' + setting_value + '">';

        } else {




            html_value = '<input class="form-control  "  type="text" name="' + input_array_name + config_id + '" value="' + setting_value + '">';



        }




        return html_value;

    }
    /**
     * Get Config Object as HTML
     * 
     * Returns a configuration object as HTML
     * Iterates through the configuration object 'PROFILE_CONFIG' or 'SITE_CONFIG' and returns the html of each configuration value.
     * For example, for SITE_CONFIG[wp_directory], it will return a non-editable string.
     * If the value is an object, for example, [wp_options], 
     * it will recursively call itself with parent_object_key with a string whose value is equal to the parent object's key.
     * The initial call 
     * 
     * param object config_obj The configuration paramaters as a json object. 
     * input_array_name string The name to use for our form's input array. i.e. 'PROFILE_CONFIG' or 'SITE_CONFIG'
     * parent_object_key string The key of the config_obj's parent object. Only needed if function is called recursively. For example, when the function encounters [wp_options], it calls itself recursively setting config_obj = SITE_CONFIG[wp_options] and setting parent_object's key equal to 'wp_options', getConfigAsHTML(SITE_CONFIG[wp_options],'SITE_CONFIG','wp_options')
     * 
     *   
     */
    function getConfigAsHTML(config_obj, input_array_name, tab) {



        var table = '';



        var section = null;
        var setting = null;
        var setting_name = null;

        for (var section in config_obj) {

            setting = config_obj[section];
            for (var setting_name in setting) {
                setting_value = setting[setting_name];
                //if the property is marked editable and its in the site_config file, make it editable. 
                is_editable = CONFIG_PROPS[section][setting_name].editable && input_array_name === 'SITE_CONFIG';

                //skip those settings that aren't intended for the requested tab
                matches_tab = CONFIG_PROPS[section][setting_name].tab === tab;
                if (!matches_tab && tab !== 'all') {
                    continue;
                }
                //provide a dropdown for the profile names
                if (setting_name === 'profile') {



                    html_value = getProfileDropDownHTML(section, setting_name, setting_value, input_array_name);
                }
                else if (is_editable) {



                    html_value = getSettingHtmlEditable(section, setting_name, setting_value, input_array_name);



                }
                else if (!is_editable) {


                    html_value = getSettingHtml(setting_value);




                }



                html = '<tr class="form-group">'
                        + '<td>'
                        + '<label >' + getConfigLabel(section, setting_name) + '</label>'
                        + '<div ><em >' + getConfigDescription(section, setting_name) + '</em></div>'
                        + '</td>'
                        + '<td >'

                        + html_value


                        + '</td>'
                        + '</tr>';
                table = table.concat(html);

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
            //note: this click even can be removed and the form will still work because the  $("#install_form").validate(rules); would do the work. we add it here to make it more explicit for easier troubleshooting.
            $("#install_form").submit(); //this triggers form validation which in turn triggers submitHandler: if valid
            return false;//must return false or you'll get 2 form submits.
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

                element.text('').addClass('valid')
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