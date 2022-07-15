const formID = 'add-product-form';

const productCategory = {
    "Electronic Devices": [
        {id:1,name:"Laptops"},
        {id:2,name:"Smart Phones"},
        {id:3,name:"Desktops"},
        {id:4,name:"Cameras"},
        {id:5,name:"Drones"},
        {id:6,name:"Consoles"}
    ],
    "Electronic Accessories": [
        {id:7,name:"Headphones"},
        {id:8,name:"Computer Components"},
        {id:9,name:"Speakers"},
        {id:10,name:"Strorage"},
        {id:11,name:"Printers"},
    ],
    "TV and Home Appliances":[
        {id:12,name:"LED Televisions"},
        {id:13,name:"Smart Televisions"},
        {id:14,name:"Home Audio"},
        {id:15,name:"Cooling and Heating"},
        {id:16,name:"Washers and Dryers"}
    ],
    "Toys":[
        {id:17,name:"Puzzles"},
        {id:18,name:"Games"},
        {id:19,name:"RC Vehicles"},
        {id:20,name:"Dolls"}
    ],
    "Clothes and Sports":[
        {id:21,name:"Fitness Equipment"},
        {id:22,name:"Sports Equipments"},
        {id:23,name:"Shirts"},
        {id:24,name:"Pants"},
        {id:25,name:"Shoes"}
    ]
}
const validation = {
        productname : {
            pattern: /^[a-zA-Z0-9- ]{8,100}$/,
            validation: "Product name must contain 8-100 alphanumeric characters or -.",
            validFunction: function(field) {return validity(field);}
        },
        color:{
            pattern:/^[a-zA-Z ]+(,[a-zA-Z ]+)*$/,
            validation: "Colors should be in letters only and more than one colors can be seprated by commas",
            validFunction: function(field) {return validity(field);}
        },
        size:{
            pattern:/^[a-zA-Z ]+(,[a-zA-Z ]+)*$/,
            validation: "Sizes should be in letters only and more than one sizes can be seprated by commas",
            validFunction: function(field) {return validity(field);}
        },
        maxAge: {
            validation: "Maximum Age should be more than Minimum Age",
            validFunction: function(field){ return maxAgeValidity(field)}
        },
        soldby: {
            pattern: /^[a-zA-Z0-9- ]+$/,
            validation: "Provider name may contain alphanumeric characters or -.",
            validFunction: function(field) {return validity(field);}
        },
        producingcost: {
            pattern: /^[0-9]+$/,
            validation: "Producing Cost can only be number",
            validFunction: function(field) {return validity(field);}
        },
        profit:{
            pattern: /^[0-9]+$/,
            validation: "Profit can only be number",
            validFunction: function(field) {return validity(field);}
        },
        stock:{
            pattern: /^[0-9]+$/,
            validation: "Stock can only be number",
            validFunction: function(field) {return validity(field);}
        }
    
};

function fillSubCategory(listElement, optionList){
    listElement.innerHTML = "";
    var liElement = "<option value = \""+optionList[0].id+"\" selected = \"selected\">"+optionList[0].name+"</option>\n"
    listElement.innerHTML += liElement;
    for(var i = 1; i< optionList.length; i++)
    {
        liElement = "<option value = \""+optionList[i].id+"\">"+optionList[i].name+"</option>";
        listElement.innerHTML += liElement;
    }
}

function fillList(listElement, optionList){
    listElement.innerHTML = "";
    var liElement = "<option value = \""+optionList[0]+"\" selected = \"selected\">"+optionList[0]+"</option>\n"
    listElement.innerHTML += liElement;
    for(var i = 1; i< optionList.length; i++)
    {
        liElement = "<option value = \""+optionList[i]+"\">"+optionList[i]+"</option>";
        listElement.innerHTML += liElement;
    }
}

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
//2. Validation of Maximum Age//
function maxAgeValidity(field){
    minAgeValue = document.forms[formID].elements['minAge'].value;
    maxAgeValue = field.value;
    if(minAgeValue <= maxAgeValue){
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
    //Filling The Main Category List//
    clElement = document.forms[formID].elements['category'];
    categoryList = Object.keys(productCategory);

    fillList(clElement, categoryList);
    
    //Setting UP SubCategory List//
    clElement.addEventListener("change", function(){
        var slElement = document.forms[formID].elements['subcategory'];
        var category = this.value;
        var subCategoryList = productCategory[category];
        fillSubCategory(slElement, subCategoryList);
    })
    //Setting For First Sub Category.
    fillSubCategory(document.forms[formID].elements['subcategory'], productCategory[clElement.value]);
    //

    const fieldNames = Object.keys(validation);
    fieldNames.forEach(Initialize);
}

main();