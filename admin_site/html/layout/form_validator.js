$('.ui.form').form({
    on:'blur',
    inline:true,
    fields:{
        sacco_driver_license:{
            rules:[
                {
                    type:'empty',
                    prompt:'The sacco driver license field is empty!'
                }
            ]
        },
        sacco_driver_phone_number:{
            rules:[
                {
                    type:'empty',
                    prompt:'The sacco driver phone number field is empty!'
                }
            ]
        },
        sacco_driver_last_name:{
            rules:[
                {
                    type:'empty',
                    prompt:'The sacco driver last name field is empty!'
                }
            ]
        },
        sacco_driver_first_name:{
            rules:[
                {
                    type:'empty',
                    prompt:'The sacco driver first name field is empty!'
                }
            ]
        },
        sacco_bus_capacity:{
            rules:[
                {
                    type:'empty',
                    prompt:'The sacco bus capacity field is empty!'
                }
            ]
        },
        sacco_bus_plate:{
            rules:[
                {
                    type:'empty',
                    prompt:'The sacco number plate field is empty!'
                }
            ]
        },
        sacco_bus_route_number:{
            rules:[
                {
                    type:'empty',
                    prompt:'The sacco bus route field is empty!'
                }
            ]
        },
        sacco_name:{
            rules:[
                {
                    type:'empty',
                    prompt:'The sacco name field is empty!'
                }
            ]
        },
        sacco_description:{
            rules:[
                {
                    type:'empty',
                    prompt:'The sacco description field is empty!'
                },
                {
                    type:'minLength[25]',
                    prompt:'The sacco description field is too short!'
                }
            ]
        },
        admin_first_name:{
            rules:[
                {
                    type:'empty',
                    prompt:'The first name field is empty!'
                }
            ]
        },
        admin_last_name:{
            rules:[
                {
                    type:'empty',
                    prompt:'The last name field is empty!'
                }
            ]
        },
        admin_phone_number:{
            rules:[
                {
                    type:'empty',
                    prompt:'The phone number field is empty!'
                },
                {
                    type:'minLength[9]',
                    prompt:'Invalid phone number.'
                }
            ]
        },
        admin_email_address:{
            rules:[
                {
                    type:'email',
                    prompt:'Enter a valid email address!'
                },
                {
                    type:'empty',
                    prompt:'The email field is empty!'
                },
                {
                    type:'minLength[5]',
                    prompt:'Email Address is too short!'
                }
            ]
        },
        admin_password:{
            identifier:'admin_password',
            rules:[
                {
                    type:'empty',
                    prompt:'The password field is empty!'
                },
                {
                    type:'minLength[6]',
                    prompt:'The password must be more than 6 characters'
                }
            ]
        },
        admin_password_confirm:{
            rules:[
                {
                    type:'empty',
                    prompt:'The password field is empty!'
                },
                {
                    type:'match[admin_password]',
                    prompt:'The passwords do not match!'
                }
            ]
        }
    }
});

