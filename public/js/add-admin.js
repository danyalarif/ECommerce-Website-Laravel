const formID = 'add_admin_form';

const validation = {
        firstname : {
            pattern: /^[a-zA-Z ]+$/,
            validation: "First name must be letters only.",
            validFunction: function(field) {return validity(field);}
        },
        lastname: {
            pattern: /^[a-zA-Z]+$/,
            validation: "Last name must be letters only." ,
            validFunction: function(field) {return validity(field);}
        },
        username: {
            pattern: /^[a-zA-Z]{8,20}$/,
            validation: "Username must consist of 8 - 20 letters only.",
            validFunction: function(field) {return validity(field);}
        },
        email:{
            pattern: /^([a-zA-Z0-9.-]+)@([a-z0-9-]+).([a-z]{2,8})(.[a-z]{2,8})?$/,
            validation: "Enter a valid email address, i.e. alihussain@gmail.com or alihussain@comsats.edu.pk",
            validFunction: function(field) {return validity(field);}
        },
        password:{
            pattern: /^[a-zA-Z0-9-_ ]{8,20}$/,
            validation: "Password must be of 8-20 characters and it may contain alphabets, numbers, - and _",
            validFunction: function(field) {return validity(field);}
        },
        confirm_password:{
            validation: "Password must match",
            validFunction: function(field) {return confirmPassword(field);}
        },
        expiryDate:{
            validation: "Expiry Date must be greater than current date",
            validFunction: function(field){return validateDate(field);}
        }
    
};

//Set Class Valid / InValid//

function getClasses(field){
    var classes = field.className;
    var classes = classes.split(' ');
    return classes;
}
//Assign Validation to Field//
//replaceClass(field, "valid", "invalid") --> To make field Valid//
//replaceClass(field, "invalid", "valid") --> To make field unValid//
function replaceClass(field, class1, class2)
{
    var classes = getClasses(field);
    var index = classes.indexOf(class2);
    if(index == -1){
        if(classes.indexOf(class1) < 0)
            classes.push(class1);
    }
    else{
        classes[index] = class1;
    }
    field.className = "";
    for(var i = 0; i<classes.length; i++){
        field.className = field.className + classes[i] + " ";
    }
}
//Validate A Field on Key Up
//Validation Functions.
//1. Validation Of Fields//
function checkValidity(field){
    if(validation[field.name].pattern.test(field.value)){
        return true;
    }
    else
    {
        return false;
    }
}
function validity(field){
    if(checkValidity(field))
    {
        replaceClass(field, "valid", "invalid");
        return true;
    }
    else
    {
        replaceClass(field, "invalid", "valid");
        return false;
    }
}
//2. Validation of Confirm Password//
function confirmPassword(field){
    //get Password Field//
    passField = document.forms[formID].password;
    if(passField.value === field.value){
        replaceClass(field, "valid", "invalid");
        return true;
    }
    else{
        replaceClass(field, "invalid", "valid");
        return false;
    }
}

function validateDate(field){
    if(field.value === '')
        return true;
    
    selectedDate = field.value;
    selectedTime = Math.floor(new Date(selectedDate).getTime());
    TimeNow = Date.now();
    if(selectedTime>TimeNow){
        replaceClass(field, "valid", "invalid");
        return true;
    }
    else{
        replaceClass(field, "invalid", "valid");
        return false;
    }
}
//Validity Check//

function submitForm(event){
    var validForm = true;

    const fieldNames = Object.keys(validation);

    for(var i = 0; i<fieldNames.length; i++){
        field = document.forms[formID].elements[fieldNames[i]];
        if(!validation[fieldNames[i]].validFunction(field)){
            field.focus();
            validForm = false;
            break;
        }
    }

    if(!validForm)
        event.preventDefault();
}

function Initialize(fieldName){
    //Get Field Element//
    field = document.forms[formID].elements[fieldName];

    //Add Warning Below It in Error Class//
    document.querySelector("[name=\""+fieldName+"\"] ~ .error").innerText = validation[fieldName].validation;

    if(field.type == "password" || field.type == "text" || field.type == "textarea")
    {
        field.addEventListener("keyup", function(){
            validation[this.name].validFunction(this);
        });
    }
    else{
        field.addEventListener("change", function(){
            validation[this.name].validFunction(this);
        });
    }
}

function main(){
    const fieldNames = Object.keys(validation);
    fieldNames.forEach(Initialize);
}

main();