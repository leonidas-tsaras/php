function validateContactForm(form) {
    let fullName = form.querySelector("input[name='fullName']").value;
    let email = form.querySelector("input[name='email']").value;
    let phone = form.querySelector("input[name='phone']").value;
    let notes = form.querySelector("textarea[name='notes']").value;

    if(fullName == "") {
        alert("Please fill out your full name");
        return false;
    }

    if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) {
        alert("Please fill out a valid e-mail");
        return false;
    }

    if(phone == "") {
        alert("Please fill out a valid Phone Number");
        return false;
    }

    return true;
}